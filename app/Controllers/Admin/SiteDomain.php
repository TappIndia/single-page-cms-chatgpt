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

    public function create()
    {
        $db = Database::connect();

        $sites = $db->table('site')
            ->select('id, name')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_domain/create', [
            'title' => 'Add Domain',
            'sites' => $sites
        ]);
    }

    public function edit($id)
    {
        $db = Database::connect();

        $domain = $db->table('site_domain')
            ->where('id', (int) $id)
            ->get()
            ->getRowArray();

        if (!$domain) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $sites = $db->table('site')
            ->select('id, name')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_domain/edit', [
            'title'  => 'Edit Domain',
            'domain' => $domain,
            'sites'  => $sites
        ]);
    }
    public function update($id)
    {
        $id = (int) $id;
        $siteId = (int) $this->request->getPost('site_id');
        $domain = strtolower(trim((string) $this->request->getPost('domain')));
        $isPrimary = $this->request->getPost('is_primary') ? 1 : 0;
        $status = (string) $this->request->getPost('status');

        if (
            $siteId <= 0 ||
            !filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) ||
            !in_array($status, ['active', 'inactive'], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter valid domain details.');
        }

        $db = Database::connect();

        $existing = $db->table('site_domain')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$existing) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $site = $db->table('site')
            ->where('id', $siteId)
            ->get()
            ->getRowArray();

        if (!$site) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected website does not exist.');
        }

        $duplicate = $db->table('site_domain')
            ->where('domain', $domain)
            ->where('id !=', $id)
            ->countAllResults();

        if ($duplicate > 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This domain is already registered.');
        }

        $db->transBegin();

        try {
            if ($isPrimary) {
                $db->table('site_domain')
                    ->where('site_id', $siteId)
                    ->where('id !=', $id)
                    ->update(['is_primary' => 0]);
            }

            $db->table('site_domain')
                ->where('id', $id)
                ->update([
                    'site_id'    => $siteId,
                    'domain'     => $domain,
                    'is_primary' => $isPrimary,
                    'status'     => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Database operation failed.');
            }

            $db->transCommit();

        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Domain update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Unable to update domain. Please try again.');
        }

        return redirect()->to(site_url('admin/domains'))
            ->with('success', 'Domain updated successfully.');
    }
    public function store()
    {
        $siteId = (int) $this->request->getPost('site_id');
        $domain = strtolower(trim((string) $this->request->getPost('domain')));
        $isPrimary = $this->request->getPost('is_primary') ? 1 : 0;

        if ($siteId <= 0 || !filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid website and enter a valid domain.');
        }

        $db = Database::connect();

        $site = $db->table('site')
            ->where('id', $siteId)
            ->get()
            ->getRowArray();

        if (!$site) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected website does not exist.');
        }

        if ($db->table('site_domain')->where('domain', $domain)->countAllResults() > 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This domain is already registered.');
        }

        $db->transBegin();

        try {
            if ($isPrimary) {
                $db->table('site_domain')
                    ->where('site_id', $siteId)
                    ->update(['is_primary' => 0]);
            }

            $db->table('site_domain')->insert([
                'site_id'     => $siteId,
                'domain'      => $domain,
                'is_primary'  => $isPrimary,
                'is_verified' => 0,
                'status'      => 'active',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Database operation failed.');
            }

            $db->transCommit();

        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Domain creation failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Unable to save domain. Please try again.');
        }

        return redirect()->to(site_url('admin/domains'))
            ->with('success', 'Domain added successfully.');
    }

    public function delete($id)
    {
        $id = (int) $id;

        $db = Database::connect();

        $domain = $db->table('site_domain')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$domain) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $db->table('site_domain')
            ->where('id', $id)
            ->delete();

        return redirect()->to(site_url('admin/domains'))
            ->with('success', 'Domain deleted successfully.');
    }
}