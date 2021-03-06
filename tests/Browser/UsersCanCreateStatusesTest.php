<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanCreateStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function users_can_create_statuses()
    {
        $user=User::factory()->create();
        $this->browse(function (Browser $browser) use($user){

            $browser->loginAs($user)
                    ->visit('/')
                    ->type('body','My first statusss')
                    ->press('#create-status')
                   ->screenshot('create-status')
                   ->waitForText('My first statusss')
                    ->assertSee('My first statusss')
                    ->assertSee($user->name);

        });
    }
}
