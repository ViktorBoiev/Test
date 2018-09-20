<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winner_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('winner_id');
            $table->string('gift_type')->nullable();
            $table->string('win_type');
            $table->integer('win_quantity')->default(1);
            $table->unsignedInteger('status')->nullable();
            $table->timestamps();

            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winner_logs');
    }
}
