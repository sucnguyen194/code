<?php

use App\Models\Setting;
use Illuminate\Support\Str;

if (!function_exists('show_item')) {
    function showing_item($default = 0, $max = 0)
    {

        if ($max === 0)
            return '0 of 0';

        $from = 1;

        $paginate = request('page');

        if ($paginate && $paginate > 1)
            $from = $default * $paginate;

        if ($max < $from) {
            $from = $max;
        }

        return $from . ' of ' . $max;

    }
}

if (!function_exists('languages')) {
    function languages()
    {
        return session('languages');
    }
}

if (!function_exists('resize_image')) {
    function resize_image($image, $size = 'm')
    {
        $check = strpos($image, 'i.imgur.com');
        if ($check == false)
            return $image;

        $jpg = strpos($image, '.jpg');
        if ($jpg == true)
            return str_replace('.jpg', $size . '.jpg', $image);

        $png = strpos($image, '.png');
        if ($png == true)
            return str_replace('.png', $size . '.png', $image);

        $gif = strpos($image, '.gif');
        if ($gif == true)
            return str_replace('.gif', $size . '.gif', $image);

        $webp = strpos($image, '.webp');
        if ($webp == true)
            return str_replace('.webp', $size . '.webp', $image);

        return $image;
    }
}

if (!function_exists('user_avatar')) {
    function user_avatar($name)
    {
        $str_after = Str::afterLast($name, ' ');
        $str_before = Str::afterLast(Str::replaceLast(' ', '', Str::beforeLast($name, $str_after)), ' ');
        $avatar = Str::substr($str_before, 0, 1) . Str::substr($str_after, 0, 1);
        return Str::upper($avatar);
    }
}

if (!function_exists('setting')) {

    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return new Setting();
        }

        if (is_array($key)) {
            return Setting::set($key[0], $key[1]);
        }

        if(Setting::has($key.'.'.session('lang')))
            $key = $key.'.'.session('lang');

        $value = Setting::get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (!function_exists('menu_active')) {

    function menu_active($slug, $class = 'active')
    {
        if ($slug === request()->url() || $slug === request()->path())
            return $class;

        return false;
    }
}

if (!function_exists('nav_active')) {

    function nav_active($segment, $class = 'active')
    {
        return request()->is($segment) ? $class : '';
    }
}

if (!function_exists('date_range')) {

    function date_range($format_in = 'd/m/Y')
    {
        if (!request()->date)
            return null;

        $parts = explode('-', str_replace(' ', '', request()->date));
        if (!$parts) {
            return null;
        }

        $range['from'] = \Carbon\Carbon::createFromFormat($format_in, $parts[0]);
        $range['to'] = \Carbon\Carbon::createFromFormat($format_in, $parts[1]);
        return $range;
    }
}

if (!function_exists('flash')) {

    function flash($message = null, $type = 1, $url = null, $target = '_self')
    {
        $types = [
            0 => 'error',
            1 => 'success',
            2 => 'info',
            3 => 'warning',
        ];
        $m['type'] = $types[$type];
        $m['message'] = $message;
        $m['url'] = $url;
        $m['target'] = $target;

        session()->flash('message', $m);

        if (request()->ajax()) {
            session()->forget('message');
            return response()->json($m);
        }

        if ($url)
            return redirect($url);

        return back()->withInput();
    }
}

if (!function_exists('selected')) {
    function selected($a, $b)
    {
        if ($a == $b)
            return "selected";
        if (is_array($b) && in_array($a, $b))
            return "selected";
        return "";
    }
}

if (!function_exists('checked')) {
    function checked($a, $b)
    {
        if ($a == $b)
            return "checked";
        if (is_array($b) && in_array($a, $b))
            return "checked";
        return "";
    }
}

if (!function_exists('disable')) {
    function disable($a, $b)
    {
        if ($a == $b)
            return true;
        if (is_array($b) && in_array($a, $b))
            return true;
        return false;
    }
}

