<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDartlegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dart_legs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->unsignedBigInteger('set_id')->nullable();
			$table->unsignedBigInteger('winner_id')->nullable();

			$table->foreign('set_id')->references('id')->on('dart_sets');
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
        Schema::dropIfExists('dart_legs');
    }
}
