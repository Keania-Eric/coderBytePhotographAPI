<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Models\PhotoshootRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadPhotoshootTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A photographer can upload photo shoot
     * 
     * @group coderbyte
     *
     * @return void
     */
    public function test_a_photographer_can_upload_photoshoots()
    {
        Storage::fake('public');
        
        Sanctum::actingAs(
            User::factory()->photographer()->create(),
            ['role:photographer']
        );

       $data = [
           'request_id'=> PhotoshootRequest::factory()->create()->id,
           'uploads'=> UploadedFile::fake()->image('avatar.jpg')
       ];
    
       $url = route('api.v1.photoshoot-upload');

       $response = $this->JSON('POST', $url, $data);
      
       $response->assertStatus(200);
    }
}
