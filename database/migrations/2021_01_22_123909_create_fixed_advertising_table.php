<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedAdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_advertising', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertiser_id')->unsigned()->nullable();
            $table->integer('advertising_id')->unsigned()->nullable();
            $table->integer('subscriptions_id')->unsigned()->nullable();
            $table->integer('status')->default(0)->comment("0 : not fixed , 1: fixed");
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->foreign('advertiser_id')->on('advertisers')->references('id')->onDelete('cascade');
            $table->foreign('advertising_id')->on('advertising')->references('id')->onDelete('cascade');
            $table->foreign('subscriptions_id')->on('subscriptions')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixed_advertising');
    }
}
