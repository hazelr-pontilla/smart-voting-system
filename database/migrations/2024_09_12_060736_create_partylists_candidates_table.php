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
        Schema::create('partylists_candidates', function (Blueprint $table) {

            //pivot table for connecting the relation manager of partylist to candidates
            $table->foreignIdFor(\App\Models\Partylist::class);
            $table->foreignIdFor(\App\Models\Candidates::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partylists_candidates');
    }
};
