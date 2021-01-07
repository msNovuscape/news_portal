<?php

namespace App\Http\Controllers\admin;

use App\Models\GroupAccess;
use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use File;

class UserGroupController extends Controller
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
        $usergroup = UserGroup::orderBy('group_title', 'asc')->paginate(50);


        return view('admin.usergroup.index')->with('data',$usergroup);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files = [];

        $maindirs = File::files(__DIR__);
        foreach ($maindirs as $maindir) {

            //$data = explode('/', dirname($maindir));
            $permission = basename($maindir, '.php');

            $string = str_replace('Controller', ' Manager', $permission);
            $files[] = ['value' => $permission, 'title' => $string];
        }

        $folders = File::directories(__DIR__);
        if (count($folders) > 0)
        {
            foreach ($folders as $folder)
            {
                $fnames = explode('/',$folder);
                $scapes = ['module','payments'];
                if (!in_array(end($fnames),$scapes))
                {
                    $newfolders = File::files($folder);
                    foreach ($newfolders as $newfolder) {

                        //$data = explode('/', dirname($maindir));
                        $permission = basename($newfolder, '.php');

                        $string = str_replace('Controller', ' Manager', $permission);
                        $files[] = ['value' => $permission, 'title' => $string];
                    }
                }
            }
        }


        return view('admin.usergroup.newform')->with('files',$files);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'group_title'=>'required|unique:user_group|min:3'
        ]);


        $usergroups= UserGroup::create(['group_title' => $request->group_title]);
        if($usergroups)
        {
            if(isset($request->permission))
            {
                foreach ($request->permission as $key => $permission)
                {
                    $edit_access = '';
                    if (isset($request['editpermission'][$key]))
                    {
                        $edit_access = $request['editpermission'][$key];
                    }
                    $savedata = [
                        'user_group_id' => $usergroups->id,
                        'access_page' => $permission,
                        'edit_page' => $edit_access
                    ];


                    GroupAccess::create($savedata);
                }
            }
            \Session::flash('alert-success','Record have been saved Successfully');
            return redirect('admin/usergroup');

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
        $datas=UserGroup::where('id',$id)->first();
        if($datas) {
            $permissions=$datas->GroupAccess;
            $files = [];

            $maindirs = File::files(__DIR__);
            foreach ($maindirs as $maindir) {

                //$data = explode('/', dirname($maindir));
                $permission = basename($maindir, '.php');

                $string = str_replace('Controller', ' Manager', $permission);
                $files[] = ['value' => $permission, 'title' => $string];
            }

            $folders = File::directories(__DIR__);
            if (count($folders) > 0)
            {
                foreach ($folders as $folder)
                {
                    $fnames = explode('/',$folder);
                    $scapes = ['module','payments'];
                    if (!in_array(end($fnames),$scapes))
                    {
                        $newfolders = File::files($folder);
                        foreach ($newfolders as $newfolder) {

                            //$data = explode('/', dirname($maindir));
                            $permission = basename($newfolder, '.php');

                            $string = str_replace('Controller', ' Manager', $permission);
                            $files[] = ['value' => $permission, 'title' => $string];
                        }
                    }
                }
            }

            return view('admin.usergroup.editform')->with('files',$files)->with('access',$permissions)->with('datas',$datas);
        } else {

            \Session::flash('alert-danger','You choosed wrong usergroup');
            return redirect('admin/usergroup');
        }
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
        $this->validate($request, [
            'group_title'=>'required|min:3|unique:user_group,group_title,'.$request->id.',id'

        ]);

        UserGroup::where('id', $request->id)->update(['group_title' => $request->group_title]);
        GroupAccess::where('user_group_id', $request->id)->delete();
        if(isset($request->permission))
        {
            foreach ($request->permission as $key => $permission)
            {
                $edit_page = '';
                if (isset($request['editpermission'][$key]))
                {
                    $edit_page = $request['editpermission'][$key];
                }
                $editdata = [
                    'user_group_id' => $request->id,
                    'access_page' => $permission,
                    'edit_page' => $edit_page
                ];

                GroupAccess::create($editdata);
            }
        }
        \Session::flash('alert-success','Record have been saved Successfully');
        return redirect('admin/usergroup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $i= UserGroup::where('id', $id)->delete();
        if($i)
        {

            \Session::flash('alert-success','Record deleted Successfully');
            return redirect('admin/usergroup');
        }
        else
        {
            \Session::flash('alert-danger','Something Went Wrong on Deleting usergroup');
            return redirect('admin/usergroup');
        }
    }
}
