<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $this->authorize('setting.update');
        Setting::flushCache();

        return view('admin.setting.index');
    }

    public function update(Request $request){
        $this->authorize('setting.update');

        foreach ($request->input('data') as $key=>$string){
            if(!is_array($string)){
                $value = $string;
                $type="string";
            }else{
                $type="array";
            }

            Setting::set($key,$value,$type);
        }

     return  flash(__('_the_record_is_updated_successfully'));
    }
}
