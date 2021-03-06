<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    
    /**
     * The created user has a role of photographer
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function photographer()
    {
        return $this->state(function (array $attributes) {
            return [
                'role'=> 1
            ];
        });
    }

    
    /**
     * The created user has a role of product owner
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function productOwner()
    {
        return $this->state(function (array $attributes) {
            return [
                'role'=> 2
            ];
        });
    }
}
