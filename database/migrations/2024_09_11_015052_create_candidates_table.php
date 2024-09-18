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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();

            //PROFILE
            $table->date('date_filing')->nullable();
            $table->string('student_id')->nullable()->unique(); //student id
            $table->string('position')->nullable();

            $table->string('fullname')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('c_year_level')->nullable();
            $table->string('c_course')->nullable();

            $table->longText('motivation')->nullable();

            //AGENDAS
            $table->longText('key_issues')->nullable();
            $table->longText('key_solutions')->nullable();

            $table->longText('plan_to_action')->nullable();
            $table->longText('conclusion')->nullable();

            //PLANS
            $table->string('vision_statement')->nullable();
            $table->string('key_priorities')->nullable();
            $table->string('action_plan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
