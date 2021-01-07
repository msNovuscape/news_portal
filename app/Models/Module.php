<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Driver\Session;
use DB;

class Module extends Model
{
    protected $table = 'module';
    protected $fillable = array('title', 'setting', 'module_page', 'language' );
    protected $primaryKey = 'id';
    public function moduleDisplay()
    {
        return $this->hasMany(ModuleDisplay::class);
    }

    public static function getTitle($id)
    {
        $title = '';
        $language = 0;
        if (Session()->has('language')) {
            $language = Session()->get('language');
        }
        $des = ModuleDescription::select('title')->where('module_id', $id)->where('language_id', $language)->first();
        if (isset($des->title))
        {
            $title = $des->title;
        }
        return $title;
    }

    public static function getModules($layout_id, $page)
    {


        $article=DB::table('module_display as a');
        $article->leftJoin('module as ad', 'a.module_id', '=', 'ad.id');

        $article->where('a.layout_id', $layout_id);

        $article->where('a.position', $page);
        $article->where('a.status', 1);


        $article->orderBy('a.sort_order', 'asc');
        $articles = $article->get();
        return $articles;
    }
}
