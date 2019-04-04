<?php

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        // todo : customize settings and seeder image
        $settings = (new Settings)->create([
//            'email'        => null,
//            'phone_number' => null,
//            'location'     => null,
//            'address'      => null,
//            'zip_code'     => null,
//            'city'         => null,
//            'facebook'     => null,
//            'instagram'    => null,
        ]);
        $settings->addMedia(database_path('seeds/files/settings/icon-300-300.png'))
            ->preservingOriginal()
            ->toMediaCollection('icon');
    }
}
