<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwInstallUninstallLog extends Model
{
    use HasFactory;
    protected $table = 'sw_install_uninstall_log';

    protected $fillable = [
        'id',
        'host_name',
        'ip_address',
        'branch_name',
        'scan_type',
        'event_type',
        'event_time',
        'application_name',
        'application_publisher',
        'application_version',
        'application_install_date',
    ];
}
