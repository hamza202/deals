<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('is_active')->default('0')->comment('0 : not balck list , 1: in black list');
            $table->integer('messages')->default('0')->comment('0 : not messages , 1: messages');
            $table->integer('active_account')->default('1')->comment('1: Email, 2: phone , 3:Whatsapp');
            $table->integer('know_us')->nullable()->comment('1 : fb , 2 : snap , 3:tiw , 4: inst , 5:telg');
            $table->integer('membership_id')->nullable()->unsigned();
            $table->string('address')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('twitter')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->timestamp('last_login')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade');
            $table->foreign('membership_id')->on('membership')->references('id')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisers');
    }
}
