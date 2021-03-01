<?php

namespace Tests\Browser;

use App\Models\Status;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanSeeAllStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function users_can_see_all_statuses_on_the_homepages()
    {
        $statuses=Status::factory(3)->create(['created_at'=>now()->subMinute()]);
        $this->browse(function (Browser $browser)use($statuses) {
            $browser->visit('/')
                    ->waitForText($statuses->first()->body);
                    //->assertSee($statuses->first()->body);
                    foreach ($statuses as $status) {
                       $browser ->assertSee($status->body)
                                ->assertSee($status->user->name);
                          //      ->assertSee($status->created_at->diffForHumans());
                    }
        });
    }
}
