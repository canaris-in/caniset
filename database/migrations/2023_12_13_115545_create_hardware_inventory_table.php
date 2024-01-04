<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHardwareInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware_inventory', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->string('bios_manufacturer')->default('-');
            $table->string('bios_name')->default('-');
            $table->string('bios_release_date')->default('-');
            $table->string('bios_version')->default('-');
            $table->string('build_number')->default('-');
            $table->double('disk_space')->default(0);
            $table->string('domain')->default('-');
            $table->string('host_name')->default('-');
            $table->string('ip_address')->default('-');
            $table->string('mac_address')->default('-');
            $table->string('manufacturer')->default('-');
            $table->string('original_serial_no')->default('-');
            $table->string('os_name')->default('-');
            $table->string('os_type')->default('-');
            $table->string('os_version')->default('-');
            $table->string('processor_count')->default('-');
            $table->string('processor_manufacturer')->default('-');
            $table->string('processor_name')->default('-');
            $table->string('product_id')->default('-');
            $table->string('service_pack')->default('-');
            $table->string('system_model')->default('-');
            $table->double('total_memory')->default(0);
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
        Schema::dropIfExists('hardware_inventory');
    }
}
