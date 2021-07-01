<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertising_id')->unsigned()->nullable();
            $table->integer('writer_id')->unsigned()->nullable();
            $table->text('comment');
            $table->integer('parent_id')->default(0);
            $table->timestamps();
            $table->foreign('advertising_id')->on('advertising')->references('id')->onDelete('cascade');
            $table->foreign('writer_id')->on('advertisers')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertising_comments');
    }
}
