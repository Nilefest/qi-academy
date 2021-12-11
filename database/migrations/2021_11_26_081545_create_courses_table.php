<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->boolean('main_course')->default(0);
            $table->boolean('free')->default(0);
            $table->boolean('free_for_client')->default(0);
            $table->boolean('only_paid')->default(0);
            $table->string('name')->default('');
            $table->string('banner_img')->default('');
            $table->integer('total_days')->default(1);
            $table->integer('total_hours')->default(1);
            $table->double('cost')->default(0);
            $table->text('video_preview')->nullable();
            $table->text('description')->nullabel();
            $table->string('description_for_1')->default('');
            $table->string('description_for_2')->default('');
            $table->integer('team_id')->nullabel();
            $table->string('gallery_img_1')->default('');
            $table->string('gallery_img_2')->default('');
            $table->string('gallery_img_3')->default('');
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
        Schema::dropIfExists('course');
    }
}
