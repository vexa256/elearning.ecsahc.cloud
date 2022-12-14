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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            $table->string('Name')->nullable();
            $table->string('Gender');
            $table->string('JobTitle');
            $table->string('Address');
            $table->string('WorkTelephoneNumber');
            $table->string('MobileNumber');
            $table->string('ParentOrganization');
            $table->longText('ReasonsForJoining')->nullable();
            $table->longText('SpecialNeed')->nullable();
            $table->string('CV')->nullable();
            $table->string('StudentID')->nullable();
            $table->string('nationality');
            $table->string('ApprovalStatus')->nullable();
            $table->string('StartDate')->nullable();
            $table->string('CourseDuration')->nullable();
            $table->string('Comment')->nullable();
            $table->string('Email')->nullable();
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
        Schema::dropIfExists('students');
    }
};