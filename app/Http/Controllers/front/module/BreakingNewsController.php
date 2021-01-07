<?php

namespace App\Http\Controllers\front\module;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ModuleDescription;
use Illuminate\Http\Request;

class BreakingNewsController extends Controller
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
        $art = Article::leftJoin('article_description','article.id', '=', 'article_description.article_id')
            ->selectRaw('article.id,article_description.title,article_description.seo_url')
            ->where('article.status',1)
            ->where('article_description.language_id',$language_id)
            ->groupBy('article.id');
            if ($setting->language_id > 0)
            {
                $art->where('language',$setting->language_id);
            }
            $articles = $art->orderBy('article.id', 'desc')->skip(0)->take($setting->limit)->get();


        foreach ($articles as $article) {

            $datas['article'][] = [
                'title' => $article->title,
                'url' => url('/article/'.$article->seo_url),

            ];
        }
        return view('front.module.breakingnews')->with('datas', $datas);

    }
}
