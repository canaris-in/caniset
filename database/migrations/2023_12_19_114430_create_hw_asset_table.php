<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hw_asset', function (Blueprint $table) {
            $table->id('asset_id');
            $table->datetime('acquisition_date')->nullable();
            $table->string('additional_status')->nullable();
            $table->string('asset_name')->nullable();
            $table->string('asset_serial_number')->nullable();
            $table->string('asset_status')->nullable();
            $table->string('asset_tag')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('category')->nullable();
            $table->string('class')->nullable();
            $table->string('comments')->nullable();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('group_name')->default('ivf group');
            $table->string('image_path')->nullable();
            $table->string('inuse_type')->nullable();
            $table->string('is_delete_permision')->nullable();
            $table->string('is_tagged')->nullable();
            $table->string('is_validate')->nullable();
            $table->string('location')->nullable();
            $table->string('managed_by')->nullable();
            $table->string('model')->nullable();
            $table->string('monitoring_status')->default('true');
            $table->string('owned_by')->nullable();
            $table->string('parent_asset_name')->nullable();
            $table->string('parent_asset_tag')->nullable();
            $table->datetime('status_date')->nullable();
            $table->string('stock_room')->nullable();
            $table->string('sync_status')->nullable();
            $table->datetime('sync_time')->nullable();
            $table->string('tag_by')->nullable();
            $table->datetime('tag_timestamp')->nullable();
            $table->string('type')->nullable();
            $table->string('validate_by')->nullable();
            $table->datetime('validate_timestamp')->nullable();
            $table->string('old_tag')->nullable();
            $table->string('certify_by')->nullable();
            $table->string('certify_status')->nullable();
            $table->datetime('certify_timestamp')->nullable();
            $table->string('certify_user_notes')->nullable();
            $table->string('is_temporary')->nullable();
            $table->datetime('last_updated_time')->nullable();
            $table->string('asset_tag_image')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('geo_status')->nullable();
            $table->datetime('geo_time')->nullable();
            $table->string('rfid_location')->nullable();
            $table->string('rfid_monitoring')->nullable();
            $table->string('rfid_in_out')->nullable();
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
        Schema::dropIfExists('hw_assets');
    }
}
