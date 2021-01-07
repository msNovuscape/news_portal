<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\library\Settings;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Layout;

class HomeController extends Controller
{
    public function index( Request $request, $datas = [])
    {
        $layouts= Layout::where('layout_route', 'Home')->first();
        if(isset($datas['layout_id']))
        {
            $layout_id = $datas['layout_id'];
        }
        elseif(isset($layouts->id))
        {
            $layout_id = $layouts->id;
        }
        else
        {
            $layout_id = '';
        }
        if (isset($datas['meta_title']))
        {
            $meta_title = $datas['meta_title'];
            $meta_keyword = $datas['meta_keyword'];
            $meta_description = $datas['meta_description'];
            $meta_image = $datas['meta_image'];
            $title = $datas['title'];
            $meta_url = $datas['url'];
        } else{
            $settings = Settings::getSeetingWithDescription();
            $meta_title = $settings['description']->meta_title;
            $meta_keyword = $settings['description']->meta_keyword;
            $meta_description = $settings['description']->meta_description;
            $meta_image = asset(Settings::getLogo());
            $title = $settings['description']->name;
            $meta_url = '/';
        }


        $config = array(
            'app.meta_title' => $meta_title,
            'app.meta_keyword' => $meta_keyword,
            'app.meta_description' => $meta_description,
            'app.meta_image' => $meta_image,
            'app.meta_url' => $meta_url,
            'app.meta_type' => 'website',

        );
        config($config);

        $main_content = Module::getModules($layout_id, 'content_main');

        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
            $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
            $content_main = new $cont();
            $datas['main_modules'][] = array(
                'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
        }


        $left_content = Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
            $left_module = new $lcontent();
            $datas['left_content'][] = array(
                'module' => $left_module->index($left->module_id,json_decode($left->setting)),
            );
        }
        $right_content = Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
            $right_module = new $lcontent();
            $datas['right_content'][] = array(
                'module' => $right_module->index($right->module_id,json_decode($right->setting)),
            );
        }
        $top_content = Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
            $top_module = new $lcontent();
            $datas['top_content'][] = array(
                'module' => $top_module->index($top->module_id,json_decode($top->setting)),
            );
        }
        $bottom_content = Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
            $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
                'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
            );
        }
        $header_content = Module::getModules($layout_id, 'content_header');
        $datas['header_content'] = array();
        foreach ($header_content as $header) {
            $hcontent= '\App\Http\Controllers\front\module\\'.$header->module_page.'Controller';
            $header_module = new $hcontent();
            $datas['header_content'][] = array(
                'module' => $header_module->index($header->module_id,json_decode($header->setting)),
            );
        }
        return view('front.home')->with('datas',$datas);

    }

    public function changeLanguage($id)
    {
        session()->flush('language');
        session(['language' => $id]);
        return redirect()->back();
    }
}
