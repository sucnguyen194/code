@if(setting('site.languages'))
    <ul class="nav nav-tabs tabs-bordered nav-justified bg-white">
        @foreach(languages() as $key => $language)
            <li class="nav-item">
                <a href=".language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$key == 0 ? 'active' : null}}">
                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                    <span class="d-none d-sm-block">{{$language->name}}</span>
                </a>
            </li>
        @endforeach
    </ul>
@endif
