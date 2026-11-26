<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class ContactSubmission extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $submissions = $db->table('site_contact_submission cs')
            ->select('
                cs.*,
                s.name AS site_name,
                p.title AS page_title
            ')
            ->join('site s', 's.id = cs.site_id')
            ->join('site_page p', 'p.id = cs.page_id', 'left')
            ->orderBy('cs.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/contact_submission/index', [
            'title' => 'Contact Submissions',
            'submissions' => $submissions
        ]);
    }
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        if (!in_array($status, ['new', 'read', 'replied', 'closed'], true)) {
            return redirect()->back()
                ->with('error', 'Invalid submission status.');
        }

        $db = Database::connect();

        $submission = $db->table('site_contact_submission')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$submission) {
            return redirect()->back()
                ->with('error', 'Contact submission not found.');
        }

        $db->table('site_contact_submission')
            ->where('id', $id)
            ->update([
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->to(site_url('admin/contact-submissions'))
            ->with('success', 'Submission status updated successfully.');
    }
}
