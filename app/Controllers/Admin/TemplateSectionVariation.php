<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class TemplateSectionVariation extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $mappings = $db->table('template_section_variation tsv')
            ->select('
                tsv.id,
                t.name AS template_name,
                st.type_name AS section_type,
                sv.variation_name,
                tsv.is_default,
                tsv.is_enabled,
                tsv.sort_order
            ')
            ->join('template t', 't.id = tsv.template_id')
            ->join('section_variation sv', 'sv.id = tsv.section_variation_id')
            ->join('section_type st', 'st.id = sv.section_type_id')
            ->orderBy('t.id', 'ASC')
            ->orderBy('st.id', 'ASC')
            ->orderBy('tsv.sort_order', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/template_section_variation/index', [
            'title' => 'Template Section Variations',
            'mappings' => $mappings
        ]);
    }
}
