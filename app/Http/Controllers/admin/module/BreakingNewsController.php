<?php

namespace App\Http\Controllers\admin\module;

use App\Http\Controllers\Controller;
use App\Models\ImageTool;
use App\Models\ModuleDescription;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Language;

class BreakingNewsController extends Controller
{
    public function index()
    {
        $datas['language'] = [];
        $languages = Language::where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($languages as $key => $language)
        {

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
                'active' => $active,
                'flag'  => $flag
            ];
        }
        $datas['lang'][] = ['value' => '0', 'title' => 'Select Language'];
        $datas['lang'][] = ['value' => '1', 'title' => 'English'];
        $datas['module_page'] = 'BreakingNews';
        return view('admin.module.breakingnews.newform')->with('datas', $datas);
    }
    public function edit($id)
    {
        $module = Module::where('id', $id)->first();
        $datas['module_page'] = $module->module_page;
        $datas['setting'] = json_decode($module->setting);
        $datas['id'] = $id;
        $datas['language'] = [];
        $languages = Language::where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($languages as $key => $language)
        {
            $module_description = ModuleDescription::where('language_id',$language->id)->where('module_id',$id)->first();
            if (isset($module_description->id))
            {
                $description = [
                    'title'  => $module_description->title,
                ];

            } else {

                $description = [
                    'title' => '',
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
                'active' => $active,
                'flag'  => $flag,
                'detail' => $description
            ];
        }
        $datas['lang'][] = ['value' => '0', 'title' => 'Select Language'];
        $datas['lang'][] = ['value' => '1', 'title' => 'English'];
        $datas['module_page'] = 'BreakingNews';
        return view('admin.module.breakingnews.editform')->with('datas', $datas);
    }
}
