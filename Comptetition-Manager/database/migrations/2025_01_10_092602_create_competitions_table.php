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
        Schema::create('competitions', function (Blueprint $table) {
            $table->string('comp_name');
            $table->year('comp_year');
            $table->integer('prize')->default(0);
            $table->text('description')->nullable();
            $table->text('address');
            $table->date('comp_start');
            $table->date('comp_end');
            $table->text('languages');
            $table->integer('comp_limit')->default(100);
            $table->integer('entry_fee')->default(0);
            $table->primary(['comp_name','comp_year']);
            #$table->index(['comp_name','comp_year'],'comp_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
