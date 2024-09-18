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
        Schema::create('election_kandidato', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Kandidato::class);
            $table->foreignIdFor(\App\Models\Candidates::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_kandidato');
    }
};
