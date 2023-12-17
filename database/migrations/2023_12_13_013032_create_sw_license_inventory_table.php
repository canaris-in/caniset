<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwLicenseInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sw_license_inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('asset_id'); 
            $table->string('device_name')->nullable();
            $table->string('device_ip')->nullable();
            $table->string('mac_id')->nullable();
            $table->string('data_type')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_type')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
    
    
            // Adding foreign key constraint for asset_id
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sw_license_inventory');
    }
}
