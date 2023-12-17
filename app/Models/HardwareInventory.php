<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareInventory extends Model
{
    protected $table = 'hardware_inventory';

    protected $fillable = [
        'id',
        'asset_id',
        'bios_manufacturer',
        'bios_name',
        'bios_release_date',
        'bios_version',
        'build_number',
        'disk_space',
        'domain',
        'host_name',
        'ip_address',
        'mac_address',
        'manufacturer',
        'original_serial_no',
        'os_name',
        'os_type',
        'os_version',
        'processor_count',
        'processor_manufacturer',
        'processor_name',
        'product_id',
        'service_pack',
        'system_model',
        'total_memory',
    ];
    use HasFactory;
}
