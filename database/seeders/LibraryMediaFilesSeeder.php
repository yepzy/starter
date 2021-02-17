<?php

namespace Database\Seeders;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Database\Seeder;

class LibraryMediaFilesSeeder extends Seeder
{
    public function run(): void
    {
        LibraryMediaFile::factory()->image()->withCategory()->create();
        LibraryMediaFile::factory()->pdf()->withCategory()->create();
        LibraryMediaFile::factory()->audio()->withCategory()->create();
        LibraryMediaFile::factory()->video()->withCategory()->create();
        LibraryMediaFile::factory()->doc()->withCategory()->create();
    }
}
