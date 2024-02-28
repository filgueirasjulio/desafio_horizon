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
        Schema::create('flight_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained('flights');
            $table->foreignId('travel_class_id')->constrained('travel_classes');
            $table->foreignId('passenger_id')->nullable()->constrained('users');
            $table->string('seat_number')->index();
            $table->string('travel_flight')->index();
            $table->boolean('is_occupied')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_seats');
    }
};
