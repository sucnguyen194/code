<?php

use App\Models\Setting;


if(!function_exists('languages')){
    function languages(){
        return session('language');
    }
}


if(!function_exists('resize_image')){
    function resize_image($image, $size = 'm'){
        $check = strpos($image,'i.imgur.com');
        if($check == false)
            return  $image;

        $jpg = strpos($image,'.jpg');
        if($jpg == true)
            return str_replace('.jpg',$size.'.jpg',$image);

        $png = strpos($image,'.png');
        if($png == true)
            return str_replace('.png',$size.'.png',$image);

        $gif = strpos($image,'.gif');
        if($gif == true)
            return str_replace('.gif',$size.'.gif',$image);

        $webp = strpos($image,'.webp');
        if($webp == true)
            return str_replace('.webp',$size.'.webp',$image);

        return $image;
    }
}

if (! function_exists('setting')) {

    function setting($key=null, $config =null,  $default = null)
    {
        if (is_null($key)) {
            return new Setting();
        }
        if($config)
            $key = $key.'.'.session('lang');

        if (is_array($key)) {
            return Setting::set($key[0], $key[1]);
        }

        $value = Setting::get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (! function_exists('nav_active')) {

    function nav_active($segment, $class='active')
    {
        //  $segment = str_replace(['index','create'],['*'],$segment);
        $path = request()->path();
        return $path == $segment.'.html' ? $class : "";
    }
}

if (! function_exists('nav_actives')) {

    function nav_actives($segment, $class='active')
    {
        return request()->is($segment) ? $class : '';
    }
}

if (! function_exists('date_range')) {

    function date_range($format_in = 'd/m/Y')
    {
        if (!request()->date)
            return null;

        $parts = explode('-', str_replace(' ', '', request()->date));
        if (!$parts){
            return null;
        }

        $range['from'] = \Carbon\Carbon::createFromFormat($format_in, $parts[0]);
        $range['to'] = \Carbon\Carbon::createFromFormat($format_in, $parts[1]);
        return $range;
    }
}

if (! function_exists('flash')) {

    function flash($message= null,$type=1,$url=null,$target='_self')
    {
        $types=[
            0=>'error',
            1=>'success',
            2=>'info',
            3=>'warning',
        ];
        $m['type']=$types[$type];
        $m['message']=$message;
        $m['url']=$url;
        $m['target']=$target;

        session()->flash('message',$m);

        if (request()->ajax()){
            session()->forget('message');
            return response()->json($m);
        }

        if($url)
            return redirect($url);

        return back()->withInput();
    }
}

if(!function_exists('selected')){
    function selected($a,$b){
        if($a == $b)
            return "selected";
        if(is_array($b) && in_array($a,$b))
            return "selected";
        return "";
    }
}

if(!function_exists('checked')){
    function checked($a,$b){
        if($a == $b)
            return "checked";
        if(is_array($b) && in_array($a,$b))
            return "checked";
        return "";
    }
}

if(!function_exists('disable')){
    function disable($a,$b){
        if($a == $b)
            return true;
        if(is_array($b) && in_array($a,$b))
            return true;
        return false;
    }
}

if(!function_exists('str_limit')){
    function str_limit($content, $limit=50){
        return strip_tags(\Illuminate\Support\Str::limit($content, $limit));
    }
}

if(!function_exists('redirect_lang')){
    function redirect_lang($alias = 'HOME'){
        echo '<input type="hidden" class="vue-alias" value="'.$alias.'">';
    }
}

//Scan file
if(!function_exists('scan_full_dir')){
    function scan_full_dir($dir,$child = false){
        $icon = ['/','_'];
        $dir_content_list = scandir($dir);
        foreach($dir_content_list as $k=>$value){
            $path = $dir.$icon[0].$value;
            $arr = ['.','..','Admin','Auth','Console','Events','Commands','Services','Handlers','Exceptions','Providers','Middleware',              'Requests','Kernel.php','route.php','fonts','font','font-awesome',];
            if(in_array($value,$arr))  {continue;}
            $explode = explode('.',$value);
            $replace = str_replace(array('/','.'),array('_',''), $dir);
            $ext = 'php';
            $event = null;
            $pic = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-image.png?1327e17a096bce2f49ad2f66f4abdaf6";
            $folder = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-folder.png?377a0415c8e86b629f04f2de969b6dc7";
            $script = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-webscript.png?b2aff14c14b05cccbb316c37d48fb591";
            $privat = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-private.png?b3e618929415e17caa82f8d04d2aa689";;

            if(in_array('html',$explode) && $child){
                $ext = "html";
                $folder = $script;
                $event = "id='show-file'";
            }
            if(in_array('css',$explode) && $child){
                $ext = "css";
                $folder = $script;
                $event = "id='show-file'";
            }
            if(in_array('scss',$explode) && $child){
                $ext = "css";
                $folder = $script;
                $event = "id='show-file'";
            }
            if(in_array('php',$explode) && $child){
                $ext = "php";
                $folder = $script;
                $event = "id='show-file'";
            }
            if(in_array('js',$explode) && $child){
                $ext = "js";
                $folder = $script;
                $event = "id='show-file'";
            }
            if(in_array('jpg',$explode) && $child){
                $ext = "image";
                $folder = $pic;
            }
            if(in_array('jpeg',$explode) && $child){
                $ext = "image";
                $folder = $pic;
            }
            if(in_array('png',$explode) && $child){
                $ext = "image";
                $folder = $pic;
            }
            if(in_array('svg',$explode) && $child){
                $ext = "image";
                $folder = $pic;
            }
            if(in_array('gif',$explode) && $child){
                $ext = "image";
                $folder = $pic;
            }
            if(in_array('ico',$explode) && $child){
                $ext = "image";
                $folder = $pic;
            }

            if(in_array('htaccess',$explode) && $child){
                $ext = "htaccess";
                $folder = $privat;
            }

            // check if we have file
            if(is_file($path)) {
                echo '<li class="file-name text-primary" '.$event.' data-path="'.$path.'" data-ext="'.$ext.'"><i class="icon-img"><img src="'.$folder.'"></i> '.$value.'</li>';
                continue;
            }
            // check if we have directory
            if (is_dir($path)) {
                if(!$child){
                    echo '<li class="folder-name"><a href="javascript:void(0)" id="open-folder" class="open-folder text-primary" data-path="'.$replace.$icon[1].$value.$icon[1].$k.'"><i class="icon-img"><img src="'.$folder.'"></i> '.$value.'</a>';
                    echo '<ul class="parent-folder" id="'.$replace.$icon[1].$value.$icon[1].$k.'">';
                    scan_full_dir($dir.$icon[0].$value,$value);
                    echo '</ul>';
                    echo '</li>';
                }else{
                    echo '<li class="folder-sub"><a href="javascript:void(0)" id="open-sub-folder" class="open-sub-folder text-primary" data-path="'.$replace.$icon[1].$value.$icon[1].$k.'"><i class="icon-img"><img src="'.$folder.'"></i> '.$value.'</a>';
                    echo '<ul class="parent-folder" id="'.$replace.$icon[1].$value.$icon[1].$k.'">';
                    scan_full_dir($dir.$icon[0].$value,$value);
                    echo '</ul>';
                    echo '</li>';
                }
            }
        }
    }
}

//Menu
if(!function_exists('sub_menu_category_checkbox')){
    function sub_menu_category_checkbox($data,$parent,$tab='<span class="ml-2"></span>'){
        foreach ($data->where('parent_id', $parent) as $key => $value) {

            echo '<label>'.$tab.'<span class="tree-sub"></span><a href="javascript:void(0)" class="addmenu text-secondary" data-type="category" data-id="'.$value->id.'"><span class="text-left"><i class="fe-plus pr-1"></i></span>'.$value->translation->name.'</a></label><br>';
            sub_menu_category_checkbox($data, $value->id,$tab.'<span class="ml-2"></span>');
        }
    }
}

if(!function_exists('menu_update_position')){
    function menu_update_position($menu,$parent_id=0){
        foreach($menu as $key => $items){
            $update = \App\Models\Menu::find($items->id);
            $update->update(['sort' => $key,'parent_id' => $parent_id]);

            if(isset($items->children)){
                menu_update_position($items->children,$items->id);
            }
        }
    }
}

if(!function_exists('admin_menu_sub')){
    function admin_menu_sub($data,$parent_id){

        foreach($data->where('parent_id', $parent_id) as $items){
            $icon = '<i class="fa fa-star" aria-hidden="true"></i>';
            echo '<li class="dd-item" data-id="'.$items->id.'">';
            echo '<div class="dd-handle"><span class="pr-1">'.$icon.'</span> '.$items->translation->name.'</div>';
            echo '<div class="menu_action">';
            echo '<a href="'.route('admin.menus.edit',$items).'" title="Sửa" class="ajax-modal btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            echo '<a href="'.route('admin.menus.destroy',$items).'" title="Xóa" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a> ';
            echo '</div>';

            echo '<ol class="dd-list">';
            admin_menu_sub($data,$items->id);;
            echo '</ol>';
            echo '</li>';
        }
    }
}
