<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageTool;
use App\Models\Language;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = UserGroup::checkPermission('LanguageController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['language'] = Language::orderBy('title', 'asc')->paginate(50);
        return view('admin.language.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = UserGroup::checkEditPermission('LanguageController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];

        $datas['defa'][] = ['value' => 0, 'title' => 'None Default'];
        $datas['defa'][] = ['value' => 1, 'title' => 'Default'];
        return view('admin.language.newform')->with('datas', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = UserGroup::checkEditPermission('LanguageController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $this->validate($request, [
            'title'     => 'required|max:255|unique:language',
            'code'      => 'required',
            'image'      => 'required',
            'sort_order'    => 'required',
            'status'    => 'required',
            'defa'      => 'required'
        ]);
        if ($request->defa == 1)
        {
            Language::where('id', '>', 0)->update(['defa' => 0]);
        }

        Language::create([
            'title'     => $request->title,
            'code'      => $request->code,
            'flag'      => $request->image,
            'sort_order'=> $request->sort_order,
            'status'    => $request->status,
            'defa'      => $request->defa
        ]);
        \Session::flash('alert-success', 'Record saved successfully');
        return redirect('/admin/language');
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
        $permission = UserGroup::checkEditPermission('LanguageController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['language'] = Language::where('id', $id)->first();
        if (!isset($datas['language']->id))
        {
            \Session::flash('alert-danger', 'Data not found');
            return redirect()->back();
        }
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];

        $datas['defa'][] = ['value' => 0, 'title' => 'None Default'];
        $datas['defa'][] = ['value' => 1, 'title' => 'Default'];
        $datas['image'] = $datas['placeholder'];
        if (is_file(DIR_IMAGE.$datas['language']->flag))
        {
            $datas['image'] = ImageTool::mycrop($datas['language']->flag,100,100);
        }

        return view('admin.language.editform')->with('datas', $datas);
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
        $permission = UserGroup::checkEditPermission('LanguageController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $this->validate($request, [
            'id'        => 'required|integer',
            'title'     => 'required|max:255|unique:language,title,'.$request->id.',id',
            'code'      => 'required',
            'image'      => 'required',
            'sort_order'    => 'required',
            'status'    => 'required',
            'defa'      => 'required'
        ]);
        $language = Language::where('id', $request->id)->first();
        if (isset($language->id))
        {
            if ($language->defa == 1 && $request->defa != 1)
            {
                $ol = Language::where('id','!=', $request->id)->first();
                if (isset($ol->id))
                {
                    Language::where('id', $ol->id)->update(['defa' => 1]);
                }
            }
        }
        if ($request->defa == 1)
        {
            Language::where('id', '>', 0)->update(['defa' => 0]);
        }

        Language::where('id',$request->id)->update([
            'title'     => $request->title,
            'code'      => $request->code,
            'flag'      => $request->image,
            'sort_order'=> $request->sort_order,
            'status'    => $request->status,
            'defa'      => $request->defa
        ]);
        \Session::flash('alert-success', 'Record saved successfully');
        return redirect('/admin/language');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::where('id',$id)->first();
        if (!isset($language->id))
        {
            \Session::flash('alert-danger', 'Data not found');
            return redirect()->back();
        }
        if ($language->defa == 1)
        {
            \Session::flash('alert-danger', 'You can not delete default language. Change the other language to default');
            return redirect()->back();
        }
        $language->delete();
        \Session::flash('alert-success', 'Data deleted successfully');
        return redirect()->back();
    }
}
