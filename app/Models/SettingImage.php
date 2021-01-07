<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingImage extends Model
{
    protected $table = 'setting_image';
    protected $fillable = [
        'setting_id', 'logo', 'icon', 'thumb_height', 'thumb_width', 'image_height', 'image_width'
    ];

    public function setting()
    {
        return $this->belongsTo('App\Models\Setting');
    }
}
