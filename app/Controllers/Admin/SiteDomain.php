<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SiteDomain extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $domains = $db->table('site_domain sd')
            ->select('
                sd.id,
                sd.site_id,
                s.name AS site_name,
                sd.domain,
                sd.is_primary,
                sd.is_verified,
                sd.verified_at,
                sd.status,
                sd.created_at
            ')
            ->join('site s', 's.id = sd.site_id')
            ->orderBy('sd.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/site_domain/index', [
            'title'   => 'Website Domains',
            'domains' => $domains
        ]);
    }
}
