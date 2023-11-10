<?php

namespace Http\Forms;

use Core\Validator;

class PostForm extends Form
{
    protected static $validateImage = true;

    public static function skipImageValidation()
    {
        static::$validateImage = false;
    }

    protected function handleValidate()
    {
        if (!Validator::string($this->attribute('title', ''), 1, 256)) {
            $this->error('title', "Isian 'title' harus diisi dengan maksimal 256 karakter.");
        }

        if (!Validator::string($this->attribute('content', ''), 1, 1000)) {
            $this->error('content', "Isian 'content' harus diisi dengan maksimal 1000 karakter.");
        }

        if (!Validator::integer($this->attribute('status', ''))) {
            $this->error('status', "Isian 'status' harus berupa angka.");
        }

        if (!Validator::in($this->attribute('status', ''), [1, 2, -1])) {
            $this->error('status', "Isian 'status' tidak valid.");
        }

        if (static::$validateImage) {
            $this->validateFile();
        }
    }

    protected function validateFile()
    {
        if (!Validator::file('image')) {
            $this->error('image', "File yang anda unggah tidak valid.");
            return;
        }

        if (!Validator::fileExtension('image', ['jpg', 'png', 'jpeg'])) {
            $this->error('image', "Ekstensi dari file yang anda unggah tidak valid.");
            return;
        }

        $minSize = 51200; // 50 KB
        $maxSize = 143360; // 4194304; // 4 MB

        $minSizeInKB = $minSize / 1024;
        $maxSizeInKB = $maxSize / 1024;

        if (!Validator::fileSize('image', $minSize, $maxSize)) { // 7KB, 4MB
            $this->error('image', "Ukuran file yang anda unggah tidak valid, ukuran minimal {$minSizeInKB} KB dan maksimal {$maxSizeInKB} KB");
            return;
        }
    }

    public function uploadFile()
    {
        $file = $_FILES['image'] ?? null;
        if (empty($file)) {
            $this->error('image', 'Silahkan pilih file.')->throw();
            return;
        }

        $fileInfo = pathinfo($file['name']);

        $filename = time() . ".{$fileInfo['extension']}";
        $filePath = "uploads/{$filename}";
        $destination = public_path($filePath);

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            $this->error('image', 'Gagal melakukan upload file, silahkan coba dalam beberapa saat lagi.')->throw();
            return;
        }
        
        $this->attributes['image'] = $filePath;
    }
}
