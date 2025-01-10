<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('round_name');
            $table->text('description')->nullable();
            $table->string('comp_name');
            $table->year('comp_year');
            $table->integer('questions_number');
            $table->integer('correct_point');
            $table->integer('wrong_point');
            $table->integer('blank_point');
            $table->dateTime('round_start');
            $table->dateTime('round_end');
        });

        DB::statement('ALTER TABLE rounds ADD FOREIGN KEY(comp_name,comp_year) REFERENCES competitions(comp_name,comp_year) ON DELETE CASCADE;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE rounds DROP FOREIGN KEY(comp_name,comp_year);');
        Schema::dropIfExists('rounds');
    }
};
