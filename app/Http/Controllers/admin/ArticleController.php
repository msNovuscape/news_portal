<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ImageTool;
use App\Models\Language;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Models\ArticleToMenu;
use App\Models\ArticleDescription;
use App\Models\Menu;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $language_id = 0;
        $deaf = Language::select('id')->where('defa',1)->first();
        if (isset($deaf->id))
        {
            $language_id = $deaf->id;
        }
        $datas['filter_title'] = '';
        $datas['filter_status'] = '';
        $url = 'admin/article?';
        $article = Article::leftJoin('article_description','article_description.article_id','=','article.id')
            ->where('article_description.language_id', $language_id)
            ->selectRaw('article.id,article.status,article_description.title');
        if ($request->filter_title)
        {
            $article->where('article_description.title', 'LIKE', '%'.$request->filter_title.'%');
            $datas['filter_title'] = $request->filter_title;
            $url .= '&filter_title='.$request->filter_title;
        }
        if ($request->filter_status)
        {
            $article->where('article.status', $request->filter_status);
            $datas['filter_status'] = $request->filter_status;
            $url .= '&filter_status='.$request->filter_status;
        }
        $datas['article'] = $article->groupBy('article.id')->paginate(50)->setPath($url);
        $datas['status'][] = ['value' => 1, 'title' => 'Active'];
        $datas['status'][] = ['value' => 2, 'title' => 'Inactive'];


        return view('admin.article.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = UserGroup::checkEditPermission('ArticleController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['language'] = [];
        $languages = Language::where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($languages as $key => $language)
        {

            $description = [
                'title'  => '',
                'seo_url' => '',
                'description'   => '',
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_description'  => ''
            ];

            $active = '';
            if ($key < 1)
            {
                $active = 'active';
            }
            $flag = '';
            if (is_file(DIR_IMAGE.$language->flag))
            {
                $flag = ImageTool::mycrop($language->flag,15,15);
            }
            $datas['language'][] = [
                'id' => $language->id,
                'title' => $language->title,
                'details' => $description,
                'active' => $active,
                'flag'  => $flag
            ];
        }
        return view('admin.article.newform')->with('datas',$datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = UserGroup::checkEditPermission('ArticleController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $this->validate($request,[
            'description.*.title' => 'required',
            'description.*.seo_url' => 'required',
            'description.*.meta_title' => 'required',
        ],[
            'description.*.title.required' => 'Menu Title is required.',
            'description.*.seo_url.required' => 'Menu Seo URL is required.',
            'description.*.meta_title.required' => 'Meta title is required.',
        ]);


        $article = Article::create([
            'image'     => $request->image,
            'video'     => $request->video,
            'visit'    => 0,
            'audio'     => $request->audio,
            'status'    => $request->status,
            'language'  => $request->language
        ]);
        if ($article)
        {
            if ($request->description)
            {
                foreach ($request->description as $key => $value)
                {
                    $newdata = ArticleDescription::firstOrNew(['article_id'    => $article->id, 'language_id'   => $key]);
                    $newdata->article_id = $article->id;
                    $newdata->language_id   = $key;
                    $newdata->title          = $value['title'];
                    $newdata->seo_url     = $value['seo_url'];
                    $newdata->description      = $value['description'];
                    $newdata->meta_title   = $value['meta_title'];
                    $newdata->meta_keyword  = $value['meta_keyword'];
                    $newdata->meta_description = $value['meta_description'];
                    $newdata->save();
                }
            }

            if(isset($request->article_menu)){
                foreach ($request->article_menu as $value) {
                    $data = array(
                        'article_id' => $article->id,
                        'menu_id' => $value,
                    );
                    ArticleToMenu::create($data);
                }
            }
            \Session::flash('alert-success','Record have been updateds Successfully');
            return redirect('admin/article');
        } else{
            \Session::flash('alert-danger','Something went wrong while saving data. Please contact developer');
            return redirect('admin/article');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = UserGroup::checkEditPermission('ArticleController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['article'] = Article::where('id',$id)->first();
        if (!isset($datas['article']->id))
        {
            \Session::flash('alert-danger', 'Data not found');
            return redirect()->back();
        }

        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['image'] = $datas['placeholder'];
        if (is_file(DIR_IMAGE.$datas['article']->image))
        {
            $datas['image'] = ImageTool::mycrop($datas['article']->image,100,100);
        }
        $datas['language'] = [];
        $languages = Language::where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($languages as $key => $language)
        {
            $article_description = ArticleDescription::where('language_id',$language->id)->where('article_id',$datas['article']->id)->first();
            if (isset($article_description->id))
            {
                $description = [
                    'title'  => $article_description->title,
                    'seo_url' => $article_description->seo_url,
                    'description'   => $article_description->description,
                    'meta_title'    => $article_description->meta_title,
                    'meta_keyword'  => $article_description->meta_keyword,
                    'meta_description'  => $article_description->meta_description
                ];

            } else {

                $description = [
                    'title' => '',
                    'seo_url' => '',
                    'description' => '',
                    'meta_title' => '',
                    'meta_keyword' => '',
                    'meta_description' => ''
                ];
            }

            $active = '';
            if ($key < 1)
            {
                $active = 'active';
            }
            $flag = '';
            if (is_file(DIR_IMAGE.$language->flag))
            {
                $flag = ImageTool::mycrop($language->flag,15,15);
            }
            $datas['language'][] = [
                'id' => $language->id,
                'title' => $language->title,
                'details' => $description,
                'active' => $active,
                'flag'  => $flag
            ];
        }

        $datas['menu'] = array();
        $am = ArticleToMenu::where('article_id', $id)->get();
        foreach ($am as $value) {
            if(isset($value->menu_id))
            {
                $menu_id = $value->menu_id;
            } else
            {
                $menu_id = '';
            }
            if(isset($value->id))
            {
                $atm= $value->id;
            } else
            {
                $atm = '';
            }
            if(isset($value->menu_id))
            {
                $menu_title = Menu::getDefaultTitle($value->menu_id);
            } else
            {
                $menu_title = '';
            }
            $datas['menu'][] = array(
                'menu_id' => $menu_id,
                'id' => $atm,
                'menu_title' => $menu_title,
            );
        }
        return view('admin.article.editform')->with('datas',$datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permission = UserGroup::checkEditPermission('ArticleController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $this->validate($request,[
            'id'    => 'required|integer',
            'description.*.title' => 'required',
            'description.*.seo_url' => 'required',
            'description.*.meta_title' => 'required',
        ],[
            'description.*.title.required' => 'Menu Title is required.',
            'description.*.seo_url.required' => 'Menu Seo URL is required.',
            'description.*.meta_title.required' => 'Meta title is required.',
        ]);


        Article::where('id', $request->id)->update([
            'image'     => $request->image,
            'video'     => $request->video,
            'audio'     => $request->audio,
            'status'    => $request->status,
            'language'  => $request->language
        ]);
            if ($request->description)
            {
                foreach ($request->description as $key => $value)
                {
                    $newdata = ArticleDescription::firstOrNew(['article_id'    => $request->id, 'language_id'   => $key]);
                    $newdata->article_id = $request->id;
                    $newdata->language_id   = $key;
                    $newdata->title          = $value['title'];
                    $newdata->seo_url     = $value['seo_url'];
                    $newdata->description      = $value['description'];
                    $newdata->meta_title   = $value['meta_title'];
                    $newdata->meta_keyword  = $value['meta_keyword'];
                    $newdata->meta_description = $value['meta_description'];
                    $newdata->save();
                }
            }

            ArticleToMenu::where('article_id', $request->id)->delete();

            if(isset($request->article_menu)){
                foreach ($request->article_menu as $value) {
                    $data = array(
                        'article_id' => $request->id,
                        'menu_id' => $value,
                    );
                    ArticleToMenu::create($data);
                }
            }
            \Session::flash('alert-success','Record have been updateds Successfully');
            return redirect('admin/article');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = UserGroup::checkEditPermission('ArticleController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
    }
    public function autocomplete(Request $request)
    {
        if (isset($request->term)) {
            $data = ArticleDescription::where('title', 'LIKE', $request->term.'%')->skip(0)->take(10)->get();;
            $result = array();
            foreach ($data as $key => $v) {
                $result[]=['id'=> $v->article_id, 'value'=> $v->title];
            }
            return response()->json($result);
        }
    }
}
