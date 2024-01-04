<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sw_inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->nullable(); 
        $table->string('device_name')->nullable();
        $table->string('device_ip')->nullable();
        $table->string('mac_id')->nullable();
        $table->string('application_name')->nullable();
        $table->string('application_version')->nullable();
        $table->string('is_license')->nullable();
        $table->string('license_key')->nullable();
        $table->string('product_id')->nullable();
        $table->string('publisher')->nullable();
        $table->string('uninstall_str')->nullable();
        $table->string('branch_name')->nullable();
        $table->string('install_date')->nullable();
        
        $table->timestamps();

        // Adding foreign key constraint for asset_id
        // $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sw_inventory');
    }
}
