<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\library\Settings;
use App\Models\ArticleToMenu;
use App\Models\ImageTool;
use App\Models\Layout;
use App\Models\Menu;
use App\Models\Module;
use App\Models\SettingDescription;
use Illuminate\Http\Request;

class MultipleArticleController extends Controller
{
    public function index($datas = [], Request $request)
    {
        if (!isset($datas['menu_id']))
        {
            \Session::flast('alert-danger','Data Not Found');
            return redirect()->back();
        }
        $layouts= Layout::where('layout_route', 'MultipleArticle')->first();
        if(isset($datas['layout_id']))
        {
            $layout_id = $datas['layout_id'];
        }
        elseif(isset($layouts->id))
        {
            $layout_id = $layouts->id;
        }
        else
        {
            $layout_id = '';
        }

            $meta_title = $datas['meta_title'];
            $meta_keyword = $datas['meta_keyword'];
            $meta_description = $datas['meta_description'];
            $meta_image = $datas['meta_image'];
            $meta_url = $datas['url'];



        $config = array(
            'app.meta_title' => $meta_title,
            'app.meta_keyword' => $meta_keyword,
            'app.meta_description' => $meta_description,
            'app.meta_image' => $meta_image,
            'app.meta_url' => $meta_url,
            'app.meta_type' => 'website',

        );
        config($config);
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $page_setting = Settings::getSettings();
        $image_settings = Settings::getImages();
        $datas['thumb_height'] = $image_settings->thumb_height;
        $datas['thumb_width'] = $image_settings->thumb_width;
        $datas['description_limit'] = $page_setting->description_limit;
        $datas['logo'] = asset(ImageTool::mycrop($image_settings->logo, 450,300));
        $limit = 20;
        if ($page_setting->item_perpage > 0)
        {
            $limit = $page_setting->item_perpage;
        }
        $seting_des = SettingDescription::select('name')->where('setting_id', $page_setting->id)->where('language_id', $language)->first();
        $datas['pagination'][] = ['title' => $seting_des->name, 'url' => url('/')];

        if ($datas['parent_id'] > 0)
        {
            $fmenu = Menu::leftJoin('menu_description', 'menu.id', '=','menu_description.menu_id')
                ->selectRaw('menu.parent_id,menu_id,menu_description.title,menu_description.seo_url')
                ->where('menu.id',$datas['parent_id'])
                ->where('menu_description.language_id', $language)
                ->first();
            if ($fmenu->parent_id > 0)
            {
                $smenu = Menu::leftJoin('menu_description', 'menu.id', '=','menu_description.menu_id')
                    ->selectRaw('menu.parent_id,menu_id,menu_description.title,menu_description.seo_url')
                    ->where('menu.id',$fmenu->parnet_id)
                    ->where('menu_description.language_id', $language)
                    ->first();
                $datas['pagination'][] = ['title' => $smenu->title, 'url' => url($smenu->seo_url)];
            }

            $datas['pagination'][] = ['title' => $fmenu->title, 'url' => url($fmenu->seo_url)];
        }
        $datas['pagination'][] = ['title' => $datas['title'], 'url' => $datas['url']];


        $datas['articles'] = ArticleToMenu::leftJoin('article', 'article_to_menu.article_id', '=', 'article.id')
            ->leftJoin('article_description', 'article.id', '=', 'article_description.article_id')
            ->where('article_to_menu.menu_id',$datas['menu_id'])
            ->where('article_description.language_id',$language)
            ->where('article.status', 1)
            ->groupBy('article.id')
            ->orderBy('article.id', 'desc')
            ->paginate($limit);
        $main_content = Module::getModules($layout_id, 'content_main');

        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
            $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
            $content_main = new $cont();
            $datas['main_modules'][] = array(
                'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
        }


        $left_content = Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
            $left_module = new $lcontent();
            $datas['left_content'][] = array(
                'module' => $left_module->index($left->module_id,json_decode($left->setting)),
            );
        }
        $right_content = Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
            $right_module = new $lcontent();
            $datas['right_content'][] = array(
                'module' => $right_module->index($right->module_id,json_decode($right->setting)),
            );
        }
        $top_content = Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
            $top_module = new $lcontent();
            $datas['top_content'][] = array(
                'module' => $top_module->index($top->module_id,json_decode($top->setting)),
            );
        }
        $bottom_content = Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
            $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
                'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
            );
        }
        $header_content = Module::getModules($layout_id, 'content_header');
        $datas['header_content'] = array();
        foreach ($header_content as $header) {
            $hcontent= '\App\Http\Controllers\front\module\\'.$header->module_page.'Controller';
            $header_module = new $hcontent();
            $datas['header_content'][] = array(
                'module' => $header_module->index($header->module_id,json_decode($header->setting)),
            );
        }
        return view('front.multiplearticle')->with('datas',$datas);

    }
}
