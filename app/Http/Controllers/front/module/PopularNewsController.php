<?php

namespace App\Http\Controllers\front\module;

use App\Http\Controllers\Controller;
use App\library\Settings;
use App\Models\Article;
use App\Models\ImageTool;
use App\Models\ModuleDescription;
use Illuminate\Http\Request;

class PopularNewsController extends Controller
{
    public function index($id,$setting)
    {
        $language_id = 0;
        if (Session()->has('language'))
        {
            $language_id = session()->get('language');
        }
        $datas['menu_href'] = '';

        $module_description = ModuleDescription::select('title')->where('module_id', $id)->where('language_id',$language_id)->first();

        $datas['title'] = '';
        if (isset($module_description->title))
        {
            $datas['title'] = $module_description->title;
        }
        $art = Article::leftJoin('article_description','article.id', '=', 'article_description.article_id')
            ->selectRaw('article.id,article.image,article.created_at,article_description.title,article_description.description,article_description.seo_url')
            ->where('article.status',1)
            ->where('article_description.language_id',$language_id)
            ->groupBy('article.id');
        if ($setting->language_id > 0)
        {
            $art->where('language',$setting->language_id);
        }
        $articles = $art->orderBy('article.visit', 'desc')->skip(0)->take($setting->limit)->get();

        $datas['article'] = [];
        foreach ($articles as $article) {
            $image = ImageTool::mycrop('no-image.png', 450,300);
            if (is_file(DIR_IMAGE.$article->image))
            {
                $image = ImageTool::mycrop($article->image,450,300);
            }

            $datas['article'][] = [
                'id' => $article->id,
                'title' => $article->title,
                'url' => url('/article/'.$article->seo_url),
                'image' => $image,
                'description' => Settings::getLimitedWords($article->description,0,30),
                'created_at' => $article->created_at

            ];
        }

        if (count($datas['article']) > 0)
        {

            $datas['class'] = Article::getColumn($setting->columns);
            $datas['column'] = $setting->columns;
            $layout = 'front.module.List';
            if ($setting->layout != '')
            {
                $layout = 'front.module.'.$setting->layout;
            }
            return view($layout)->with('datas', $datas);

        }else{
            return '';
        }


    }
}
