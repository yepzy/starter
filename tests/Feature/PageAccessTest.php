<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PageAccessTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function homeAccessTest()
    {
        $this->artisan('db:seed --class=SettingsTableSeeder');
        $this->artisan('db:seed --class=SimplePagesTableSeeder');
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
