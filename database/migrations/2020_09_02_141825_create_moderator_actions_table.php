<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeratorActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderator_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('moderator_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('moderator_id')->on('moderators')->references('id')->onDelete('cascade');
            $table->foreign('role_id')->on('moderator_role')->references('code')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moderator_actions');
    }
}
