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
        Schema::create('exam_timer_locks', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('CID')->nullable();
            $table->string('MID')->nullable();
            $table->string('UserID')->nullable();
            $table->string('TestID')->nullable();
            $table->datetime('LockedTime')->nullable();
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
        Schema::dropIfExists('exam_timer_locks');
    }
};