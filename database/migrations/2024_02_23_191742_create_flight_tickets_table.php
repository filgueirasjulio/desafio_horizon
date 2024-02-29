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
        Schema::create('flight_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_seat_id')->constrained('flight_seats')->onDelete('cascade');
            $table->integer('number');
            $table->decimal('ticket_price', 8, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_tickets');
    }
};
