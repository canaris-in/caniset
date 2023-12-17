<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPScan extends Model
{
    protected $table = 'ipscan';
    protected $fillable = ['id','start_ip', 'group_name', 'end_ip','discovery_name'];
    use HasFactory;
}
