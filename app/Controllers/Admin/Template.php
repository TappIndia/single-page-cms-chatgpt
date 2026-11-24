<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class Template extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $templates = $db->table('template')
            ->select('id, name, slug, css_framework, framework_version, version, status')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/template/index', [
            'title' => 'Template Management',
            'templates' => $templates
        ]);
    }
}
