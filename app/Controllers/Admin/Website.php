<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class Website extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $websites = $db->table('site')
            ->select('site.id, site.name, site.slug, site.status, template.name AS template_name')
            ->join('template', 'template.id = site.template_id')
            ->orderBy('site.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/website/index', [
            'title' => 'Website Management',
            'websites' => $websites
        ]);
    }
}
