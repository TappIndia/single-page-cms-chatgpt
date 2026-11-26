<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SitePageSection extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $pages = $db->table('site_page p')
            ->select('p.*, s.name AS site_name')
            ->join('site s', 's.id = p.site_id')
            ->orderBy('p.site_id', 'ASC')
            ->orderBy('p.sort_order', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_page_section/index', [
            'title' => 'Page Section Management',
            'pages' => $pages
        ]);
    }
    public function manage($pageId)
    {
        $db = Database::connect();

        $page = $db->table('site_page p')
            ->select('p.*, s.name AS site_name')
            ->join('site s', 's.id = p.site_id')
            ->where('p.id', $pageId)
            ->get()
            ->getRowArray();

        if (!$page) {
            return redirect()->to(site_url('admin/page-sections'))
                ->with('error', 'Page not found.');
        }

        $sections = $db->table('site_section')
            ->where('site_id', $page['site_id'])
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();

        $assigned = $db->table('site_page_section')
            ->where('page_id', $pageId)
            ->get()
            ->getResultArray();

        $assignedIds = array_column($assigned, 'site_section_id');

        $assignedMap = [];

        foreach ($assigned as $item) {
            $assignedMap[$item['site_section_id']] = $item;
        }

        return view('admin/site_page_section/manage', [
            'title' => 'Manage Page Sections',
            'page' => $page,
            'sections' => $sections,
            'assignedIds' => $assignedIds,
            'assignedMap' => $assignedMap
        ]);
    }
    public function save($pageId)
    {
        $db = Database::connect();

        $page = $db->table('site_page')
            ->where('id', $pageId)
            ->get()
            ->getRowArray();

        if (!$page) {
            return redirect()->to(site_url('admin/page-sections'))
                ->with('error', 'Page not found.');
        }

        $selectedIds = array_unique(array_map(
            'intval',
            (array) $this->request->getPost('section_ids')
        ));

        $sections = $db->table('site_section')
            ->where('site_id', $page['site_id'])
            ->get()
            ->getResultArray();

        $validIds = array_column($sections, 'id');
        $selectedIds = array_values(array_intersect($selectedIds, $validIds));

        $sortOrders = (array) $this->request->getPost('sort_order');
        $enabled = (array) $this->request->getPost('enabled');

        $db->transStart();

        if (empty($selectedIds)) {
            $db->table('site_page_section')
                ->where('page_id', $pageId)
                ->delete();
        } else {
            $db->table('site_page_section')
                ->where('page_id', $pageId)
                ->whereNotIn('site_section_id', $selectedIds)
                ->delete();

            foreach ($selectedIds as $sectionId) {
                $existing = $db->table('site_page_section')
                    ->where('page_id', $pageId)
                    ->where('site_section_id', $sectionId)
                    ->get()
                    ->getRowArray();

                $data = [
                    'sort_order' => (int) ($sortOrders[$sectionId] ?? 0),
                    'is_enabled' => isset($enabled[$sectionId]) ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                if ($existing) {
                    $db->table('site_page_section')
                        ->where('id', $existing['id'])
                        ->update($data);
                } else {
                    $data['page_id'] = $pageId;
                    $data['site_section_id'] = $sectionId;
                    $data['created_at'] = date('Y-m-d H:i:s');

                    $db->table('site_page_section')->insert($data);
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()
                ->with('error', 'Unable to save section assignments.');
        }

        return redirect()->to(site_url('admin/page-sections/manage/' . $pageId))
            ->with('success', 'Page section assignments saved successfully.');
    }
}