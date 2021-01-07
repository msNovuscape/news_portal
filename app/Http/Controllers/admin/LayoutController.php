<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class LayoutController extends Controller
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
        $permission = UserGroup::checkPermission('LayoutController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $layout = Layout::orderBy('layout_title','asc')->paginate(50);

        return view('admin.layout.index')->with('data',$layout);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = UserGroup::checkEditPermission('LayoutController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        return view('admin.layout.newform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = UserGroup::checkEditPermission('LayoutController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }



        $this->validate($request,
            [
                'layout_title'=>'required|min:3',
                'route' => 'required',

            ]);


        $data = array(

            'layout_title' => $request->layout_title,
            'layout_route' => $request->route,

        );
        $language=Layout::create($data);
        if($language)
        {

            \Session::flash('alert-success','Record have been saved Successfully');
            return redirect('admin/layout');

        } else {

            \Session::flash('alert-danger','Something Went Wrong on Deleting data');
            return redirect('admin/layout');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $permission = UserGroup::checkEditPermission('LayoutController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }


        $i=Layout::where('layout_id',$id)->delete();
        if($i)
        {

            \Session::flash('alert-success','Record deleted Successfully');
            return redirect('admin/layout');
        }
        else
        {
            \Session::flash('alert-danger','Something Went Wrong on Deleting data');
            return redirect('admin/layout');
        }
    }
}
