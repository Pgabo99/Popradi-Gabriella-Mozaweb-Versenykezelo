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
        Schema::create('competitors', function (Blueprint $table) {
            $table->string('user_email');
            $table->integer('round_id');
            $table->integer('points')->nullable();
            $table->integer('placement')->nullable();
            $table->integer('correct_answ');
            $table->integer('wrong_answ');
            $table->integer('blank_answ');
            $table->primary(['user_email','round_id']);
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE rounds DROP FOREIGN KEY(user_email);');
        DB::statement('ALTER TABLE rounds DROP FOREIGN KEY(round_id);');
        Schema::dropIfExists('competitors');
    }
};
