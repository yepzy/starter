<?php

namespace Tests\Feature\Admin;

use App\Http\Middleware\ShareJavascriptToView;
use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Closure;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CookieCategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class, ShareJavascriptToView::class]);
        Settings::factory()->withMedia()->create();
    }

    /** @test */
    public function it_can_display_cookie_categories_list(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory1 = CookieCategory::factory()->create();
        $cookieCategory2 = CookieCategory::factory()->create();
        CookieService::factory()->withCategories([$cookieCategory1->unique_key])->create();
        CookieService::factory()
            ->withCategories([$cookieCategory1->unique_key, $cookieCategory2->unique_key])
            ->create();
        $this->actingAs($authUser)
            ->get(route('cookie.categories.index'))
            ->assertOk()
            ->assertSeeInOrder([
                // Cookie categories data is displayed in table columns.
                $cookieCategory1->id,
                $cookieCategory1->unique_key,
                $cookieCategory1->title,
                1, // 1 cookie service attached
                1, // Position 1
                $cookieCategory1->created_at->format('d/m/Y H:i'),
                $cookieCategory1->updated_at->format('d/m/Y H:i'),
                $cookieCategory2->id,
                $cookieCategory2->unique_key,
                $cookieCategory2->title,
                2, // 2 cookie service attached
                2, // Position 2
                $cookieCategory2->created_at->format('d/m/Y H:i'),
                $cookieCategory2->updated_at->format('d/m/Y H:i'),
            ]);
    }

    /** @test */
    public function it_can_display_cookie_category_create_page(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('cookie.category.create'))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                'fas fa-tags fa-fw',
                __('breadcrumbs.parent.create', [
                    'parent' => __('Cookies'),
                    'entity' => __('Categories'),
                ]),
                // Form data and back button route
                route('cookie.category.store'),
                route('cookie.categories.index'),
                __('Create'),
            ]);
    }

    /** @test */
    public function it_can_store_cookie_category(): void
    {
        $authUser = User::factory()->create();
        $data = ['unique_key' => 'unique_key_test'];
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['title'][$localeKey] = 'Title test ' . $localeKey;
            $data['description'][$localeKey] = 'Description test ' . $localeKey;
        }
        // Cache is cleared and regenerated after creation.
        Cache::shouldReceive('forget')->once()->with('cookie_categories')->andReturn(true);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('cookie_categories', Closure::class)
            ->andReturn(collect(app(CookieCategory::class)->fill($data)));
        $this->actingAs($authUser)
            ->post(route('cookie.category.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.parent.created', [
                'parent' => __('Cookies'),
                'entity' => __('Categories'),
                'name' => $data['title'][app()->getLocale()],
            ]))
            ->assertRedirect(route('cookie.categories.index'));
        // New cookie category is created.
        $databaseData = ['unique_key' => 'unique_key_test', 'position' => 1];
        foreach (supportedLocaleKeys() as $localeKey) {
            $databaseData["title->$localeKey"] = $data['title'][$localeKey];
            $databaseData["description->$localeKey"] = $data['description'][$localeKey];
        }
        $this->assertDatabaseHas(app(CookieCategory::class)->getTable(), $databaseData);
    }

    /** @test */
    public function it_can_display_cookie_category_edit_page(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory = CookieCategory::factory()->create();
        $this->actingAs($authUser)->get(route('cookie.category.edit', $cookieCategory))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                'fas fa-tags fa-fw',
                __('breadcrumbs.parent.edit', [
                    'parent' => __('Cookies'),
                    'entity' => __('Categories'),
                    'detail' => $cookieCategory->title,
                ]),
                // Form data and back button route
                route('cookie.category.update', $cookieCategory),
                route('cookie.categories.index'),
                __('Update'),
                // Cookie category data
                $cookieCategory->unique_key,
                $cookieCategory->title,
                $cookieCategory->description,
            ]);
    }

    /** @test */
    public function it_can_update_cookie_category(): void
    {
        $authUser = User::factory()->create();
        $cookieCategory = CookieCategory::factory()->create();
        $data = ['unique_key' => 'unique_key_test'];
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['title'][$localeKey] = 'Title test ' . $localeKey;
            $data['description'][$localeKey] = 'Description test ' . $localeKey;
        }
        // Cache is cleared and regenerated after update.
        Cache::shouldReceive('forget')->once()->with('cookie_categories')->andReturn(true);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('cookie_categories', Closure::class)
            ->andReturn(collect($cookieCategory));
        $this->actingAs($authUser)
            ->from(route('cookie.category.edit', $cookieCategory))
            ->put(route('cookie.category.update', $cookieCategory), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.parent.updated', [
                'parent' => __('Cookies'),
                'entity' => __('Categories'),
                'name' => $data['title'][app()->getLocale()],
            ]))
            ->assertRedirect(route('cookie.category.edit', $cookieCategory));
        // New cookie category is created.
        $databaseData = ['id' => $cookieCategory->id, 'unique_key' => 'unique_key_test', 'position' => 1];
        foreach (supportedLocaleKeys() as $localeKey) {
            $databaseData["title->$localeKey"] = $data['title'][$localeKey];
            $databaseData["description->$localeKey"] = $data['description'][$localeKey];
        }
        $this->assertDatabaseHas(app(CookieCategory::class)->getTable(), $databaseData);
    }

    /** @test */
    public function it_can_delete_cookie_category(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory = CookieCategory::factory()->create();
        // Cache is cleared and regenerated after deletion.
        Cache::shouldReceive('forget')->once()->with('cookie_categories')->andReturn(true);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('cookie_categories', Closure::class)
            ->andReturn(collect());
        $this->actingAs($authUser)
            ->from(route('cookie.categories.index'))
            ->delete(route('cookie.category.destroy', $cookieCategory))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.parent.destroyed', [
                'parent' => __('Cookies'),
                'entity' => __('Categories'),
                'name' => $cookieCategory->title,
            ]))
            ->assertRedirect(route('cookie.categories.index'));
        // Cookie category is deleted.
        $this->assertDatabaseMissing(app(CookieCategory::class)->getTable(), ['id' => $cookieCategory->id]);
    }
}