if (!function_exists('str_limit')) {
    function str_limit($content, $limit = 30)
    {
        return \Illuminate\Support\Str::words(strip_tags($content), $limit);
    }
}

//Scan file
if (!function_exists('scan_full_dir')) {
    function scan_full_dir($dir, $child = false)
    {
        $icon = ['/', '_'];
        $dir_content_list = scandir($dir);
        foreach ($dir_content_list as $k => $value) {
            $path = $dir . $icon[0] . $value;
            $arr = ['.', '..', 'Admin', 'Auth', 'Console', 'Events', 'Commands', 'Services', 'Handlers', 'Exceptions', 'Providers', 'Middleware', 'Requests', 'Kernel.php', 'route.php', 'fonts', 'font', 'font-awesome', 'index.php', 'web.config', '.htaccess'];
            if (in_array($value, $arr)) {
                continue;
            }
            $explode = Str::after($value, '.');
            $replace = Str::replace(array('/', '.'), array('_', ''), $dir);
            $ext = 'php';
            $event = null;
            $pic = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-image.png?1327e17a096bce2f49ad2f66f4abdaf6";
            $folder = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-folder.png?377a0415c8e86b629f04f2de969b6dc7";
            $script = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-webscript.png?b2aff14c14b05cccbb316c37d48fb591";
            $privat = "https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-private.png?b3e618929415e17caa82f8d04d2aa689";;

            if (Str::contains($value, '.html')) {
                $ext = "html";
                $folder = $script;
                $event = "id='show-file'";
            }
            if (Str::contains($value, '.css')) {
                $ext = "css";
                $folder = $script;
                $event = "id='show-file'";
            }
            if (Str::contains($value, '.css')) {
                $ext = "css";
                $folder = $script;
                $event = "id='show-file'";
            }
            if (Str::contains($value, '.php')) {
                $ext = "php";
                $folder = $script;
                $event = "id='show-file'";
            }
            if (Str::contains($value, '.js')) {
                $ext = "js";
                $folder = $script;
                $event = "id='show-file'";
            }
            if (Str::contains($value, '.jpg')) {
                $ext = "image";
                $folder = $pic;
            }
            if (Str::contains($value, '.jpeg')) {
                $ext = "image";
                $folder = $pic;
            }
            if (Str::contains($value, '.png')) {
                $ext = "image";
                $folder = $pic;
            }
            if (Str::contains($value, '.svg')) {
                $ext = "image";
                $folder = $pic;
            }
            if (Str::contains($value, '.gif')) {
                $ext = "image";
                $folder = $pic;
            }
            if (Str::contains($value, '.ico')) {
                $ext = "image";
                $folder = $pic;
            }


            // check if we have file
            if (is_file($path)) {
                echo '<li class="file-name text-primary" ' . $event . ' data-path="' . $path . '" data-ext="' . $ext . '"><i class="icon-img"><img src="' . $folder . '"></i> ' . $value . '</li>';
                continue;
            }
            // check if we have directory
            if (is_dir($path)) {
                if (!$child) {
                    echo '<li class="folder-name"><a href="javascript:void(0)" id="open-folder" class="open-folder text-primary" data-path="' . $replace . $icon[1] . $value . $icon[1] . $k . '"><i class="icon-img"><img src="' . $folder . '"></i> ' . $value . '</a>';
                    echo '<ul class="parent-folder" id="' . $replace . $icon[1] . $value . $icon[1] . $k . '">';
                    scan_full_dir($dir . $icon[0] . $value, $value);
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li class="folder-sub"><a href="javascript:void(0)" id="open-sub-folder" class="open-sub-folder text-primary" data-path="' . $replace . $icon[1] . $value . $icon[1] . $k . '"><i class="icon-img"><img src="' . $folder . '"></i> ' . $value . '</a>';
                    echo '<ul class="parent-folder" id="' . $replace . $icon[1] . $value . $icon[1] . $k . '">';
                    scan_full_dir($dir . $icon[0] . $value, $value);
                    echo '</ul>';
                    echo '</li>';
                }
            }
        }
    }
}
