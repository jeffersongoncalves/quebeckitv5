<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JeffersonGoncalves\Quebec\Quebec;
use Tests\TestCase;

class QuebecSuiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_user_personal_data_is_declared(): void
    {
        $columns = collect(app(Quebec::class)->inventory())->where('model', User::class)->pluck('column')->all();

        $this->assertSame(['name', 'email'], $columns);
    }

    public function test_every_quebec_page_opens_in_the_admin_panel(): void
    {
        $this->actingAs(Admin::factory()->create(), 'admin');
        $panel = Filament::getPanel('admin');
        $ours = fn (string $class): bool => str_starts_with($class, 'JeffersonGoncalves\\Filament\\Quebec');

        $urls = collect($panel->getResources())->filter($ours)->map(fn (string $resource): string => $resource::getUrl('index', panel: 'admin'))
            ->merge(collect($panel->getPages())->filter($ours)->map(fn (string $page): string => $page::getUrl(panel: 'admin')));

        $this->assertGreaterThanOrEqual(10, $urls->count());

        foreach ($urls as $url) {
            $this->get($url)->assertOk();
        }

        $this->get('/admin')->assertOk()->assertSee('Quebec Law 25');
    }
}
