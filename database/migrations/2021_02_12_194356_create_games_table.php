<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string('status')->default('PLAYING');
            $table->integer('start_score')->nullable();
            $table->integer('total_sets')->nullable();
            $table->integer('total_legs')->nullable();
			$table->unsignedBigInteger('winner_id')->nullable();

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
        Schema::dropIfExists('games');
    }
}
