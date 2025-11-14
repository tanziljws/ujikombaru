<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $imagesPath = public_path('images');
        if (!is_dir($imagesPath)) {
            return;
        }

        $files = glob($imagesPath . DIRECTORY_SEPARATOR . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        foreach ($files as $filePath) {
            $filename = basename($filePath);

            // Skip if already imported
            if (Galeri::where('gambar', 'images/' . $filename)->exists()) {
                continue;
            }

            $title = Str::of(pathinfo($filename, PATHINFO_FILENAME))
                ->replace(['_', '-'], ' ')
                ->title();

            Galeri::create([
                'judul' => (string) $title,
                'gambar' => 'images/' . $filename,
                'type' => 'galeri',
            ]);
        }
    }
}


