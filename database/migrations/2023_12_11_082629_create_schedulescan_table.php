<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulescanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulescan', function (Blueprint $table) {
            $table->id();
            $table->string('start_ip');
            $table->string('schedule_type');
            $table->string('subnet_mask');
            $table->string('configuration_type');
            $table->string('once_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulescan');
    }
}
