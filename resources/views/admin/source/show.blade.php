@foreach(scandir($dir) as $key => $value)

    @php($path = $dir . $icon[0] . $value)

    @php($arr = ['.', '..', 'Admin', 'Auth', 'Console', 'Events', 'Commands', 'Services', 'Handlers', 'Exceptions', 'Providers', 'Middleware', 'Requests', 'Kernel.php', 'route.php', 'fonts', 'font', 'font-awesome', 'index.php', 'web.config', '.htaccess','txt'])

    @if(in_array($value, $arr) || \Illuminate\Support\Str::contains($value, ['.txt', '.docx']))
        @continue;
    @endif

    @php($replace = Str::replace(array('/', '.'), array('_', ''), $dir))

    @php( $ext = 'php')

    @php($event = null)

    @php($folder = "/lib/images/file-folder.png")
{{--    @php($privat = "/assets/images/file-private.png")--}}

    @if(\Illuminate\Support\Str::contains($value,  ['.html','.css','.php','.js']))
    @php($ext = 'html')
    @php($folder = '/lib/images/file-webscript.png')
    @php($event = "id=show-file")
    @endif

    @if(\Illuminate\Support\Str::contains($value, ['.jpg', '.jpeg','.png','.svg','.gif','.ico']))
    @php($ext = 'image')
    @php($folder = '/lib/images/file-image.png')
    @endif

    @if(is_file($path))
        <li class="file-name text-primary" {{$event}} data-path="{{$path}}" data-ext="{{$ext}}"><i class="icon-img"><img src="{{$folder}}"></i> {{$value}}</li>
       @continue;

    @endif

    @if(is_dir($path))
        <li class="{{$child ? 'folder-name' : 'folder-sub'}}"><a href="javascript:void(0)" id="open-folder" class="{{$child ? 'open-folder' : 'open-sub-folder'}} text-primary" data-path="{{$replace.$icon[1].$value.$icon[1].$key}}"><i class="icon-img"><img src="{{$folder}}"></i> {{$value}}</a>
            <ul class="parent-folder" id="{{$replace.$icon[1].$value.$icon[1].$key}}">
                @include('admin.source.show',['dir' => $dir.$icon[0].$value, 'child' => $value])
            </ul>
        </li>
    @endif

@endforeach
