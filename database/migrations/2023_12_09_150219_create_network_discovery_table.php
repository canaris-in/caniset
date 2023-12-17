<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworkDiscoveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_discovery', function (Blueprint $table) {
            $table->id();
            $table->string('node_ip');
            $table->string('location');
            $table->string('mac_ip');
            $table->string('node_name');
            $table->string('oem');
            $table->string('os_type');
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
        Schema::dropIfExists('network_discovery');
    }
}
