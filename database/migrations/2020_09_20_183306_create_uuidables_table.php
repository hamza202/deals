<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUuidablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uuidables', function (Blueprint $table) {
            $table->unsignedBigInteger('u_u_i_d_id');
            $table->foreign('u_u_i_d_id')
                ->references('id')
                ->on('u_u_i_d_s')
                ->onDelete('cascade');

            $table->morphs('uuidable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uuidable');
    }
}
