<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToMenu extends Model
{
    protected $table = 'article_to_menu';

    protected $fillable = array('article_id', 'menu_id' );


    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
