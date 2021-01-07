<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    protected $fillable = array('email','item_perpage', 'description_limit', 'latitude', 'longitude', 'google_analytics');
    protected $primaryKey = 'id';

    public function description()
    {
        return $this->hasMany('App\Models\SettingDescription');
    }
    public function settingEmail()
    {
        return $this->hasOne('App\Models\SettingEmail');
    }
    public function settingImage()
    {
        return $this->hasOne('App\Models\SettingImage');
    }
    public function settingSocial()
    {
        return $this->hasOne('App\Models\SettingSocial');
    }
}
