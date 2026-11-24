<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SectionVariation extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $variations = $db->table('section_variation sv')
            ->select('sv.id, sv.variation_key, sv.variation_name, sv.view_file, sv.is_active, st.type_name')
            ->join('section_type st', 'st.id = sv.section_type_id')
            ->orderBy('st.id', 'ASC')
            ->orderBy('sv.id', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/section_variation/index', [
            'title' => 'Section Variation Management',
            'variations' => $variations
        ]);
    }
}
