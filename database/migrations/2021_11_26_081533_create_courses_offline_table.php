<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesOfflineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_offline', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('place')->default('');
            $table->dateTime('date_of')->useCurrent();
            $table->string('period')->default('');
            $table->string('video')->default('');
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
        Schema::dropIfExists('courses_offline');
    }
}
