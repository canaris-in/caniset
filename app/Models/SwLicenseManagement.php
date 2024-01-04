<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwLicenseManagement extends Model
{
    protected $table = 'sw_license_management'; // Specify the actual table name
    protected $fillable = [
        'ASSET_ID',
        'INVOICE_DATE',
        'INVOICE_NO',
        'PURCHASE_BILL',
        'PURCHASE_COST',
        'PURCHASE_DATE',
        'PURCHASE_ORDER_NO',
        'VENDOR',
        'ACQUISITION_DATE',
        'ASSET_TAG',
        'DEPARTMENT',
        'DESCRIPTION',
        'LICENSE_KEY',
        'LICENSE_OPTION',
        'LICENSE_TYPE',
        'LOCATION',
        'SUB_LOCATION',
        'MANUFACTURER',
        'MANUFACTURER_SW',
        'VOLUME',
        'AMC_AGREEMENT',
        'AMC_BILL',
        'AMC_EFFECTIVE_DATE',
        'AMC_EXPIRY_DATE',
        'EXPIRY_DATE',
        'INSURANCE_BILL',
        'INSURANCE_COMPANY_NAME',
        'INSURANCE_EFFECTIVE_DATE',
        'INSURANCE_EXPIRY_DATE',
        'INSURANCE_POLICY_NO',
        'WARRANTY_BILL',
        'WARRANTY_EFFECTIVE_DATE',
        'WARRANTY_EXPIRY_DATE',
    ];
    use HasFactory;
}
