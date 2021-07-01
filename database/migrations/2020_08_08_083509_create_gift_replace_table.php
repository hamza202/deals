<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftReplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_replace', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gift_id')->unsigned()->nullable();
            $table->string('address');
            $table->integer('advertiser_id')->unsigned()->nullable();
            $table->integer('accept');
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->foreign('gift_id')->on('gifts')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('gift_replace');
    }
}
