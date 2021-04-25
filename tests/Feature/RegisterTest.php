<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;
    /**
     * Test Registration works 
     * @group coderbyte
     * @return void
     */
    public function test_user_can_register()
    {
       $data = User::factory()->photographer()->make()->toArray();
       
       $data['password'] = 'password';
    
       $url = route('api.v1.register');

       $response = $this->JSON('POST', $url, $data);

       $response->assertStatus(200);
    }
}
