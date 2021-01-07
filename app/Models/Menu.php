<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['parent_id', 'language', 'sort_order', 'status', 'layout_id', 'image'];


    function description($language)
    {
        return MenuDescription::where('language_id', $language)->first();
    }

    public static function getTitle($id,$language)
    {
        $title = '';
        $menu = MenuDescription::where('menu_id', $id)->where('language_id',$language)->first();
        if (isset($menu->title))
        {
            $title = $menu->title;
        }
        return $title;
    }
    public static function getDefaultTitle($id)
    {
        $language = Language::where('defa',1)->first();
        $language_id = 0;
        if (isset($language->id))
        {
            $language_id = $language->id;
        }
        $title = '';
        $menu = MenuDescription::where('menu_id', $id)->where('language_id',$language_id)->first();
        if (isset($menu->title))
        {
            $title = $menu->title;
        }
        return $title;
    }

    public static function getFrontMenu()
    {
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $menus = [];

        $menu = Menu::where('parent_id', 0)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($menu as $flevel) {
            $slevel = [];
            $smenu = Menu::where('parent_id', $flevel->id)->where('status', 1)->orderBy('sort_order', 'asc')->get();
            foreach ($smenu as $sl) {
                $tlevel = [];
                $tmenu = Menu::where('parent_id', $sl->id)->where('status', 1)->orderBy('sort_order', 'asc')->get();
                foreach ($tmenu as $tl) {
                    $detail = MenuDescription::select('seo_url','title')->where('menu_id', $tl->id)->where('language_id', $language)->first();
                    $tlevel[]= [
                        'id' => $tl->id,
                        'title' => $detail->title,
                        'seo_url'  => url($detail->seo_url),
                        'layout_id' => $tl->layout_id,

                    ];
                }
                $detail1 = MenuDescription::select('seo_url','title')->where('menu_id', $sl->id)->where('language_id', $language)->first();
                $slevel[] = [
                    'id' => $sl->id,
                    'title' => $detail1->title,
                    'seo_url'  => url($detail1->seo_url),
                    'layout_id' => $sl->layout_id,
                    'children' => $tlevel,

                ];
            }
            $detail2 = MenuDescription::select('seo_url','title')->where('menu_id', $flevel->id)->where('language_id', $language)->first();
            $menus[] = [
                'id' => $flevel->id,
                'title' => $detail2->title,
                'seo_url'  => url($detail2->seo_url),
                'layout_id' => $flevel->layout_id,
                'children' => $slevel,

            ];

        }
        return $menus;
    }
}
