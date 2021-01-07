<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageTool;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuDescription;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Models\Layout;

class MenuController extends Controller
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
    public function index()
    {
        $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $menu = Menu::where('parent_id',0)->get();
        $menus = [];
        foreach ($menu as $flevel) {
            $slevel = [];
            $smenu = Menu::where('parent_id', $flevel->id)->get();
            foreach ($smenu as $sl) {
                $tlevel = [];
                $tmenu = Menu::where('parent_id', $sl->id)->get();
                foreach ($tmenu as $tl) {
                    $tlevel[]= [
                        'id' => $tl->id,
                        'title' => MenuDescription::getTitle($flevel->id).' >> '.MenuDescription::getTitle($sl->id).' >> '.MenuDescription::getTitle($tl->id),
                        'sort_order'  => $tl->sort_order,
                        'edit'        => url('admin/menu/edit/'. $tl->id),
                        'delete'      => url('admin/menu/delete/'. $tl->id),
                    ];
                }
                $slevel[] = [
                    'id' => $sl->id,
                    'title' => MenuDescription::getTitle($flevel->id).' >> '.MenuDescription::getTitle($sl->id),
                    'sort_order'  => $sl->sort_order,
                    'children' => $tlevel,
                    'edit'        => url('admin/menu/edit/'. $sl->id),
                    'delete'      => url('admin/menu/delete/'. $sl->id),
                ];
            }
            $menus[] = [
                'id' => $flevel->id,
                'title' => MenuDescription::getTitle($flevel->id),
                'sort_order'  => $flevel->sort_order,
                'children' => $slevel,
                'edit'        => url('admin/menu/edit/'. $flevel->id),
                'delete'      => url('admin/menu/delete/'. $flevel->id),
            ];

        }


        return view('admin.menu.index')->with('datas', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = UserGroup::checkEditPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];
        $datas['layout'] = Layout::orderBy('layout_title', 'asc')->get();
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
        return view('admin.menu.newform')->with('datas',$datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = UserGroup::checkEditPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $this->validate($request,[
            'description.*.title' => 'required',
            'description.*.seo_url' => 'required',
            'description.*.meta_title' => 'required',
            'layout_id' => 'required|integer',
            'sort_order' => 'required'
        ],[
            'description.*.title.required' => 'Menu Title is required.',
            'description.*.seo_url.required' => 'Menu Seo URL is required.',
            'description.*.meta_title.required' => 'Meta title is required.',
        ]);
        $parent_id = 0;
        if ($request->parent_id)
        {
            $parent_id = $request->parent_id;
        }

        $menu = Menu::create([
            'parent_id'     => $parent_id,
            'sort_order'    => $request->sort_order,
            'status'        => $request->status,
            'layout_id'     => $request->layout_id,
            'image'         => $request->image,
            'language'  => $request->language
        ]);
        if ($menu)
        {
            if ($request->description)
            {
                foreach ($request->description as $key => $value)
                {
                    $newdata = MenuDescription::firstOrNew(['menu_id'    => $menu->id, 'language_id'   => $key]);
                    $newdata->menu_id = $menu->id;
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
            \Session::flash('alert-success','Record have been updateds Successfully');
            return redirect('admin/menu');
        } else{
            \Session::flash('alert-danger','Something went wrong while saving data. Please contact developer');
            return redirect('admin/menu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $permission = UserGroup::checkEditPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];
        $datas['layout'] = Layout::orderBy('layout_title', 'asc')->get();
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['menu'] = Menu::where('id',$id)->first();
        $datas['image'] = $datas['placeholder'];
        if (is_file(DIR_IMAGE.$datas['menu']->image))
        {
            $datas['image'] = ImageTool::mycrop($datas['menu']->image,100,100);
        }
        $datas['language'] = [];
        $languages = Language::where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($languages as $key => $language)
        {
            $setting_description = MenuDescription::where('language_id',$language->id)->where('menu_id',$datas['menu']->id)->first();
            if (isset($setting_description->id))
            {
                $description = [
                    'title'  => $setting_description->title,
                    'seo_url' => $setting_description->seo_url,
                    'description'   => $setting_description->description,
                    'meta_title'    => $setting_description->meta_title,
                    'meta_keyword'  => $setting_description->meta_keyword,
                    'meta_description'  => $setting_description->meta_description
                ];

            } else{
                $description = [
                    'title'  => '',
                    'seo_url' => '',
                    'description'   => '',
                    'meta_title'    => '',
                    'meta_keyword'  => '',
                    'meta_description'  => ''
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
        return view('admin.menu.editform')->with('datas',$datas);
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
        $permission = UserGroup::checkEditPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $this->validate($request,[
            'description.*.title' => 'required',
            'description.*.seo_url' => 'required',
            'description.*.meta_title' => 'required',
            'layout_id' => 'required|integer',
            'sort_order' => 'required',
            'id'        => 'required|integer'
        ],[
            'description.*.title.required' => 'Menu Title is required.',
            'description.*.seo_url.required' => 'Menu Seo URL is required.',
            'description.*.meta_title.required' => 'Meta title is required.',
        ]);
        $parent_id = 0;
        if ($request->parent_id)
        {
            $parent_id = $request->parent_id;
        }

        Menu::where('id', $request->id)->update([
            'parent_id'     => $parent_id,
            'sort_order'    => $request->sort_order,
            'status'        => $request->status,
            'layout_id'     => $request->layout_id,
            'image'         => $request->image,
            'language'  => $request->language
        ]);
            if ($request->description)
            {
                foreach ($request->description as $key => $value)
                {
                    $newdata = MenuDescription::firstOrNew(['menu_id'    => $request->id, 'language_id'   => $key]);
                    $newdata->menu_id = $request->id;
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
            \Session::flash('alert-success','Record have been updateds Successfully');
            return redirect('admin/menu');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = UserGroup::checkEditPermission('MenuController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        Menu::where('parent_id', $id)->delete();
        Menu::where('id', $id)->delete();
        \Session::flash('alert-success', 'Data deleted successfully.');
        return redirect()->back();
    }

    public function autocomplete(Request $request)
    {
        if (isset($request->term)) {



            $data = MenuDescription::where('title', 'LIKE', $request->term.'%')->skip(0)->take(10)->get();;

            $result = array();
            $result[]=['id'=> '0', 'value'=> 'Root'];
            foreach ($data as $key => $v) {
                $result[]=['id'=> $v->menu_id, 'value'=> $v->title];
            }
            return response()->json($result);
        }
    }


}
