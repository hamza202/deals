<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsoredAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsored_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('photo');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('position')->comment('0:first in index , 1:second in index ,2:category page');
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
        Schema::dropIfExists('sponsored_ads');
    }
}
