<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingDescription extends Model
{
    protected $table = 'setting_description';
    protected $fillable = [
        'setting_id', 'language_id', 'name', 'telephone', 'address', 'meta_title', 'meta_keyword', 'meta_description'
    ];

    public function setting()
    {
        return $this->belongsTo('App\Models\Setting');
    }
    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }
}
