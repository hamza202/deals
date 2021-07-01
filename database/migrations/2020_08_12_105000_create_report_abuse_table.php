<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportAbuseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_abuse', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertiser_id')->nullable()->unsigned();
            $table->string('address')->nullable();
            $table->string('abuse_type')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('report_abuse');
    }
}
