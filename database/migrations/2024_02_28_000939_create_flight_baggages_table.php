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
        Schema::create('flight_baggages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_ticket_id')->constrained('flight_tickets')->onDelete('cascade');
            $table->foreignId('dispatch_reason_id')->constrained('dispatch_reasons')->onDelete('cascade');
            $table->boolean('needs_dispatch')->default(false);
            $table->integer('is_payied')->default(0);
            $table->unsignedInteger('baggage_weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_baggages');
    }
};
