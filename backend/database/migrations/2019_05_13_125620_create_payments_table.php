<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('status')->nullable()->default('null'); // processing, failed, success, cancelled
            $table->string('type')->nullable(); // paypal, stripe etc.
            $table->string('token')->nullable(); // payment token for successfull payment
            $table->float('amount')->nullable()->default(0.00);
            $table->date('charge_time')->nullable();
            $table->date('capture_time')->nullable();
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');
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
