<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SectionType extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $sectionTypes = $db->table('section_type')
            ->select('id, type_key, type_name, description, is_active')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/section_type/index', [
            'title' => 'Section Type Management',
            'sectionTypes' => $sectionTypes
        ]);
    }
}
