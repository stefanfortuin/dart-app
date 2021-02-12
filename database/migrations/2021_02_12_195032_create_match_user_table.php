<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('match_id');

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('match_id')->references('id')->on('matches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_user');
    }
}
