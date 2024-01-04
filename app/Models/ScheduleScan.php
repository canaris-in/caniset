<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleScan extends Model
{
    protected $table = 'schedulescan';
    protected $fillable = ['id','start_ip', 'schedule_type', 'subnet_mask','configuration_type', 'once_time'];
    use HasFactory;
}
