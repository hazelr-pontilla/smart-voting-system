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
        Schema::create('partylists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidates_id')->constrained();

            $table->date('p_date_filling')->nullable();
            $table->string('name_of_partylist')->nullable()->unique();
            $table->string('members')->nullable();

            $table->string('p_vision_statement')->nullable();
            $table->string('p_key_priorities')->nullable();
            $table->string('collaboration_plan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partylists');
    }
};
