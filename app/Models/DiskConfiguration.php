<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiskConfiguration extends Model
{
    protected $table = 'disk_configuration';
    protected $fillable = [
        'id',
        'asset_id', 'capacity', 'interface_type', 'manufacturer', 'media_type', 'model', 'name', 'serial_number'
    ];

    public function asset()
    {
        return $this->belongsTo(ProcessorConfiguration::class, 'asset_id', 'asset_id');
    }
    use HasFactory;
}
