<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\library\Settings;
use App\Models\Layout;
use App\Models\Menu;
use App\Models\MenuDescription;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($seo_url = '',Request $request)
    {
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $mdes = MenuDescription::select('menu_id')->where('seo_url',$seo_url)->firstOrFail();
        $menu = Menu::leftJoin('menu_description','menu.id', '=', 'menu_description.menu_id')
            ->selectRaw('menu.id,menu.layout_id,menu.image,menu.language,menu.parent_id,menu_description.*')
            ->where('menu.id',$mdes->menu_id)
            ->where('menu_description.language_id', $language)
            ->firstOrFail();

            $layout = Layout::where('id', $menu->layout_id)->first();
            if (is_file(DIR_IMAGE.$menu->image))
            {
                $image = asset('image/'.$menu->image);
            }else{
                $image = Settings::getLogo();
            }

            $datas = array(
                'menu_id' => $menu->menu_id,
                'title' => $menu->title,
                'meta_title' => $menu->meta_title,
                'meta_keyword' => $menu->meta_keyword,
                'meta_description' => $menu->meta_description,
                'meta_image' => $image,
                'layout_id' => $menu->layout_id,
                'url' => url($menu->seo_url),
                'parent_id' => $menu->parent_id
            );

            $cont = '\App\Http\Controllers\front\\'.ucfirst($layout->layout_route).'Controller';
            $module = new $cont();
            return $module->index($datas, $request);

    }
}
