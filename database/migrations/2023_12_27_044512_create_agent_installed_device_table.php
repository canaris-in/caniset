<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentInstalledDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_installed_device', function (Blueprint $table) {
            $table->id();
            $table->string('IP_ADDRESS', 50)->nullable();
            $table->string('HOST_NAME', 50)->nullable();
            $table->string('BRANCH_NAME', 50)->nullable();
            $table->string('AGENT_START_TIME', 50)->nullable();
            $table->string('DEVICE_STATUS', 50)->nullable();
            $table->string('VERSION', 50)->nullable();
            $table->string('MAC_ADDRESS', 50)->nullable();
            $table->string('DEVICE_IP', 50)->nullable();
            $table->text('DEVICE_MAC_LIST')->nullable();
            $table->text('SW_LAST_DISCOVER')->nullable();
            $table->text('HW_LAST_DISCOVER')->nullable();
            $table->text('HW_DISCOVER_STATUS')->nullable();
            $table->text('HW_SCAN_TYPE')->nullable();
            $table->string('SERIALNUMBER', 50)->nullable();
            $table->string('SW_COUNT', 50)->nullable();
            $table->string('SW_SCAN_TYPE', 50)->nullable();
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
        Schema::dropIfExists('agent_installed_device');
    }
}
