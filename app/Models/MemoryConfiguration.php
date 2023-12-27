<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoryConfiguration extends Model
{
    protected $table = 'memory_configuration';
    protected $fillable = [
        'id',
        'asset_id','device_name','ip_address', 'bank_label', 'capacity', 'frequency', 'module_tag', 'serial_number', 'socket'
    ];

    // public function asset()
    // {
    //     return $this->belongsTo(ProcessorConfiguration::class, 'asset_id', 'asset_id');
    // }
    use HasFactory;
}
