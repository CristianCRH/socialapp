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
         $status=Status::factory()->create();

          $respose = $this->postJson(route('statuses.like.store',$status));
          //dd($respose->content());
          $respose->assertStatus(401);
      }

    /**
     * @test
     */
    public function an_authenticated_user_can_like_statuses()
    {
        $this->withoutExceptionHandling();

        $user=User::factory()->create();
        $status=Status::factory()->create();
        
        $this->actingAs($user)->postJson(route('statuses.like.store',$status));
      
        $this->assertDatabaseHas('likes',[
            'user_id'=>$user->id,
            'status_id'=>$status->id,
        ]);

    }

    /** @test */
    public function an_authenticated_user_can_unlike_statuses()
    {
        $this->withoutExceptionHandling();

        $user=User::factory()->create();
        $status=Status::factory()->create();
        $this->actingAs($user)->postJson(route('statuses.like.store',$status));
      
        $this->actingAs($user)->deleteJson(route('statuses.like.destroy',$status));


        $this->assertDatabaseMissing('likes',[
            'user_id'=>$user->id,
            'status_id'=>$status->id,
        ]);

    }
}
