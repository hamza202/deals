<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_name');
            $table->string('name');
            $table->string('reason')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->integer('advertising_id')->unsigned()->nullable();
            $table->string('files');
            $table->integer('money');
            $table->integer('status')->default(0)->comment('0:not review , 1 : review , 2:not accept');
            $table->timestamps();
            $table->foreign('advertising_id')->on('advertising')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money_transfer');
    }
}
