@if(setting('site.languages'))
    <ul class="nav nav-tabs tabs-bordered nav-justified bg-white">
        @foreach($translations as $key => $translation)
            <li class="nav-item">
                <a href=".language-{{$translation->locale}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$translation->locale == session('lang') ? 'active' : null}}">
                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                    <span class="d-none d-sm-block">{{optional($translation->language)->name}}</span>
                </a>
            </li>
        @endforeach

        @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
            <li class="nav-item">
                <a href="#language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$language->value == session('lang') ? 'active' : null}}">
                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                    <span class="d-none d-sm-block">{{$language->name}}</span>
                </a>
            </li>
        @endforeach
    </ul>
@endif
