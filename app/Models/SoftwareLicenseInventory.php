<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareLicenseInventory extends Model
{
    use HasFactory;
    protected $table = 'sw_license_inventory';

    protected $fillable = [
        'id',
        'asset_id',
        'device_name',
        'device_ip',
        'mac_id',
        'data_type',
        'product_name',
        'product_type',
        'value',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
