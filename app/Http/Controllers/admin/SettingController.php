<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageTool;
use App\Models\SettingDescription;
use Illuminate\Http\Request;
use App\Models\UserGroup;
use App\Models\Setting;
use App\Models\Language;
use App\Models\SettingSocial;
use App\Models\SettingEmail;
use App\Models\SettingImage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = UserGroup::checkPermission('SettingController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }

        $setting = Setting::where('id', '1')->first();

        if($setting){
            $datas['setting'] = $setting;
            $datas['emails']= $setting->settingEmail;
            $datas['image']= $setting->settingImage;
            $datas['socials']= $setting->settingSocial;
            $datas['language'] = [];
            $languages = Language::where('status', 1)->orderBy('sort_order', 'asc')->get();
            foreach ($languages as $key => $language)
            {
                $setting_description = SettingDescription::where('language_id',$language->id)->first();
                if (isset($setting_description->id))
                {
                    $description = [
                        'name'  => $setting_description->name,
                        'telephone' => $setting_description->telephone,
                        'address'   => $setting_description->address,
                        'meta_title'    => $setting_description->meta_title,
                        'meta_keyword'  => $setting_description->meta_keyword,
                        'meta_description'  => $setting_description->meta_description
                    ];

                } else{
                    $description = [
                        'name'  => '',
                        'telephone' => '',
                        'address'   => '',
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



            return view('admin.setting.editform')->with('datas', $datas);
        } else {
            return 'No Data Found';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $permission = UserGroup::checkEditPermission('SettingController');
        if($permission == 1){

            return view('admin.noPermission');
            exit;
        }
        $this->validate($request, [
            'email'=>'required|email',
            'item_perpage' => 'required|numeric',
            'description_limit' => 'required|numeric',
        ]);

            $data = array(
                'email' => $request->email,
                'item_perpage' => $request->item_perpage,
                'description_limit' => $request->description_limit,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'google_analytics' => $request->google_analytic,

            );
            Setting::where('id', $request->setting_id)->update($data);

            $images = array(

                'logo' => $request['logo'],
                'icon' => $request['icon'],
                'thumb_height' => $request['thumb_height'],
                'thumb_width' => $request['thumb_width'],
                'image_height' => $request['image_height'],
                'image_width' => $request['image_width'],
            );

            SettingImage::where('setting_id', $request->setting_id)->update($images);




            $email = array(

                'protocal' => $request['protocal'],
                'parameter' => $request['parameter'],
                'hostname' => $request['host_name'],
                'username' => $request['username'],
                'password' => $request['password'],
                'smtp_port' => $request['smtp_port'],
                'encription' => $request['encription'],
            );

            SettingEmail::where('setting_id', $request->setting_id)->update($email);



            $social = array(
                'setting_id' => $request->setting_id,
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'gplus' => $request['gplus'],
                'youtube' => $request['youtube'],
                'linkedin' => $request['linkedin'],
            );

            SettingSocial::where('setting_id', $request->setting_id)->update($social);

            if ($request->description)
            {
                foreach ($request->description as $key => $value)
                {
                    $newdata = SettingDescription::firstOrNew(['setting_id'    => $request->setting_id, 'language_id'   => $key]);
                    $newdata->setting_id = $request->setting_id;
                    $newdata->language_id   = $key;
                    $newdata->name          = $value['title'];
                    $newdata->telephone     = $value['telephone'];
                    $newdata->address      = $value['address'];
                    $newdata->meta_title   = $value['meta_title'];
                    $newdata->meta_keyword  = $value['meta_keyword'];
                    $newdata->meta_description = $value['meta_description'];
                    $newdata->save();
                }
            }


            \Session::flash('alert-success','Record have been updateds Successfully');
            return redirect('admin/setting');

    }


}
