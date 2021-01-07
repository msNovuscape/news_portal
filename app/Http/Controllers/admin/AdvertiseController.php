<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageTool;
use App\Models\Advertise;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Validator;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = UserGroup::checkPermission('AdvertiseController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['advertise'] = Advertise::orderBy('id', 'desc')->paginate(50);
        return view('admin.advertise.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = UserGroup::checkEditPermission('AdvertiseController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];
        return view('admin.advertise.newform')->with('datas', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = UserGroup::checkEditPermission('AdvertiseController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $this->validate($request, [
            'title'     => 'required',
            'href'      => 'required|url',
            'image'      => 'required',
        ]);


        Advertise::create([
            'title'     => $request->title,
            'href'      => $request->href,
            'image'     => $request->image,
            'status'    => $request->status
        ]);
        \Session::flash('alert-success', 'Record saved successfully');
        return redirect('/admin/advertise');
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
        $permission = UserGroup::checkEditPermission('AdvertiseController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $datas['advertise'] = Advertise::where('id', $id)->first();
        if (!isset($datas['advertise']->id))
        {
            \Session::flash('alert-danger', 'Data not found');
            return redirect()->back();
        }
        $datas['placeholder'] = ImageTool::mycrop('no-image.png', 100,100);
        $datas['status'][] = ['value' => 1, 'title' => 'Enable'];
        $datas['status'][] = ['value' => 0, 'title' => 'Disable'];

        $datas['image'] = $datas['placeholder'];
        if (is_file(DIR_IMAGE.$datas['advertise']->image))
        {
            $datas['image'] = ImageTool::mycrop($datas['advertise']->image,100,100);
        }

        return view('admin.advertise.editform')->with('datas', $datas);
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
        $permission = UserGroup::checkEditPermission('AdvertiseController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $this->validate($request, [
            'id'        => 'required|integer',
            'title'     => 'required',
            'href'      => 'required|url',
            'image'      => 'required',
        ]);


        Advertise::where('id',$request->id)->update([
            'title'     => $request->title,
            'href'      => $request->href,
            'image'     => $request->image,
            'status'    => $request->status
        ]);
        \Session::flash('alert-success', 'Record saved successfully');
        return redirect('/admin/advertise');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Advertise::where('id',$id)->delete();

        \Session::flash('alert-success', 'Data deleted successfully');
        return redirect()->back();
    }
}
