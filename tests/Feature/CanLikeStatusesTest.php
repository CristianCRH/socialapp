<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Status;
use App\Models\User;
use Tests\TestCase;

class CanLikeStatusesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_can_not_like_statuses()
    {

        $status = Status::factory()->create();

        $respose = $this->postJson(route('statuses.like.store', $status));
        //dd($respose->content());
        $respose->assertStatus(401);
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_like_and_unlike_statuses()
    {

        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->assertCount(0, $status->likes);
        $this->actingAs($user)->postJson(route('statuses.like.store', $status));
        $this->assertCount(1, $status->fresh()->likes);

        $this->assertDatabaseHas('likes', ['user_id' => $user->id]);

        $this->actingAs($user)->deleteJson(route('statuses.like.destroy', $status));
        $this->assertCount(0, $status->fresh()->likes);

        $this->assertDatabaseMissing('likes', ['user_id' => $user->id]);

    }

}
