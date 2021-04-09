<?php

namespace Tests\Feature\Admin;

use App\Models\PageContents\TitleDescriptionPageContent;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Plank\Metable\Meta;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class ContactPageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class]);
        Settings::factory()->withMedia()->create();
    }

    /** @test */
    public function it_can_display_contact_page_edit_page(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $contactPage = TitleDescriptionPageContent::factory()->contact()->withSeoMeta()->create();
        // Seo meta data is displayed.
        $html = [
            $contactPage->getFirstMediaUrl('seo', 'thumb'),
            $contactPage->getFirstMedia('seo')->file_name,
        ];
        foreach (supportedLocaleKeys() as $localeKey) {
            $html[] = $contactPage->getMeta('meta_title', null, $localeKey);
        }
        foreach (supportedLocaleKeys() as $localeKey) {
            $html[] = $contactPage->getMeta('meta_description', null, $localeKey);
        }
        $this->actingAs($authUser)->get(route('contact.page.edit'))->assertOk()->assertSeeInOrder($html);
    }

    /** @test */
    public function it_can_update_contact_page(): void
    {
        $authUser = User::factory()->create();
        $contactPage = TitleDescriptionPageContent::factory()->contact()->create();
        $data = ['meta_image' => UploadedFile::fake()->image('meta-image.webp', 600, 600)];
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['meta_title'][$localeKey] = 'Title test FR';
            $data['meta_description'][$localeKey] = 'Title test FR';
        }
        $this->actingAs($authUser)
            ->from(route('contact.page.edit'))
            ->put(route('contact.page.update'), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.updated', [
                'entity' => __('Contact'),
                'name' => __('Page'),
            ]))
            ->assertRedirect(route('contact.page.edit'));
        // Meta data is updated.
        $this->assertDatabaseHas(app(Meta::class)->getTable(), [
            'metable_id' => $contactPage->id,
            'metable_type' => TitleDescriptionPageContent::class,
            'type' => 'array',
            'key' => 'meta_title',
            'value' => json_encode($data['meta_title'], JSON_THROW_ON_ERROR),
        ]);
        $this->assertDatabaseHas(app(Meta::class)->getTable(), [
            'metable_id' => $contactPage->id,
            'metable_type' => TitleDescriptionPageContent::class,
            'type' => 'array',
            'key' => 'meta_description',
            'value' => json_encode($data['meta_description']),
        ]);
        // Meta image is updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $contactPage->id,
            'model_type' => TitleDescriptionPageContent::class,
            'collection_name' => 'seo',
            'file_name' => 'meta-image.webp',
        ]);
    }

    /** @test */
    public function it_can_remove_seo_image(): void
    {
        $authUser = User::factory()->create();
        $contactPage = TitleDescriptionPageContent::factory()->contact()->create();
        $this->actingAs($authUser)
            ->from(route('contact.page.edit'))
            ->put(route('contact.page.update'), [
                // Uploaded meta image is ignored when instruction to remove it is given.
                'meta_image' => UploadedFile::fake()->image('meta-image.webp', 600, 600),
                'remove_meta_image' => true,
            ]);
        // Meta image is deleted.
        $this->assertDeleted(app(Media::class)->getTable(), [
            'model_id' => $contactPage->id,
            'model_type' => TitleDescriptionPageContent::class,
            'collection_name' => 'seo',
            'file_name' => 'meta-image.webp',
        ]);
    }
}
