<?php

namespace App\Controllers\Website;

use App\Controllers\BaseController;
use Config\Database;

class Site extends BaseController
{
    public function home()
    {
        return $this->renderPage(null);
    }

    public function page(string $slug)
    {
        return $this->renderPage($slug);
    }

    private function renderPage(?string $slug)
    {
        $db = Database::connect();
        $host = strtolower(service('request')->getServer('HTTP_HOST') ?? '');
        $host = preg_replace('/:\d+$/', '', $host);

        $site = null;

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
            return $this->response->setStatusCode(404)
                ->setBody('Website not found.');
        }

        // Load the site's selected template.
        $template = $db->table('template')
            ->where('id', $site['template_id'])
            ->where('status', 'active')
            ->get()
            ->getRowArray();

        if (!$template) {
            return $this->response->setStatusCode(404)
                ->setBody('Website template not found.');
        }

        $pageQuery = $db->table('site_page')
            ->where('site_id', $site['id'])
            ->where('is_enabled', 1)
            ->where('status', 'published');

        if ($slug === null || $slug === '') {
            $pageQuery->where('is_homepage', 1);
        } else {
            $pageQuery->where('slug', $slug);
        }

        $page = $pageQuery->get()->getRowArray();

        if (!$page) {
            return $this->response->setStatusCode(404)
                ->setBody('Page not found.');
        }

        // Load only variations enabled for this site's template.
        $sections = $db->table('site_page_section ps')
            ->select('ss.*, CASE WHEN tsv.id IS NOT NULL THEN sv.view_file ELSE NULL END AS variation_view_file', false)
            ->join('site_section ss', 'ss.id = ps.site_section_id')
            ->join('section_type st', 'st.type_key = ss.section_type', 'left')
            ->join(
                'section_variation sv',
                'sv.section_type_id = st.id AND sv.variation_key = ss.view_key AND sv.is_active = 1',
                'left'
            )
            ->join(
                'template_section_variation tsv',
                'tsv.section_variation_id = sv.id AND tsv.template_id = ' . (int) $site['template_id'] . ' AND tsv.is_enabled = 1',
                'left'
            )
            ->where('ps.page_id', $page['id'])
            ->where('ps.is_enabled', 1)
            ->where('ss.site_id', $site['id'])
            ->where('ss.is_enabled', 1)
            ->orderBy('ps.sort_order', 'ASC')
            ->get()
            ->getResultArray();

        $designRows = $db->table('site_design_setting')
            ->where('site_id', $site['id'])
            ->get()
            ->getResultArray();

        $design = [];

        foreach ($designRows as $row) {
            $value = $row['custom_value'] ?? $row['default_value'];
            $design[$row['setting_key']] = json_decode($value, true) ?? $value;
        }

        return view('website/page', [
            'site' => $site,
            'template' => $template,
            'page' => $page,
            'sections' => $sections,
            'design' => $design,
        ]);
    }
}