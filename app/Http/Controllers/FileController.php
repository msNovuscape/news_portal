<?php

namespace App\Http\Controllers;
use App\library\myFunction;
use File;
use App\Models\Imagetool;
use App\Http\Requests;
use App\Http\Controllers\pagination;
use Illuminate\Http\Request;
use Validator;
use App\Models\MyImage;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->directory)) {
            $directory = rtrim(DIR_IMAGE . $request->directory );
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }

        if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }
        $myfiles = array();

        $directories = File::directories($directory);

        if (!$directories) {
            $directories = array();
        }

        $files = File::files($directory);

        if (!$files) {
            $files = array();
        }

        // Merge directories and files
        $images = array_merge($directories, $files);

        // Get total number of files and directories

        $image_total = count($images);
        $onPage = 30;
        $images = array_splice($images, ($page - 1) * $onPage, $onPage);

        foreach ($images as $image) {
            $name = str_split(basename($image), 14);
            $image=str_replace('\\', '/', $image);

            if (is_dir($image)) {
                $url = '';

                if (isset($request->target)) {
                    $url .= '&target=' . $request->target;
                }

                if (isset($request->thumb)) {
                    $url .= '&thumb=' . $request->thumb;
                }

                $myfiles[] = array(
                    'thumb' => '',
                    'name'  => implode(' ', $name),
                    'type'  => 'directory',
                    'path'  => substr($image, strlen(DIR_IMAGE)),
                    'href'  => url('/admin/filemanager/'.'?directory=' . substr($image, strlen(DIR_IMAGE)) . $url),
                );
            } else {
                // Find which protocol to use to pass the full image link back

                $server = HTTP_CATALOG;


                $myfiles[] = array(
                    'thumb' => Imagetool::mycrop(substr($image, strlen(DIR_IMAGE)), 100, 100),
                    'name'  => implode(' ', $name),
                    'type'  => 'image',
                    'path'  => substr($image, strlen(DIR_IMAGE)),
                    'href'  => $server . 'image/catlog/' . substr($image, strlen(DIR_IMAGE)),
                );
            }
        }








        $data = array();

        if (isset($request->directory)) {
            $mydirectory = $request->directory;
        } else {
            $mydirectory = '';
        }



        // Return the target ID for the file manager to set the value
        if (isset($request->target)) {
            $target = $request->target;
        } else {
            $target = '';
        }

        // Return the thumbnail for the file manager to show a thumbnail
        if (isset($request->thumb)) {
            $thumb = $request->thumb;
        } else {
            $thumb = '';
        }


        // Parent
        $url = '/?';

        if (isset($request->directory)) {
            $pos = strrpos($request->directory, '/');

            if ($pos) {
                $url .= '&directory=' . urlencode(substr($request->directory, 0, $pos));
            }

        }

        if (isset($request->target)) {
            $url .= '&target=' . $request->target;
        }

        if (isset($request->thumb)) {
            $url .= '&thumb=' . $request->thumb;
        }


        $drl='/?';
        if (isset($request->directory)) {

            $drl .= '&directory=' . $request->directory;


        }

        if (isset($request->target)) {
            $drl .= '&target=' . $request->target;
        }

        if (isset($request->thumb)) {
            $drl .= '&thumb=' . $request->thumb;
        }


        $data = array(
            'heading_title' => 'Image Manager',
            'parent' => url('/admin/filemanager'. $url),
            'refresh' => url('/admin/filemanager'. $drl),
            'directory' => $mydirectory,
            'target' => $target,
            'thumb' => $thumb,
        );
        // Refresh



        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($myfiles, $image_total, $onPage);
        $paginator->setPath(url('/admin/filemanager'. $drl));
        return view('admin.filemanager')->with('datas', $data)->with('images', $paginator);






    }

    public function upload(Request $request) {



        $json = array();



        if (isset($request->directory) && !empty($request->directory)) {
            $directory = DIR_IMAGE .$request->directory;
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }

        // Check its a directory
        if (!is_dir($directory)) {
            $json['error'] = 'Directory not found';
        }

        if (!$json) {
            // Sanitize the folder name

            if ($request->hasFile('file')) {

                // Validate the filename length
                $v= Validator::make($request->all(),
                    [
                        'file.*'=>'mimes:jpeg,jpg,png,gif,svg,webp|required|max:10000',

                    ]);
                if($v->fails())
                {
                    $json['error'] = $v;
                }
                foreach ($request->File('file') as $file) {


                    //$path = $directory.'/' . $file->getClientOriginalName();
                    $fname = myFunction::removeSpace($file->getClientOriginalName());
                    $file->move($directory, $fname);
                    //Image::make($file->getRealPath())->save($path);
                }
                # code...
            }





            $json['success'] = 'You have successfully upload file';

            return response()->json($json);
            //$this->response->setOutput(json_encode($json));

        }


    }


    public function folder(Request $request) {



        $json = array();



        if (isset($request->directory) && !empty($request->directory)) {
            $directory = DIR_IMAGE .$request->directory;
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }

        // Check its a directory
        if (!is_dir($directory)) {
            $json['error'] = 'Directory not found';
        }

        if (!$json) {
            // Sanitize the folder name
            $folder = $request['folder'];
            $folder = myFunction::clean($folder);

            // Validate the filename length
            $v= Validator::make($request->all(),
                [
                    'folder'=>'required|min:3|max:250',

                ]);
            if($v->fails())
            {
                $json['error'] = $v;
            }

            // Check if directory already exists or not
            if (is_dir($directory . '/' . $folder)) {
                $json['error'] = 'This Directory is already Exist';
            }


            if (!$json) {
                mkdir($directory . '/' . $folder, 0777);
                chmod($directory . '/' . $folder, 0777);
                $json['success'] = 'Folder Successfully create';
            }

            return response()->json($json);
            //$this->response->setOutput(json_encode($json));

        }


    }


    public function delete(Request $request) {


        $json = array();



        if (isset($request->path)) {

            $paths = explode(',', $request->path) ;
        } else {
            $paths = array();
        }



        // Loop through each path to run validations
        foreach ($paths as $path) {
            $path = DIR_IMAGE . $path;

            // Check path exsists
            if ($path == DIR_IMAGE . 'catalog') {
                $json['error'] = 'Sorry you can not delete this directory';

                break;
            }
            if($path == DIR_IMAGE)
            {
                $json['error'] = 'Sorry you can not delete this Root directory';

                break;
            }
        }

        if (!$json) {
            // Loop through each path
            foreach ($paths as $path) {
                $path = DIR_IMAGE . $path;

                // If path is just a file delete it
                if (is_file($path)) {
                    File::delete($path);

                    // If path is a directory beging deleting each file and sub folder
                } elseif (is_dir($path)) {
                    File::cleanDirectory($path);
                    File::deleteDirectory($path);
                }

            }

            $json['success'] = 'You successfully delete images';
        }

        return response()->json($json);
    }

    public function select_multiple(Request $request)
    {
        $json = array();
        if (isset($request->path)) {

            if ($request->path != '') {
                # code...
            } else{
                $json['error'] = 'Sorry You did not select any file.';
            }
        } else{
            $json['error'] = 'Sorry You did not select any file.';
        }

        if (!$json) {




            if (isset($request->path)) {

                $paths = explode(',', $request->path) ;
            } else {
                $paths = array();
            }
            $json['files'] = array();
            foreach ($paths as $path) {
                $pathd = DIR_IMAGE . $path;

                // If path is just a file delete it
                if (is_file($pathd)) {
                    $image='catalog/back.png';
                    $image_file=Imagetool::mycrop($image, 120, 100);
                    $f_path = Imagetool::mycrop($path, 120, 100);
                    $json['files'][] = array(
                        'fname' => $path,
                        'f_path' => asset($f_path),
                        'placeholder' => asset($image_file)
                    );
                }

            }



        }
        return response()->json($json);

    }


}
