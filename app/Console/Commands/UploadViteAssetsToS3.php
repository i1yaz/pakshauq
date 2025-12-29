<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class UploadViteAssetsToS3 extends Command
{
    protected $signature = 'vite:upload-s3';
    protected $description = 'Upload Vite build assets to S3';

    public function handle()
    {
        $localPath = public_path('build');
        $prefix = getStoragePrefix();
        $s3Path = $prefix.'/build';

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($localPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = str_replace($localPath . DIRECTORY_SEPARATOR, '', $filePath);
                $s3Key = $s3Path . '/' . $relativePath;
                Storage::disk('r2')->put($s3Key, file_get_contents($filePath), 'public');

                $this->info("Uploaded: {$s3Key}");
            }
        }

        $this->info('Vite assets uploaded to S3 successfully.');
    }
}
