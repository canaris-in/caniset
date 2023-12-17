<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoryConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memory_configuration', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('asset_id');
            $table->string('bank_label')->nullable();
            $table->string('capacity')->nullable();
            $table->string('frequency')->nullable();
            $table->string('module_tag')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('socket')->nullable();
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
        Schema::dropIfExists('memory_configuration');
    }
}
