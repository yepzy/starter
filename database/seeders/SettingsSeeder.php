<?php

namespace Database\Seeders;

use App\Models\Settings\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Settings::factory()->withMedia()->create([
            // Todo: set custom settings.
        ]);
    }
}
