<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SiteDesignSetting extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $settings = $db->table('site_design_setting ds')
            ->select('
                ds.id,
                s.name AS site_name,
                ds.setting_key,
                ds.setting_group,
                ds.setting_type,
                ds.default_value,
                ds.custom_value
            ')
            ->join('site s', 's.id = ds.site_id')
            ->orderBy('s.id', 'ASC')
            ->orderBy('ds.setting_group', 'ASC')
            ->orderBy('ds.id', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_design_setting/index', [
            'title' => 'Website Design Settings',
            'settings' => $settings
        ]);
    }
}
