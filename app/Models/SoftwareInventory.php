<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareInventory extends Model
{
    use HasFactory;
    protected $table = 'sw_inventory';

    protected $fillable = [
        'id',
        'asset_id',
        'device_name',
        'device_ip',
        'mac_id',
        'application_name',
        'application_version',
        'is_license',
        'license_key',
        'product_id',
        'publisher',
        'uninstall_str',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
