<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
    protected $fillable = [
        'title', 'code', 'flag', 'sort_order', 'status', 'defa'
    ];

    public function settingDescription()
    {
        return $this->hasMany('App\Models\SettingDescription');
    }
    public function menuDescription($menu_id,$language)
    {
        return MenuDescription::where('menu_id',$menu_id)->where('language_id', $language)->first();
    }
    public static function getTitle($id)
    {
        $title = '';
        $language = Language::where('id', $id)->first();
        if (isset($language->title))
        {
            $title = $language->title;
        }
        return $title;
    }
    public static function getCode($id)
    {
        $title = '';
        $language = Language::where('id', $id)->first();
        if (isset($language->code))
        {
            $title = $language->code;
        }
        return $title;
    }
    public static function getFlag($id)
    {
        $flag = '';
        $lang = Language::where('id', $id)->first();
        if (is_file(DIR_IMAGE.$lang->flag))
        {
            $flag = ImageTool::mycrop($lang->flag, 15,15);
        }
        return $flag;
    }

    public static function getDefaultFrontLanguage()
    {
        $return['name'] = '';
        $return['flag'] = '';
        $language = Language::where('defa',1)->first();
        if ($language)
        {
            $return['name'] = $language->title;
            if (is_file(DIR_IMAGE.$language->flag))
            {
                $return['flag'] = ImageTool::mycrop($language->flag, 15,15);
            }

        }
        return $return;
    }

    public static function getSesFrontLanguage()
    {
        $return['name'] = '';
        $return['flag'] = '';
        $language_id = 0;
        if (Session()->has('language'))
        {
            $language_id = session()->get('language');
        }
        $language = Language::where('id',$language_id)->first();
        if ($language)
        {
            $return['name'] = $language->title;
            if (is_file(DIR_IMAGE.$language->flag))
            {
                $return['flag'] = ImageTool::mycrop($language->flag, 15,15);
            }

        }
        return $return;
    }

}
