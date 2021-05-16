<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('user_ip');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('seat_id');

            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('seat_id')
                ->references('id')
                ->on('seats')
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
        Schema::dropIfExists('orders');
    }
}
