<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('airport_origin_id')->index();
            $table->unsignedBigInteger('airport_destination_id')->index();
            $table->bigInteger('flight_number')->unique()->index();
            $table->date('flight_date')->index();
            $table->time('departure_time')->index();
            $table->integer('seats_qty')->index();
            $table->timestamps();

            $table->foreign('airport_origin_id')->references('id')->on('airports');
            $table->foreign('airport_destination_id')->references('id')->on('airports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
