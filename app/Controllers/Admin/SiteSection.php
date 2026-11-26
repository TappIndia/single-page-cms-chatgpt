<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SiteSection extends BaseController
{
    private function getFormOptions()
    {
        $db = Database::connect();

        return [
            'sites' => $db->table('site')
                ->select('id, name, template_id')
                ->orderBy('name', 'ASC')
                ->get()
                ->getResultArray(),

            'sectionTypes' => $db->table('section_type')
                ->where('is_active', 1)
                ->orderBy('type_name', 'ASC')
                ->get()
                ->getResultArray(),

            'variations' => $db->table('section_variation sv')
                ->select('sv.variation_key, sv.variation_name, st.type_key')
                ->join('section_type st', 'st.id = sv.section_type_id')
                ->where('sv.is_active', 1)
                ->where('st.is_active', 1)
                ->orderBy('st.type_name', 'ASC')
                ->orderBy('sv.variation_name', 'ASC')
                ->get()
                ->getResultArray(),
        ];
    }

    private function getAllowedVariation($siteId, $typeKey, $viewKey)
    {
        $db = Database::connect();

        return $db->table('site s')
            ->select('sv.*')
            ->join(
                'template_section_variation tsv',
                'tsv.template_id = s.template_id'
            )
            ->join(
                'section_variation sv',
                'sv.id = tsv.section_variation_id'
            )
            ->join(
                'section_type st',
                'st.id = sv.section_type_id'
            )
            ->where('s.id', $siteId)
            ->where('st.type_key', $typeKey)
            ->where('sv.variation_key', $viewKey)
            ->where('sv.is_active', 1)
            ->where('st.is_active', 1)
            ->where('tsv.is_enabled', 1)
            ->get()
            ->getRowArray();
    }

    private function validJson($value)
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        json_decode($value);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $value;
    }

    private function sectionExists($id)
    {
        return Database::connect()
            ->table('site_section')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    public function index()
    {
        $db = Database::connect();

        $sections = $db->table('site_section ss')
            ->select('
                ss.id,
                ss.site_id,
                s.name AS site_name,
                ss.section_key,
                ss.section_type,
                ss.view_key,
                ss.section_name,
                ss.sort_order,
                ss.is_enabled,
                ss.sync_status
            ')
            ->join('site s', 's.id = ss.site_id')
            ->orderBy('s.id', 'ASC')
            ->orderBy('ss.sort_order', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_section/index', [
            'title' => 'Website Section Management',
            'sections' => $sections
        ]);
    }

    public function create()
    {
        return view(
            'admin/site_section/create',
            array_merge(
                [
                    'title' => 'Add Website Section',
                    'section' => null,
                ],
                $this->getFormOptions()
            )
        );
    }

    public function store()
    {
        $rules = [
            'site_id' => 'required|is_natural_no_zero',
            'section_key' => 'required|max_length[100]|alpha_dash',
            'section_type' => 'required|max_length[100]',
            'view_key' => 'required|max_length[100]',
            'section_name' => 'required|max_length[150]',
            'sort_order' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        $siteId = (int) $this->request->getPost('site_id');
        $sectionKey = strtolower(trim(
            $this->request->getPost('section_key')
        ));
        $typeKey = trim($this->request->getPost('section_type'));
        $viewKey = trim($this->request->getPost('view_key'));

        $site = $db->table('site')
            ->where('id', $siteId)
            ->get()
            ->getRowArray();

        if (!$site) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected website was not found.');
        }

        $duplicate = $db->table('site_section')
            ->where('site_id', $siteId)
            ->where('section_key', $sectionKey)
            ->countAllResults();

        if ($duplicate > 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This section key already exists for this website.');
        }

        $variation = $this->getAllowedVariation(
            $siteId,
            $typeKey,
            $viewKey
        );

        if (!$variation) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'This section type and variation are not available in the selected website template.'
                );
        }

        $contentJson = $this->validJson(
            $this->request->getPost('content_json')
        );

        $layoutJson = $this->validJson(
            $this->request->getPost('layout_json')
        );

        if ($contentJson === false || $layoutJson === false) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Content and layout must contain valid JSON.');
        }

        if ($contentJson === null) {
            $contentJson = $variation['default_content_json'];
        }

        if ($layoutJson === null) {
            $layoutJson = $variation['default_layout_json'];
        }

        $now = date('Y-m-d H:i:s');

        $db->table('site_section')->insert([
            'site_id' => $siteId,
            'section_key' => $sectionKey,
            'section_type' => $typeKey,
            'view_key' => $viewKey,
            'section_name' => trim(
                $this->request->getPost('section_name')
            ),
            'content_json' => $contentJson,
            'layout_json' => $layoutJson,
            'sort_order' => (int) $this->request->getPost('sort_order'),
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'source_template_version' => $site['template_version'],
            'source_template_key' => $typeKey,
            'sync_status' => 'synced',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->to(site_url('admin/site-sections'))
            ->with('success', 'Website section created successfully.');
    }

    public function edit($id)
    {
        $section = $this->sectionExists($id);

        if (!$section) {
            return redirect()->to(site_url('admin/site-sections'))
                ->with('error', 'Website section not found.');
        }

        return view(
            'admin/site_section/edit',
            array_merge(
                [
                    'title' => 'Edit Website Section',
                    'section' => $section,
                ],
                $this->getFormOptions()
            )
        );
    }

    public function update($id)
    {
        $section = $this->sectionExists($id);

        if (!$section) {
            return redirect()->to(site_url('admin/site-sections'))
                ->with('error', 'Website section not found.');
        }

        $rules = [
            'site_id' => 'required|is_natural_no_zero',
            'section_key' => 'required|max_length[100]|alpha_dash',
            'section_type' => 'required|max_length[100]',
            'view_key' => 'required|max_length[100]',
            'section_name' => 'required|max_length[150]',
            'sort_order' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        $siteId = (int) $this->request->getPost('site_id');
        $sectionKey = strtolower(trim(
            $this->request->getPost('section_key')
        ));
        $typeKey = trim($this->request->getPost('section_type'));
        $viewKey = trim($this->request->getPost('view_key'));

        $site = $db->table('site')
            ->where('id', $siteId)
            ->get()
            ->getRowArray();

        if (!$site) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected website was not found.');
        }

        $duplicate = $db->table('site_section')
            ->where('site_id', $siteId)
            ->where('section_key', $sectionKey)
            ->where('id !=', $id)
            ->countAllResults();

        if ($duplicate > 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This section key already exists for this website.');
        }

        $variation = $this->getAllowedVariation(
            $siteId,
            $typeKey,
            $viewKey
        );

        if (!$variation) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'This section type and variation are not available in the selected website template.'
                );
        }

        $contentJson = $this->validJson(
            $this->request->getPost('content_json')
        );

        $layoutJson = $this->validJson(
            $this->request->getPost('layout_json')
        );

        if ($contentJson === false || $layoutJson === false) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Content and layout must contain valid JSON.');
        }

        // Preserve existing content if the form does not submit these fields.
        if ($this->request->getPost('content_json') === null) {
            $contentJson = $section['content_json'];
        }

        if ($this->request->getPost('layout_json') === null) {
            $layoutJson = $section['layout_json'];
        }

        $db->table('site_section')
            ->where('id', $id)
            ->update([
                'site_id' => $siteId,
                'section_key' => $sectionKey,
                'section_type' => $typeKey,
                'view_key' => $viewKey,
                'section_name' => trim(
                    $this->request->getPost('section_name')
                ),
                'content_json' => $contentJson,
                'layout_json' => $layoutJson,
                'sort_order' => (int) $this->request->getPost('sort_order'),
                'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
                'source_template_version' => $site['template_version'],
                'source_template_key' => $typeKey,
                'sync_status' => 'customized',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->to(site_url('admin/site-sections'))
            ->with('success', 'Website section updated successfully.');
    }

    public function delete($id)
    {
        $db = Database::connect();

        $section = $this->sectionExists($id);

        if (!$section) {
            return redirect()->to(site_url('admin/site-sections'))
                ->with('error', 'Website section not found.');
        }

        // Do not delete a section while it is assigned to any page.
        $assigned = $db->table('site_page_section')
            ->where('site_section_id', $id)
            ->countAllResults();

        if ($assigned > 0) {
            return redirect()->to(site_url('admin/site-sections'))
                ->with(
                    'error',
                    'This section is assigned to one or more pages. Remove it from those pages before deleting it.'
                );
        }

        $db->table('site_section')
            ->where('id', $id)
            ->delete();

        return redirect()->to(site_url('admin/site-sections'))
            ->with('success', 'Website section deleted successfully.');
    }
}
