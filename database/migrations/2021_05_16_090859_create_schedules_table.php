<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->unsignedBigInteger('film_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
