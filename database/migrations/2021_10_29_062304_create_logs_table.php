<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beacon_id')->unsigned();
            $table->bigInteger('device_id')->unsigned();
            $table->foreign('beacon_id')->references('id')->on('beacons')->onDelete('cascade')->nullable();
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->nullable();
            $table->string('geolocation')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
