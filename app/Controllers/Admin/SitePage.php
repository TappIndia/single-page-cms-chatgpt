<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SitePage extends BaseController
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

        return view('admin/site_page/index', [
            'title' => 'Website Pages',
            'pages' => $pages
        ]);
    }

    public function create()
    {
        $db = Database::connect();

        $sites = $db->table('site')
            ->select('id, name')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_page/create', [
            'title' => 'Add Website Page',
            'sites' => $sites
        ]);
    }
    public function store()
    {
        $rules = [
            'site_id' => 'required|is_natural_no_zero',
            'title' => 'required|max_length[255]',
            'slug' => 'required|max_length[255]|alpha_dash',
            'page_type' => 'required|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        $siteId = (int) $this->request->getPost('site_id');
        $slug = strtolower(trim($this->request->getPost('slug')));
        $isHomepage = $this->request->getPost('is_homepage') ? 1 : 0;

        if ($isHomepage) {
            $db->table('site_page')
                ->where('site_id', $siteId)
                ->update(['is_homepage' => 0]);
        }

        $db->table('site_page')->insert([
            'site_id' => $siteId,
            'title' => trim($this->request->getPost('title')),
            'slug' => $slug,
            'page_type' => $this->request->getPost('page_type'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'is_homepage' => $isHomepage,
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'status' => 'draft',
            'sort_order' => (int) $this->request->getPost('sort_order'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('admin/pages'))
            ->with('success', 'Page created successfully.');
    }
    public function edit($id)
    {
        $db = Database::connect();

        $page = $db->table('site_page')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$page) {
            return redirect()->to(site_url('admin/pages'))
                ->with('error', 'Page not found.');
        }

        $sites = $db->table('site')
            ->select('id, name')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_page/edit', [
            'title' => 'Edit Website Page',
            'page' => $page,
            'sites' => $sites
        ]);
    }
    public function update($id)
    {
        $rules = [
            'site_id' => 'required|is_natural_no_zero',
            'title' => 'required|max_length[255]',
            'slug' => 'required|max_length[255]|alpha_dash',
            'page_type' => 'required|max_length[50]',
            'status' => 'required|in_list[draft,published,archived]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        $page = $db->table('site_page')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$page) {
            return redirect()->to(site_url('admin/pages'))
                ->with('error', 'Page not found.');
        }

        $siteId = (int) $this->request->getPost('site_id');
        $isHomepage = $this->request->getPost('is_homepage') ? 1 : 0;

        if ($isHomepage) {
            $db->table('site_page')
                ->where('site_id', $siteId)
                ->where('id !=', $id)
                ->update(['is_homepage' => 0]);
        }

        $db->table('site_page')
            ->where('id', $id)
            ->update([
                'site_id' => $siteId,
                'title' => trim($this->request->getPost('title')),
                'slug' => strtolower(trim($this->request->getPost('slug'))),
                'page_type' => $this->request->getPost('page_type'),
                'meta_title' => $this->request->getPost('meta_title'),
                'meta_description' => $this->request->getPost('meta_description'),
                'meta_keywords' => $this->request->getPost('meta_keywords'),
                'is_homepage' => $isHomepage,
                'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
                'status' => $this->request->getPost('status'),
                'sort_order' => (int) $this->request->getPost('sort_order'),
                'published_at' => $this->request->getPost('status') === 'published'
                    ? ($page['published_at'] ?: date('Y-m-d H:i:s'))
                    : null,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->to(site_url('admin/pages'))
            ->with('success', 'Page updated successfully.');
    }
    public function delete($id)
    {
        $db = Database::connect();

        $page = $db->table('site_page')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$page) {
            return redirect()->to(site_url('admin/pages'))
                ->with('error', 'Page not found.');
        }

        $db->table('site_page')
            ->where('id', $id)
            ->delete();

        return redirect()->to(site_url('admin/pages'))
            ->with('success', 'Page deleted successfully.');
    }
}