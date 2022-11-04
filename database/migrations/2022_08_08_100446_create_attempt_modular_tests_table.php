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
        Schema::create('attempt_modular_tests', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            $table->string('MID');
            $table->string('UserID');
            $table->string('TestID');
            $table->string('TestType');
            $table->string('QtnID');
            $table->integer('CorrectAnswerOption');
            $table->integer('UserAnswer')->default('2626');
            $table->string('score')->default('fail');
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
        Schema::dropIfExists('attempt_modular_tests');
    }
};