<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\PhotoshootRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoshootRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhotoshootRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productOwner = User::factory()->productOwner()->create();
        $photographer = User::factory()->photographer()->create();

        return [
            //
            'requester_id'=> $productOwner->id,
            'photographer_id'=> $photographer->id,
            'status'=> 1
        ];
    }
}
