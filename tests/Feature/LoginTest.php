<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test login works 
     * @group coderbyte
     * @return void
     */
    public function test_user_can_login()
    {
       $user = User::factory()->photographer()->create();
       
       $data['password'] = 'password';

       $data['email']= $user->email;
    
       $url = route('api.v1.login');

       $response = $this->JSON('POST', $url, $data);

       $response->assertStatus(200);
    }
}
