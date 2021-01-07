<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingEmail extends Model
{
    protected $table = 'setting_email';
    protected $fillable = [
        'setting_id', 'protocal', 'parameter', 'hostname', 'username', 'password', 'smtp_port', 'encription'
    ];

    public function setting()
    {
        return $this->belongsTo('App\Models\Setting');
    }
}
