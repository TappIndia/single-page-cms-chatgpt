<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class SiteMedia extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $media = $db->table('site_media sm')
            ->select('
                sm.id,
                s.name AS site_name,
                sm.file_name,
                sm.original_name,
                sm.file_path,
                sm.file_type,
                sm.mime_type,
                sm.file_extension,
                sm.file_size,
                sm.alt_text,
                sm.status,
                sm.created_at
            ')
            ->join('site s', 's.id = sm.site_id')
            ->orderBy('sm.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/site_media/index', [
            'title' => 'Website Media',
            'media' => $media
        ]);
    }
}
