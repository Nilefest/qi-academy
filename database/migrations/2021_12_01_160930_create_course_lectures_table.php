<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lectures', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->string('name')->default('');
            $table->string('info_short')->default('');
            $table->string('info_full')->default('');
            $table->text('video')->nullable();
            $table->string('file')->default('');
            $table->string('homework')->default('');
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
        Schema::dropIfExists('course_lectures');
    }
}
