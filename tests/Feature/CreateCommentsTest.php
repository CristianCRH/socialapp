<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function guest_users_cannot_create_comments(){

        $status=Status::factory()->create();
        $comment=['body'=>'Mi primer comentario'];
        
        $respose=$this->postJson(route('statuses.comments.store',$status),$comment);
        
        $respose->assertStatus(401);

    }

    /** @test */
    public function authenticated_users_can_comment_status(){

      //  $this->withoutExceptionHandling();

        $status=Status::factory()->create();
        $user=User::factory()->create();
        $comment=['body'=>'Mi primer comentario'];

        $this->actingAs($user)
            ->postJson(route('statuses.comments.store',$status),$comment);

        $this->assertDatabaseHas('comments',[
            'user_id'=>$user->id,
            'status_id'=>$status->id,
            'body'=>$comment['body'],
        ]);
    }
}
