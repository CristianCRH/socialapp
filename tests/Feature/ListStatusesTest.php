<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListStatusesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_get_all_statuses()
    {
        $this->withoutExceptionHandling();

        $status1=Status::factory()->create(['created_at'=>now()->subDays(4)]);
        $status2=Status::factory()->create(['created_at'=>now()->subDays(3)]);
        $status3=Status::factory()->create(['created_at'=>now()->subDays(2)]);
        $status4=Status::factory()->create(['created_at'=>now()->subDays(1)]);

        $respose=$this->getJson(route('statuses.index'));
    
        $respose->assertSuccessful();

        $respose->assertJson([
            'meta'=>['total'=>4]
        ]);

        $respose->assertJsonStructure([
            'data','links'=>['prev','next']
        ]);

       $this->assertEquals(
           $status4->body,
            $respose->json('data.0.body')
        );

      //  dd($respose->json('data'));
    }
}
