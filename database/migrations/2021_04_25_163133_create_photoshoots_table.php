<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoshootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photoshoots', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('requester_id');
            $table->integer('photographer_id');
            $table->integer('request_id');
            $table->integer('status')->default(1)->comments("1 - Pending , 2 - Accepted, 3 - Decline");
            $table->datetime('accepted_at')->nullable();
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
        Schema::dropIfExists('photoshoots');
    }
}
