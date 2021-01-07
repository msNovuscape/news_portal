<?php

namespace App\Http\Controllers\front\module;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\ModuleDescription;


class AdvertiseModuleController extends Controller
{
    public function index($id,$setting)
    {
        $language_id = 0;
        if (Session()->has('language'))
        {
            $language_id = session()->get('language');
        }

        $module_description = ModuleDescription::select('title')->where('module_id', $id)->where('language_id',$language_id)->first();

        $datas['title'] = '';
        if (isset($module_description->title))
        {
            $datas['title'] = $module_description->title;
        }
        $datas['advertise'] =[];
        $datas['class'] = '';

        if (is_array($setting->advertise)) {


            if (count($setting->advertise) > 0) {
                $ids = [];
                foreach ($setting->advertise as $value) {
                    $ids[] = $value->id;
                }
                $datas['advertise'] = Advertise::whereIn('id',$ids)->get();
                if ($setting->column_no == 1) {
                    $datas['class'] = 'col-lg-12 col-md-12 col-sm-12 col-12 mb-2';
                } else {
                    $datas['class'] = 'col-lg-6 col-md-6 col-sm-6 col-12 bm-2';
                }
            }
        }

        return view('front.module.advertise')->with('datas', $datas);

    }
}
