<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hwPrinter extends Model
{
    protected $table = 'hw_printers';
    protected $fillable = [
        'sr_no',
        'asset_id','device_name','ip_address' ,'driver_name', 'location', 'model', 'name', 'server', 'type',
    ];
    use HasFactory;
}
