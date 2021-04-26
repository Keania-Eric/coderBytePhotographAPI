<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoshootRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photoshoot_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('requester_id');
            $table->integer('photographer_id');
            $table->integer('status')->default(1)->comment("1 - Pending, 2 - Shoot , 3 - declined");
            $table->datetime('availability_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photoshoot_requests');
    }
}
