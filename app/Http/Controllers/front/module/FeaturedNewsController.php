<?php

namespace App\Http\Controllers\front\module;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ImageTool;
use App\Models\ModuleDescription;
use App\Models\Module;

class FeaturedNewsController extends Controller
{
    public function index($id,$setting)
    {
        $language_id = 0;
        if (Session()->has('language'))
        {
            $language_id = session()->get('language');
        }

        $module_description = ModuleDescription::select('title')->where('module_id', $id)->where('language_id',$language_id)->first();

        $datas['title'] = '';
        if (isset($module_description->title))
        {
            $datas['title'] = $module_description->title;
        }
        $featured = [
            'language_id' => $language_id,
            'article_id' => $setting->featured_news
        ];
        $news = [
            'language_id' => $language_id,
            'article_id' => $setting->article_id
        ];
        $module = Module::where('id', $setting->module)->first();
        $datas['module'] = '';
        if (isset($module->id))
        {
            $content = '\App\Http\Controllers\front\module\\'.$module->module_page.'Controller';
            $header_module = new $content();
            $datas['module'] = $header_module->index($module->id,json_decode($module->setting));

        }

        $datas['featured'] = Article::getSingleNews($featured);
        $datas['news'] = Article::getMultipleArticle($news);
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 450,300);
        $datas['featured_image'] = $datas['placeholder'];
        if (is_file(DIR_IMAGE.$datas['featured']->image))
        {
            $datas['featured_image'] = ImageTool::mycrop($datas['featured']->image,450,300);
        }
        return view('front.module.featurednews')->with('datas', $datas);

    }
}
