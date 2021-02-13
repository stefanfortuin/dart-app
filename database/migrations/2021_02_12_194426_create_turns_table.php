<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->unsignedBigInteger('game_id')->nullable();
			$table->unsignedBigInteger('user_id');
			$table->integer('thrown_score')->nullable();
			$table->integer('old_score_to_throw_from');
			$table->integer('new_score_to_throw_from');

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turns');
    }
}
