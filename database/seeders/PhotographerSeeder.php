<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PhotographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->photographer()->->count(50)->create();
    }
}
