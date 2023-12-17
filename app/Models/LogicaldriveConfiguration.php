<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogicaldriveConfiguration extends Model
{
    protected $table = 'logicaldrive_configuration';
    protected $fillable = [
        'id',
        'asset_id', 'capacity', 'drive', 'drive_type', 'drive_usage', 'file_type', 'free_space', 'serial_number'
    ];

    public function asset()
    {
        return $this->belongsTo(ProcessorConfiguration::class, 'asset_id', 'asset_id');
    }
    use HasFactory;
}
