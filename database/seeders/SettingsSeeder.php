<?php

namespace Database\Seeders;

use App\Models\Settings\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Todo: set client settings in seeder `create` method.
        Settings::factory()->withMedia()->create();
    }
}
