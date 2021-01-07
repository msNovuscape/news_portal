<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDescription extends Model
{
    protected $table = 'article_description';
    protected $fillable = ['article_id', 'language_id', 'title', 'seo_url', 'description', 'meta_title', 'meta_keyword', 'meta_description'];

    function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function getTitle($article_id)
    {
        $language = 0;
        if (Session()->has('language'))
        {
            $language = session()->get('language');
        }
        $title = '';
        $des = ArticleDescription::select('title')->where('article_id', $article_id)->where('language_id', $language)->first();
        if (isset($des->title))
        {
            $title = $des->title;
        }
        return $title;
    }
}
