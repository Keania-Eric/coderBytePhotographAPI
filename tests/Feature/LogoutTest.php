<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Logout works 
     * @group coderbyte
     * @return void
     */
    public function test_user_can_logout()
    {
        Sanctum::actingAs(
            User::factory()->photographer()->create(),
            ['*']
        );
    
       $url = route('api.v1.logout');

       $response = $this->JSON('POST', $url);
    
       $response->assertStatus(200);
    }
}
