<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogicaldriveConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logicaldrive_configuration', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('asset_id');
            $table->string('capacity')->nullable();
            $table->string('drive')->nullable();
            $table->string('drive_type')->nullable();
            $table->string('drive_usage')->nullable();
            $table->string('file_type')->nullable();
            $table->string('free_space')->nullable();
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
        Schema::dropIfExists('logicaldrive_configuration');
    }
}
