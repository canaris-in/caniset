<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwInstallUninstallLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sw_install_uninstall_log', function (Blueprint $table) {
            $table->id();
            $table->string('host_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('scan_type')->nullable();
            $table->string('event_type')->nullable();
            $table->string('event_time')->nullable();
            $table->string('application_name')->nullable();
            $table->string('application_publisher')->nullable();
            $table->string('application_version')->nullable();
            $table->string('application_install_date')->nullable();
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
        Schema::dropIfExists('sw_install_uninstall_log');
    }
}
