<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertiserFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_followers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertiser_id')->unsigned()->nullable();
            $table->integer('follower_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('advertiser_id')->on('advertisers')->references('id')->onDelete('cascade');
            $table->foreign('follower_id')->on('advertisers')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_followers');
    }
}
