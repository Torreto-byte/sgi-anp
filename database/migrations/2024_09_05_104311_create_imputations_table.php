<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imputations', function (Blueprint $table) {
            $table->id();
            $table->string('name_agent')->nullable();
            $table->dateTime('date_reception')->nullable();
            $table->foreignId('letter_id')->constrained('letters_ins')->nullable();
            $table->foreignId('direction_id')->constrained('directions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imputations');
    }
};
