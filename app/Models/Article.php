<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = ['image', 'video', 'language', 'visit', 'audio', 'status'];



    public static function getSingleNews($data = [])
    {
        $art = Article::leftJoin('article_description','article.id', '=', 'article_description.article_id')
            //->selectRaw('article.id,article_description.title,article_description.seo_url')
            ->where('article.status',1);
        if (isset($data['language_id']))
        {
            $art->where('article_description.language_id',$data['language_id']);
        }
        if (isset($data['article_id']))
        {
            $art->where('article.id',$data['article_id']);
        }
        if (isset($data['language']))
        {
            $art->where('language',$data['language']);
        }

        $articles = $art->first();
        return $articles;
    }

    public static function getMultipleArticle($data = [])
    {
        $art = Article::leftJoin('article_description','article.id', '=', 'article_description.article_id')
            //->selectRaw('article.id,article_description.title,article_description.seo_url')
            ->where('article.status',1);
            if (isset($data['language_id']))
            {
                $art->where('article_description.language_id',$data['language_id']);
            }
            if (isset($data['article_ids']))
            {
                $art->whereIn('article.id',$data['article_id']);
            }
            if (isset($data['language']))
            {
                $art->where('language',$data['language']);
            }

        $art->orderBy('article.id', 'desc')->groupBy('article.id');
            if (isset($data['limit']))
            {
                $art->skip(0)->take($data['limit']);
            }

            $articles = $art->get();

            return $articles;
    }

    public static function getColumn($colum)
    {
        $return = '';
        if ($colum == 1)
        {
            $return = 'col-lg-12 col-md-12 col-sm-12';
        }elseif ($colum == 2)
        {
            $return = 'col-lg-6 col-md-6 col-sm-6 col-12';
        }elseif ($colum == 3)
        {
            $return = 'col-lg-4 col-md-4 col-sm-6 col-12';
        }elseif ($colum == 4)
        {
            $return = 'col-lg-3 col-md-3 col-sm-6 col-12';
        }
        return $return;
    }
}
