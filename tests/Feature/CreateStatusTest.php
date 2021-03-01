<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_can_not_create_statuses()
    {
        $respose = $this->postJson(route('statuses.store'), ['body' => 'My first status']);
        //dd($respose->content());
        $respose->assertStatus(401);
    }

    public function test_a_user_can_create_statuses()
    {
        // $this->withoutExceptionHandling();
        //1. Gieven => Tenienfo un usuario Autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        //2. When => Cuando hace un post  request a status
        $respose = $this->postJson(route('statuses.store'), ['body' => 'My first status']);

        $respose->assertJson([
           'data'=>['body' => 'My first status']
        ]);

        //3. then =>Entonces vemos un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'My first status',
        ]);
    }

    /** @test */
    public function a_status_requires_a_body()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $respose = $this->postJson(route('statuses.store'), ['body' => '']);

        $respose->assertStatus(422);

        $respose->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }

    /** @test */
    public function a_status_requires_a_minium_length()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $respose = $this->postJson(route('statuses.store'), ['body' => 'abcd']);

        $respose->assertStatus(422);

        $respose->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
