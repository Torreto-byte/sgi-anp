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
        Schema::create('letters_ins', function (Blueprint $table) {
            $table->id();
            $table->string('files');
            $table->dateTime('date_add');
            $table->date('date_number_correspond')->nullable();
            $table->string('expeditor');
            $table->string('object');
            $table->string('number');
            $table->string('code_instruction');
            $table->string('etat')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('chrono_id')->constrained('chrono_ins');
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
        Schema::dropIfExists('letters_ins');
    }
};
