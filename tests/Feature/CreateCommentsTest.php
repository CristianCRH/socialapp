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

        $respose=$this->actingAs($user)
            ->postJson(route('statuses.comments.store',$status),$comment);

        $respose->assertJson([
            'data'=>['body'=>$comment['body']]
        ]);

        $this->assertDatabaseHas('comments',[
            'user_id'=>$user->id,
            'status_id'=>$status->id,
            'body'=>$comment['body'],
        ]);
    }

    
    /** @test */
    public function a_comment_requires_a_body()
    {
        $status=Status::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $respose = $this->postJson(route('statuses.comments.store',$status), ['body' => '']);

        $respose->assertStatus(422);

        $respose->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
