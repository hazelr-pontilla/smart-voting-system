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
        Schema::create('kandidatos', function (Blueprint $table) {
            $table->id();

            //personal info
            $table->string('name')->nullable();
            $table->string('year')->nullable();
            $table->string('course')->nullable();

            $table->string('position_vote')->nullable();
            $table->string('candidates_id')->nullable();
            $table->json('vote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandidatos');
    }
};
