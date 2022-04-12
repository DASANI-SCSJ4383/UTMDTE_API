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
        Schema::create('joinStudentToCourse', function (Blueprint $table) {
            $table->id();

            $table->integer("courseID");
            $table->foreign('courseID')->references('id')->on('courses')->onDelete('cascade');

            $table->integer("studentID");
            $table->foreign('studentID')->references('id')->on('students')->onDelete('cascade');

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
        Schema::dropIfExists('joinStudentToCourse');
    }
};
