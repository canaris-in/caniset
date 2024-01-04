<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInstalledDevice extends Model
{
    use HasFactory;
    protected $table = 'agent_installed_device';

    protected $fillable = [
        'IP_ADDRESS', 'HOST_NAME', 'BRANCH_NAME', 'AGENT_START_TIME',
        'DEVICE_STATUS', 'VERSION', 'MAC_ADDRESS', 'DEVICE_IP','HW_LAST_DISCOVER','HW_DISCOVER_STATUS','HW_SCAN_TYPE',
        'DEVICE_MAC_LIST', 'SW_LAST_DISCOVER', 'SERIALNUMBER',
        'SW_COUNT', 'SW_SCAN_TYPE',
    ];
}
