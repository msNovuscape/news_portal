<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingSocial extends Model
{
    protected $table = 'setting_social';
    protected $fillable = [
        'setting_id', 'facebook', 'twitter', 'gplus', 'youtube', 'linkeding'
    ];

    public function setting()
    {
        return $this->belongsTo('App\Models\Setting');
    }
}
