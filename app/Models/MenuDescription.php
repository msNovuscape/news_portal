<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDescription extends Model
{
    protected $table = 'menu_description';
    protected $fillable = ['menu_id', 'language_id', 'title', 'seo_url', 'description', 'meta_title', 'meta_keyword', 'meta_description'];

    function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public static function getTitle($menu_id)
    {
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $title = '';
        $des = MenuDescription::select('title')->where('menu_id', $menu_id)->where('language_id', $language)->first();
        if (isset($des->title))
        {
            $title = $des->title;
        }
        return $title;
    }
}
