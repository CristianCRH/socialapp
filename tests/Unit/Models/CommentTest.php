<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_comment_belongs_to_a_user()
    {
        $comment = Comment::factory()->create();
        $this->assertInstanceOf(User::class, $comment->user);
    }

    /** @test */
    public function a_comment_morp_many_likes()
    {

        $comment = Comment::factory()->create();

        Like::factory()->create([
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment),
        ]);

        $this->assertInstanceOf(Like::class, $comment->likes->first());
    }
}
