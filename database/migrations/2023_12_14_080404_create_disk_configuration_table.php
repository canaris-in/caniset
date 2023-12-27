<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiskConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disk_configuration', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('asset_id');
            $table->string('capacity')->nullable();
            $table->string('device_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('interface_type')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('media_type')->nullable();
            $table->string('model')->nullable();
            $table->string('name')->nullable();
            $table->string('serial_number')->nullable();
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
        Schema::dropIfExists('disk_configuration');
    }
}
