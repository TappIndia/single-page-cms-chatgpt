<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SiteSection extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $sections = $db->table('site_section ss')
            ->select('
                ss.id,
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
}
