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
        Schema::create('letters_outs', function (Blueprint $table) {
            $table->id();
            $table->string('files');
            $table->dateTime('date_send');
            $table->date('date_number_correspond')->nullable();
            $table->string('sender');
            $table->string('object');
            $table->string('number');
            $table->dateTime('date_reception')->nullable();
            $table->string('observation')->nullable();
            $table->string('etat')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('chrono_id')->constrained('chrono_outs');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letters_outs');
    }
};
