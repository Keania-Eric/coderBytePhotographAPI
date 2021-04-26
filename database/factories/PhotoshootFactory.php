<?php

namespace Database\Factories;

use App\Models\Photoshoot;
use App\Models\PhotoshootRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoshootFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photoshoot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $photoRequest = PhotoshootRequest::factory()->create();

        return [
            //
            'requester_id'=> $photoRequest->requester->id,
            'photographer_id'=> $photoRequest->photographer->id,
            'request_id'=> $photoRequest->id,
            'status'=> 1
        ];
    }
}
