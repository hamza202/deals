<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsAdvertiserCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_advertiser_code', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertiser_id')->unsigned()->nullable();
            $table->string('advertiser_number');
            $table->string('code');
            $table->integer('status')->default('0')->comment('0 : available , 1 : not available ');
            $table->timestamps();
            $table->foreign('advertiser_id')->on('advertisers')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_advertiser_code');
    }
}
