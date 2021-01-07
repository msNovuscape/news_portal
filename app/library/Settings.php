<?php namespace App\library;
use App\Models\Setting;
use App\Models\Imagetool;
use App\Models\SettingDescription;
use App\Models\SettingImage;
use App\Models\SettingEmail;
use App\Models\SettingSocial;

class Settings {



    public static function getSettings()
    {
        return Setting::first();
    }

    public static function getDescription()
    {
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $setting = Setting::first();
        return SettingDescription::where('setting_id', $setting->id)->where('language_id', $language)->first();
    }

    public static function getSeetingWithDescription()
    {
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $datas['setting'] = Setting::first();
        $datas['description'] = SettingDescription::where('setting_id', $datas['setting']->id)->where('language_id', $language)->first();
        return $datas;
    }



    public static function getImages()
    {
        $setting = Setting::first();
        return SettingImage::where('setting_id', $setting->id)->first();
    }

    public static function getEmails(){
        $setting = Setting::first();
        return SettingEmail::where('setting_id', $setting->id)->first();
    }
    public static function getSocials()
    {
        $setting = Setting::first();
        return SettingSocial::where('setting_id', $setting->id)->first();
    }

    public static function getIcon()
    {
        $setting = Setting::first();
        $image = SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->icon)) {
            $icon = asset(Imagetool::mycrop($image->icon, 100,100));
        } else {
            $icon = '';
        }
        return $icon;
    }



    public static function getLogo()
    {
        $setting = Setting::first();
        $image = SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->logo)) {
            $logo = asset('image/'.$image->logo);
        } else {
            $logo = '';
        }
        return $logo;
    }


    public static function getLimitedWords($text,$startword,$numberOfWords)
    {
        if($text != null)
        {
            $text = strip_tags(html_entity_decode(str_replace("&nbsp;","",$text)));
            $textArray = explode(" ", $text);
            if(count($textArray) > $numberOfWords)
            {
                return implode(" ",array_slice($textArray, $startword, $numberOfWords)).'...';
            }
            return strip_tags(html_entity_decode(str_replace("&nbsp;","",$text)));
        }
        return "";
    }
    public static function getLimitedCharacter($text,$startword,$numberOfWords)
    {
        if($text != null)
        {
            $text = strip_tags(str_replace("&nbsp;","",$text));


            return substr($text,$startword,$numberOfWords).'...';
        }
        return "";
    }




}

?>
