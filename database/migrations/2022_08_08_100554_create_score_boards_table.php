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
        Schema::create('score_boards', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('CID')->nullable();
            $table->string('UserID')->nullable();
            $table->integer('ModularScore')->nullable();
            $table->integer('TotalModular')->nullable();
            $table->integer('PostScore')->nullable();
            $table->integer('TotalPost')->nullable();
            $table->integer('TotalPrac')->nullable();
            $table->integer('PracScore')->nullable();
            $table->integer('TotalPre')->nullable();
            $table->integer('PreScores')->nullable();

            $table->integer('PreAttempted')->nullable();
            $table->integer('PostAttempted')->nullable();
            $table->integer('PracAttempted')->nullable();
            $table->integer('ModAttempted')->nullable();

            $table->string('CertificationStatus')->default('false');

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
        Schema::dropIfExists('score_boards');
    }
};
