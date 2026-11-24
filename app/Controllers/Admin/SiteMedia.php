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

    public function create()
    {
        $db = Database::connect();

        $sites = $db->table('site')
            ->select('id, name')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/site_media/create', [
            'title' => 'Upload Media',
            'sites' => $sites
        ]);
    }

    public function upload()
    {
        $siteId = (int) $this->request->getPost('site_id');
        $altText = trim((string) $this->request->getPost('alt_text'));

        $db = Database::connect();

        $site = $db->table('site')
            ->where('id', $siteId)
            ->get()
            ->getRowArray();

        if (!$site) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid website.');
        }

        $file = $this->request->getFile('media_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid file.');
        }

        if ($file->hasMoved()) {
            return redirect()->back()
                ->with('error', 'This file has already been uploaded.');
        }

        if ($file->getSizeByUnit('b') > 10 * 1024 * 1024) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Maximum file size is 10 MB.');
        }

        $extension = strtolower($file->getExtension());
        $mimeType = strtolower($file->getMimeType());

        $allowedTypes = [
            'jpg'  => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png'  => ['image/png'],
            'gif'  => ['image/gif'],
            'webp' => ['image/webp'],
            'pdf'  => ['application/pdf'],
            'doc'  => ['application/msword'],
            'docx' => [
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/zip'
            ],
        ];

        if (
            !isset($allowedTypes[$extension]) ||
            !in_array($mimeType, $allowedTypes[$extension], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'File type is not allowed or does not match its extension.');
        }

        $fileType = in_array(
            $extension,
            ['jpg', 'jpeg', 'png', 'gif', 'webp'],
            true
        ) ? 'image' : 'document';

        $uploadDirectory = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $siteId;

        if (
            !is_dir($uploadDirectory) &&
            !mkdir($uploadDirectory, 0750, true) &&
            !is_dir($uploadDirectory)
        ) {
            return redirect()->back()
                ->with('error', 'Unable to create the upload directory.');
        }

        $originalName = $file->getClientName();
        $fileName = $file->getRandomName();

        try {
            $file->move($uploadDirectory, $fileName);

            $relativePath = 'uploads/' . $siteId . '/' . $fileName;

            $inserted = $db->table('site_media')->insert([
                'site_id'        => $siteId,
                'file_name'      => $fileName,
                'original_name'  => $originalName,
                'file_path'      => $relativePath,
                'file_type'      => $fileType,
                'mime_type'      => $mimeType,
                'file_extension' => $extension,
                'file_size'      => $file->getSizeByUnit('b'),
                'alt_text'       => $altText !== '' ? $altText : null,
                'metadata_json'  => null,
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);

            if (!$inserted) {
                throw new \RuntimeException('Database insertion failed.');
            }

        } catch (\Throwable $e) {
            $uploadedPath = $uploadDirectory . DIRECTORY_SEPARATOR . $fileName;

            if (is_file($uploadedPath)) {
                unlink($uploadedPath);
            }

            log_message('error', 'Media upload failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Upload failed. Please try again.');
        }

        return redirect()->to(site_url('admin/media'))
            ->with('success', 'Media uploaded successfully.');
    }
    
    public function view($id)
    {
        $db = Database::connect();

        $media = $db->table('site_media')
            ->where('id', (int) $id)
            ->where('status', 'active')
            ->get()
            ->getRowArray();

        if (!$media) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'application/pdf'
        ];

        if (!in_array($media['mime_type'], $allowedMimeTypes, true)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filePath = WRITEPATH . str_replace(
            ['/', '\\'],
            DIRECTORY_SEPARATOR,
            $media['file_path']
        );

        if (!is_file($filePath)) {
            log_message('error', 'Media file not found: ' . $filePath);
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', $media['mime_type'])
            ->setHeader('Content-Length', (string) filesize($filePath))
            ->setHeader('X-Content-Type-Options', 'nosniff')
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($media['file_name']) . '"')
            ->setBody(file_get_contents($filePath));
    }

}

