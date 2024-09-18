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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();

            //PROFILE
            $table->string('voters_id')->unique()->nullable();
            $table->string('voters_fullname')->nullable();

            $table->string('gender')->nullable();
            $table->string('email')->nullable();

            $table->string('v_year_level')->nullable();
            $table->string('v_course')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
