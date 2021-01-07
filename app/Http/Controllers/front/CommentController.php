<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\library\Settings;
use App\Models\Article;
use App\Models\ArticleToMenu;
use App\Models\Comment;
use App\Models\ImageTool;
use App\Models\Layout;
use App\Models\Menu;
use App\Models\Module;
use App\Models\SettingDescription;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $mydata = array(

            'article_id' => $request->article_id,
            'comment' => $request->comment,
            'name' => $request->name,
            'email' => $request->email,
            'status' => 0,

        );
        $comment = Comment::create($mydata);
        if($comment)
        {
            return redirect()->back();
        }
    }
/*    public function index(Request $request, $seo_url = '')
    {

        $layouts = Layout::where('layout_route', 'Article')->first();
        if (isset($layouts->id)) {
            $layout_id = $layouts->id;
        } else {
            $layout_id = '';
        }

        $language = 0;
        if (Session()->has('language')) {
            $language = session()->get('language');
        }

        $datas['articles'] = Article::leftJoin('article_description', 'article.id', '=', 'article_description.article_id')
            ->where('article_description.language_id', $language)
            ->where('article.status', 1)
            ->where('article_description.seo_url', $seo_url)
            ->groupBy('article.id')
            ->firstOrFail();

        $datas['image'] = '';
        $datas['video'] = '';
        $datas['comments'] = [];
        if ($datas['articles'])
        {
            $visit = $datas['articles']->visit + 1;
            Article::where('id', $datas['articles']->article_id)->update(['visit' => $visit]);
            if (is_file(DIR_IMAGE.$datas['articles']->image))
            {
                $datas['image'] = asset(ImageTool::mycrop($datas['articles']->image, 900,600));
            }

            if ($datas['articles']->video != '')
            {
                $datas['video'] = str_replace('watch?v=', 'embed/', $datas['articles']->video);
            }
        }


        $config = array(
            'app.meta_title' => $datas['articles']->meta_title,
            'app.meta_keyword' => $datas['articles']->meta_keyword,
            'app.meta_description' => $datas['articles']->meta_description,
            'app.meta_image' => $datas['image'],
            'app.meta_url' => url('/article/'.$seo_url),
            'app.meta_type' => 'website',

        );
        config($config);


        $page_setting = Settings::getSettings();
        $seting_des = SettingDescription::select('name')->where('setting_id', $page_setting->id)->where('language_id', $language)->first();
        $datas['pagination'][] = ['title' => $seting_des->name, 'url' => url('/')];

        $menu = ArticleToMenu::where('article_id', $datas['articles']->article_id)->first();

        if ($menu) {
            $fmenu = Menu::leftJoin('menu_description', 'menu.id', '=', 'menu_description.menu_id')
                ->selectRaw('menu.parent_id,menu.id,menu_description.title,menu_description.seo_url')
                ->where('menu.id', $menu['menu_id'])
                ->where('menu_description.language_id', $language)
                ->first();
            if ($fmenu->parent_id > 0) {
                $smenu = Menu::leftJoin('menu_description', 'menu.id', '=', 'menu_description.menu_id')
                    ->selectRaw('menu.parent_id,menu_id,menu_description.title,menu_description.seo_url')
                    ->where('menu.id', $fmenu->parent_id)
                    ->where('menu_description.language_id', $language)
                    ->first();
                if ($smenu->parent_id > 0)
                {
                    $tmenu = Menu::leftJoin('menu_description', 'menu.id', '=', 'menu_description.menu_id')
                        ->selectRaw('menu.parent_id,menu_id,menu_description.title,menu_description.seo_url')
                        ->where('menu.id', $smenu->parent_id)
                        ->where('menu_description.language_id', $language)
                        ->first();
                    $datas['pagination'][] = ['title' => $tmenu->title, 'url' => url($tmenu->seo_url)];
                }
                $datas['pagination'][] = ['title' => $smenu->title, 'url' => url($smenu->seo_url)];
            }

            $datas['pagination'][] = ['title' => $fmenu->title, 'url' => url($fmenu->seo_url)];
        }
        $datas['pagination'][] = ['title' => $datas['articles']->title, 'url' => ''];

        $datas['title'] = '';



        $main_content = Module::getModules($layout_id, 'content_main');

        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
            $cont = '\App\Http\Controllers\front\module\\' . $main->module_page . 'Controller';
            $content_main = new $cont();
            $datas['main_modules'][] = array(
                'module' => $content_main->index($main->module_id, json_decode($main->setting)),);
        }


        $left_content = Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
            $lcontent = '\App\Http\Controllers\front\module\\' . $left->module_page . 'Controller';
            $left_module = new $lcontent();
            $datas['left_content'][] = array(
                'module' => $left_module->index($left->module_id, json_decode($left->setting)),
            );
        }
        $right_content = Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
            $lcontent = '\App\Http\Controllers\front\module\\' . $right->module_page . 'Controller';
            $right_module = new $lcontent();
            $datas['right_content'][] = array(
                'module' => $right_module->index($right->module_id, json_decode($right->setting)),
            );
        }
        $top_content = Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
            $lcontent = '\App\Http\Controllers\front\module\\' . $top->module_page . 'Controller';
            $top_module = new $lcontent();
            $datas['top_content'][] = array(
                'module' => $top_module->index($top->module_id, json_decode($top->setting)),
            );
        }
        $bottom_content = Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
            $lcontent = '\App\Http\Controllers\front\module\\' . $bottom->module_page . 'Controller';
            $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
                'module' => $bottom_module->index($bottom->module_id, json_decode($bottom->setting)),
            );
        }
        $header_content = Module::getModules($layout_id, 'content_header');
        $datas['header_content'] = array();
        foreach ($header_content as $header) {
            $hcontent = '\App\Http\Controllers\front\module\\' . $header->module_page . 'Controller';
            $header_module = new $hcontent();
            $datas['header_content'][] = array(
                'module' => $header_module->index($header->module_id, json_decode($header->setting)),
            );
        }
        return view('front.singlearticle')->with('datas', $datas);
    }*/
}
