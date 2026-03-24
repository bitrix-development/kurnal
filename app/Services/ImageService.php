<?php
declare(strict_types=1);

namespace App\Services;

class ImageService
{
    private string $uploadDir;
    private array $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
    private int $maxSize = 10 * 1024 * 1024; // 10MB

    public function __construct()
    {
        $this->uploadDir = ROOT . '/public/uploads';
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0775, true);
        }
    }

    public function upload(array $file, string $subdir = ''): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new \RuntimeException('Upload error: ' . $file['error']);
        }

        if ($file['size'] > $this->maxSize) {
            throw new \RuntimeException('File too large (max 10MB)');
        }

        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $this->allowedMimes)) {
            throw new \RuntimeException('Invalid file type: ' . $mime);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $filename = uniqid('img_', true) . '.' . $ext;

        $targetDir = $this->uploadDir . ($subdir ? '/' . trim($subdir, '/') : '');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $targetPath = $targetDir . '/' . $filename;
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new \RuntimeException('Failed to move uploaded file');
        }

        return ($subdir ? $subdir . '/' : '') . $filename;
    }

    public function delete(string $path): void
    {
        $full = $this->uploadDir . '/' . ltrim($path, '/');
        if (file_exists($full)) {
            unlink($full);
        }
    }
}
