<?php

namespace Tests\Feature\Admin;

use App\Models\Settings\Settings;
use App\Models\Users\User;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class]);
    }

    /** @test */
    public function it_can_display_settings_edit_page(): void
    {
        $settings = Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)
            ->get(route('settings.edit'))
            ->assertOk()
            ->assertSeeInOrder([
                // Settings data is displayed.
                $settings->getFirstMediaUrl('logo_squared', 'thumb'),
                $settings->getFirstMedia('logo_squared')->file_name,
                $settings->email,
                $settings->phone_number,
                $settings->address,
                $settings->zip_code,
                $settings->city,
                $settings->facebook_url,
                $settings->twitter_url,
                $settings->instagram_url,
                $settings->youtube_url,
                $settings->google_tag_manager_id,
            ]);
    }

    /** @test */
    public function it_can_update_settings(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->put(route('settings.update'), [
                'logo_squared' => UploadedFile::fake()->image('logo-squared.webp', 225, 225),
                'email' => 'test@email.fr',
                'phone_number' => '0202020202',
                'address' => 'Address test',
                'zip_code' => 'Zip code test',
                'city' => 'City test',
                'facebook_url' => 'https://www.facebook.com',
                'twitter_url' => 'https://twitter.com',
                'instagram_url' => 'https://www.instagram.com',
                'youtube_url' => 'https://www.youtube.com',
                'google_tag_manager_id' => 'GTM test',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.name.updated', ['name' => __('Settings')]))
            ->assertRedirect(route('settings.edit'));
        /** @var \App\Models\Settings\Settings $settings */
        $settings = Settings::sole();
        // Settings data is updated.
        $this->assertDatabaseHas(app(Settings::class)->getTable(), [
            'email' => 'test@email.fr',
            'phone_number' => '0202020202',
            'address' => 'Address test',
            'zip_code' => 'Zip code test',
            'city' => 'City test',
            'facebook_url' => 'https://www.facebook.com',
            'twitter_url' => 'https://twitter.com',
            'instagram_url' => 'https://www.instagram.com',
            'youtube_url' => 'https://www.youtube.com',
            'google_tag_manager_id' => 'GTM test',
        ]);
        // Settings logo is updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $settings->id,
            'model_type' => Settings::class,
            'collection_name' => 'logo_squared',
            'file_name' => 'logo-squared.webp',
        ]);
    }
}
