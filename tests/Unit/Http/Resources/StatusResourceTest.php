<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Models\Status;
use Tests\TestCase;
use App\Http\Resources\StatusResource;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{

    use RefreshDatabase;
    /** @test */
    public function a_status_resources_must_huve_the_necesary_fiels()
    {
        $status = Status::factory()->create();
        Comment::factory()->create(['status_id' => $status->id]);

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals(
            $status->id,
            $statusResource['id']
        );
        $this->assertEquals(
            $status->body,
            $statusResource['body']
        );
        $this->assertEquals(
            $status->user->link(),
            $statusResource['user_link']
        );
        $this->assertEquals(
            $status->user->name,
            $statusResource['user_name']
        );
        $this->assertEquals(
            $status->user->avatar(),
            $statusResource['user_avatar']
        );
        $this->assertEquals(
            $status->created_at->diffForHumans(),
            $statusResource['ago']
        );

        $this->assertEquals(
            false,
            $statusResource['is_liked']
        );
        $this->assertEquals(
            0,
            $statusResource['likes_count']
        );

        $this->assertEquals(
            CommentResource::class,
            $statusResource['comments']->collects
        );
        $this->assertInstanceOf(
            Comment::class,
            $statusResource['comments']->first()->resource
        );


        /* $this->assertArrayHasKey('body',$statusResource); //key and resource
       $this->assertArrayHasKey('user_name',$statusResource);
       $this->assertArrayHasKey('user_avatar',$statusResource);
       $this->assertArrayHasKey('ago',$statusResource);*/
    }
}
