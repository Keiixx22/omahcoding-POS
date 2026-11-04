<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Pilihan bahasa dihapus: semua tampilan Indonesia, walau kolom businesses.language lama berisi 'en'.
 *  php artisan test --filter=LanguageSettingTest
 */
class LanguageSettingTest extends TestCase
{
    use RefreshDatabase;

    private function admin(string $language = 'id'): User
    {
        $cat = BusinessCategory::first() ?? BusinessCategory::create([
            'slug' => 'cafe', 'name' => 'Cafe', 'icon' => 'x', 'color' => 'blue', 'tagline' => 't',
            'features' => 'x', 'badge' => null, 'preset' => [], 'is_active' => true, 'sort_order' => 1,
        ]);
        $b = Business::create([
            'business_category_id' => $cat->id, 'code' => 'LANG1', 'name' => 'Lang', 'owner_name' => 'Owner',
            'email' => 'lang@t.test', 'status' => 'active',
        ]);
        $b->forceFill(['language' => $language])->save();

        return User::create([
            'business_id' => $b->id, 'name' => 'Admin', 'email' => Str::lower(Str::random(8)) . '@t.test',
            'password' => 'Str0ng-Passw0rd!', 'role' => 'admin', 'is_active' => true,
        ]);
    }

    public function test_pos_is_indonesian(): void
    {
        $this->actingAs($this->admin())->get(route('pos'))->assertOk()->assertSee('Keranjang')->assertDontSee('Walk-in Customer');
    }

    public function test_legacy_english_business_still_sees_indonesian(): void
    {
        $this->actingAs($this->admin('en'))->get(route('pos'))->assertOk()->assertSee('Keranjang');
    }

    public function test_language_route_removed(): void
    {
        $this->actingAs($this->admin())->put('/settings/language', ['language' => 'en'])->assertNotFound();
    }
}
