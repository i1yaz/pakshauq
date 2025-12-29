<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Models\Admin\Player;
use App\Models\Admin\Slider;
use App\Models\Admin\Tournament;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UploadAssetsToS3 extends Command
{
    protected $signature = 'assets:upload-s3';
    protected $description = 'Upload public assets to S3 with structured folders and custom prefix';

    public function handle()
    {
        $prefix = getStoragePrefix();
        $disk = Storage::disk('r2');

        // 1. Upload website/img and website/vendor folders
        $this->uploadFolder('website/img', "$prefix/website/img", $disk);
        
        $this->uploadFolder('website/vendor', "$prefix/website/vendor", $disk);
        $this->uploadFolder('adminlte', "$prefix/adminlte", $disk);
        $this->uploadFolder('plugins', "$prefix/plugins", $disk);
        $this->uploadFile('website/profiles/profile.png', "$prefix/website/profiles/profile.png", $disk);
        $this->uploadFile('website/profiles/profile-square.png', "$prefix/website/profiles/profile-square.png", $disk);

        // 2. Upload sliders/default/*
        $this->uploadFolder('website/sliders/default', "$prefix/website/sliders/default", $disk);
        dd('website/vendor');
        // 3. Upload images from sliders table
        $sliders = Slider::all();
        foreach ($sliders as $slider) {
            if ($slider->slider) {
                $sliderImage = explode('?', $slider->slider);
                $sliderFile = $sliderImage[0];
                $sourcePath = "website/sliders/{$sliderFile}";
                $destPath = "$prefix/website/sliders/{$sliderFile}";

                if (file_exists(public_path($sourcePath))) {
                    $this->uploadFile($sourcePath, $destPath, $disk);
                    $slider->slider = $sliderFile;
                    $slider->save();
                }
            }
        }

        // 4. Upload each player's poster
        $players = Player::whereNotNull('poster')->get();
        foreach ($players as $player) {
            if ($player->poster) {
                $playerPoster = explode('?', $player->poster);
                $posterFile = $playerPoster[0];
                $sourcePath = "website/profiles/{$posterFile}";
                $destPath = "$prefix/website/profiles/{$posterFile}";

                if (file_exists(public_path($sourcePath))) {
                    $this->uploadFile($sourcePath, $destPath, $disk);
                    $player->poster = $posterFile;
                    $player->save();
                } else {
                    $this->warn("Player poster not found: $sourcePath");
                }
            }
        }


        // 5. Upload images from Tournament table
        $tournaments = Tournament::whereNotNull('poster')->get();
        foreach ($tournaments as $tournament) {
            if ($tournament->poster) {
                $tournamentImage = explode('?', $tournament->poster);
                $tournamentFile = $tournamentImage[0];
                $sourcePath = "uploads/{$tournamentFile}";
                $destPath = "$prefix/uploads/{$tournamentFile}";
                
                if (file_exists(public_path($sourcePath))) {
                    $this->uploadFile($sourcePath, $destPath, $disk);
                    $tournament->poster = $tournamentFile;
                    $tournament->save();
                }
            }
        }

        $this->info('All specified assets have been uploaded to S3.');
    }

    protected function uploadFolder(string $localPath, string $s3Path, $disk)
    {
        $prefix = getStoragePrefix();
        $fullPath = public_path($localPath);
        if (!is_dir($fullPath)) {
            $this->warn("Directory not found: $fullPath");
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($fullPath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = str_replace(public_path(), '', $filePath);
            $relativePath = ltrim($relativePath, '/\\');
            $s3Key = $prefix . '/' . $relativePath;

            $disk->put($s3Key, file_get_contents($filePath), 'public');
        }
    }

    protected function uploadFile(string $localPath, string $s3Path, $disk)
    {
        $fullPath = public_path($localPath);
        if (file_exists($fullPath)) {
            $result = $disk->put($s3Path, file_get_contents($fullPath), 'public');
        } else {
            $this->warn("File not found: $fullPath");
        }
    }

    protected function deleteFile(string $s3Path, $disk)
    {
        try {
            $disk->delete($s3Path);
            $this->info("Deleted file: $s3Path");
        } catch (\Exception $e) {
            $this->error("Failed to delete file: $s3Path. Error: " . $e->getMessage());
        }
    }
}
