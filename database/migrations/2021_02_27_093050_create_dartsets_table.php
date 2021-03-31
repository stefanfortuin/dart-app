<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDartsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dart_sets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->unsignedBigInteger('game_id')->nullable();
			$table->unsignedBigInteger('winner_id')->nullable();

			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('winner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dart_sets');
    }
}
