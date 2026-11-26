<?php

namespace App\Controllers\Website;

use App\Controllers\BaseController;
use Config\Database;

class Contact extends BaseController
{
    public function submit()
    {
        $rules = [
            'name'    => 'required|min_length[2]|max_length[150]',
            'email'   => 'required|valid_email|max_length[190]',
            'phone'   => 'permit_empty|max_length[30]',
            'subject' => 'permit_empty|max_length[255]',
            'message' => 'required|min_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        $host = strtolower(service('request')->getServer('HTTP_HOST') ?? '');
        $host = preg_replace('/:\d+$/', '', $host);

        if (in_array($host, ['localhost', '127.0.0.1'], true)
            && ENVIRONMENT === 'development') {
            $site = $db->table('site')
                ->where('status', 'active')
                ->orderBy('id', 'ASC')
                ->get()
                ->getRowArray();
        } else {
            $site = $db->table('site s')
                ->select('s.*')
                ->join('site_domain d', 'd.site_id = s.id')
                ->where('LOWER(d.domain)', $host)
                ->where('d.is_verified', 1)
                ->where('d.status', 'active')
                ->where('s.status', 'active')
                ->get()
                ->getRowArray();
        }

        if (!$site) {
            return redirect()->back()
                ->with('error', 'Website not found.');
        }

        $pageId = (int) $this->request->getPost('page_id');

        $page = $db->table('site_page')
            ->where('id', $pageId)
            ->where('site_id', $site['id'])
            ->where('is_enabled', 1)
            ->where('status', 'published')
            ->get()
            ->getRowArray();

        if (!$page) {
            return redirect()->back()
                ->with('error', 'Invalid page.');
        }

        $db->table('site_contact_submission')->insert([
            'site_id' => $site['id'],
            'page_id' => $page['id'],
            'name'    => trim($this->request->getPost('name')),
            'email'   => trim($this->request->getPost('email')),
            'phone'   => trim($this->request->getPost('phone') ?? ''),
            'subject' => trim($this->request->getPost('subject') ?? ''),
            'message' => trim($this->request->getPost('message')),
            'status'  => 'new',
        ]);

        return redirect()->back()
            ->with('success', 'Your message has been sent successfully.');
    }
}
