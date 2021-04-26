<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Photoshoot;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApprovesPhotoshootTest extends TestCase
{
    /**
     * Approving a photoshoot works
     * @group coderbyte
     * 
     * @return void
     */
    public function test_productowner_can_approve_a_photoshoot()
    {
        $photoshoot  = Photoshoot::factory()->create();

        Sanctum::actingAs(
            $photoshoot->requester,
            ['role:productowner']
        );

        $data = ['shoot_id'=> $photoshoot->id];

        $url = route('api.v1.photoshoot-approve');

        $response = $this->JSON('POST', $url, $data);
        
       $response->assertStatus(200);


    }
}
