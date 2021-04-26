<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotoshootRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A product owner can create photoshoot request
     * 
     * @group coderbyte
     *
     * @return void
     */
    public function test_productowner_can_create_photoshoot_request()
    {
        Sanctum::actingAs(
            User::factory()->productOwner()->create(),
            ['role:productowner']
        );

        $photographer = User::factory()->photographer()->create();

        $data = [ 'photographer_id'=> $photographer->id];
    
       $url = route('api.v1.request-photoshoot');

       $response = $this->JSON('POST', $url, $data);
      
       $response->assertStatus(200);
    }
}
