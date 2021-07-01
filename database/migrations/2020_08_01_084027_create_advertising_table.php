<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertiser_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->integer('lng')->nullable();
            $table->integer('lat')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('package_id')->unsigned()->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->integer('is_phone')->default(0)->comment('0 0 : no , 1 : yes	');
            $table->integer('is_specialconditions')->default(0)->comment('0 : no , 1 : yes	');
            $table->string('title');
            $table->text('special_conditions')->nullable();
            $table->string('vedio_url')->nullable();
            $table->string('photos')->nullable();
            $table->string('price');
            $table->string('insurance_price')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('comments')->default('0')->comment('1 : accept , 0 : not accept ');
            $table->integer('counter')->default('0');
            $table->integer('commission')->default(0);
            $table->timestamps();
            $table->foreign('advertiser_id')->on('advertisers')->references('id')->onDelete('cascade');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
            $table->foreign('sub_category_id')->on('categories')->references('id')->onDelete('cascade');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade');
            $table->foreign('package_id')->on('subscriptions')->references('id')->onDelete('cascade');
            $table->foreign('status')->on('advertising_status')->references('id')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertising');
    }
}
