<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkDiscovery extends Model
{
    protected $table = 'network_discovery';
    protected $fillable = ['id','node_ip', 'location', 'mac_ip','node_name', 'oem', 'os_type'];
    use HasFactory;
}
