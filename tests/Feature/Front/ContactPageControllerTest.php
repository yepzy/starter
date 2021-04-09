<?php

namespace Tests\Feature\Front;

use App\Models\PageContents\TitleDescriptionPageContent;
use App\Models\Pages\Page;
use App\Models\Settings\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactPageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
    }

    /** @test */
    public function it_can_display_contact_page(): void
    {
        TitleDescriptionPageContent::factory()->contact()
            ->withTitleH1Brick()
            ->withOneTextColumnBrick()
            ->withSeoMeta()
            ->create();
        $settings = Settings::factory()->withMedia()->create();
        $termsOfServicePage = Page::factory()->create([
            'unique_key' => 'terms_of_service_page',
            'nav_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
        ]);
        $gdprPage = Page::factory()->create([
            'unique_key' => 'gdpr_page',
            'nav_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
        ]);
        $this->get(route('contact.page.show'))
            ->assertOk()
            // Contact form is displayed.
            ->assertSeeInOrder([
                'action="' . route('contact.sendMessage') . '"',
                'name="first_name"',
                'name="last_name"',
                'name="email"',
                'name="phone_number"',
                'name="message"',
            ], false)
            // Terms of service and GDPR messages are displayed.
            ->assertSee(__(
                'By clicking on the "Send" button, I acknowledge that I have read the '
                . ':terms_of_service_page_link, :gdpr_page_link pages and that this data will be used in the context '
                . 'of the commercial relationship that may result from it.',
                [
                    'terms_of_service_page_link' => '<a href="' . route('page.show', $termsOfServicePage)
                        . '" title="'
                        . $termsOfServicePage->nav_title . '" target="_blank">' . $termsOfServicePage->nav_title
                        . '</a>',
                    'gdpr_page_link' => '<a href="' . route('page.show', $gdprPage) . '" title="'
                        . $gdprPage->nav_title . '" target="_blank">' . $gdprPage->nav_title . '</a>',
                ]
            ), false)
            ->assertSee(__(
                'Your personal data is subject to computer processing by :company, in order to answer '
                . 'your questions and/or complaints. You have a right of access, rectification, opposition, limitation '
                . 'and portability by contacting: :email or by mail to: :postal_address. You also have the right to '
                . 'lodge a complaint with the CNIL.',
                [
                    'company' => config('app.name'),
                    'email' => $settings->email,
                    'postal_address' => $settings->full_postal_address,
                ]
            ))
            ->assertSeeInOrder([
                // Contact information is displayed.
                config('app.name'),
                $settings->phone_number,
                $settings->email,
                $settings->full_postal_address,
                'href="https://www.google.com/maps/embed/v1/place?key=' . config('services.google.key') . '&q='
                . str_replace([' ', ','], '+', $settings->full_postal_address) . '"',
            ], false)
        ;
    }
}
