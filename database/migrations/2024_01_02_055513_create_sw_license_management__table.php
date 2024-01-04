<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwLicenseManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sw_license_management', function (Blueprint $table) {
            // $table->id(); // This assumes you want to add an auto-incrementing primary key column
            // $table->id(false);
            $table->id('ASSET_ID');
            $table->datetime('INVOICE_DATE')->nullable();
            $table->string('INVOICE_NO')->nullable();
            $table->string('PURCHASE_BILL')->nullable();
            $table->string('PURCHASE_COST')->nullable();
            $table->datetime('PURCHASE_DATE')->nullable();
            $table->string('PURCHASE_ORDER_NO')->nullable();
            $table->string('VENDOR')->nullable();
            $table->datetime('ACQUISITION_DATE')->nullable();
            $table->string('ASSET_TAG')->nullable();
            $table->string('DEPARTMENT')->nullable();
            $table->string('DESCRIPTION')->nullable();
            // $table->datetime('EXPIRY_DATE')->nullable();
            $table->string('LICENSE_KEY')->nullable();
            $table->string('LICENSE_OPTION')->nullable();
            $table->string('LICENSE_TYPE')->nullable();
            $table->string('LOCATION')->nullable();
            $table->string('SUB_LOCATION')->nullable();
            $table->string('MANUFACTURER')->nullable();
            $table->string('MANUFACTURER_SW')->nullable();
            $table->string('VOLUME')->nullable();
            $table->string('AMC_AGREEMENT')->nullable();
            $table->string('AMC_BILL')->nullable();
            $table->datetime('AMC_EFFECTIVE_DATE')->nullable();
            $table->datetime('AMC_EXPIRY_DATE')->nullable();
            $table->datetime('EXPIRY_DATE')->nullable();
            $table->string('INSURANCE_BILL')->nullable();
            $table->string('INSURANCE_COMPANY_NAME')->nullable();
            $table->datetime('INSURANCE_EFFECTIVE_DATE')->nullable();
            $table->datetime('INSURANCE_EXPIRY_DATE')->nullable();
            $table->string('INSURANCE_POLICY_NO')->nullable();
            $table->string('WARRANTY_BILL')->nullable();
            $table->datetime('WARRANTY_EFFECTIVE_DATE')->nullable();
            $table->datetime('WARRANTY_EXPIRY_DATE')->nullable();
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
        Schema::dropIfExists('sw_license_management_');
    }
}
