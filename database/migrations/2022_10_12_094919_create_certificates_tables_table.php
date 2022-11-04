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
        Schema::create('certificates_tables', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->nullable();
            $table->string('Course')->nullable();
            $table->string('CID')->nullable();
            $table->string('UserID')->nullable();
            $table->string('Name')->nullable();
            $table->string('CertCode')->nullable();

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
        Schema::dropIfExists('certificates_tables');
    }
};