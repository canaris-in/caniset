<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubnetScan extends Model
{
    protected $table = 'subnetscan';
    protected $fillable = ['id','start_ip', 'group_name', 'subnet_mask'];
    use HasFactory;
}
