<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullabel();
            $table->integer('course_id')->nullabel();
            $table->string('customer_name');
            $table->string('customer_lastname');
            $table->string('customer_email')->default('');
            $table->string('customer_phone')->default('');
            $table->string('order_id');
            $table->integer('amount')->default(0);
            $table->text('order_description')->nullabel();
            $table->string('signature');
            $table->text('response')->nullabel();
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
        Schema::dropIfExists('payments');
    }
}
