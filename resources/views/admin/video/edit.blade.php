<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.posts.update',$video)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.video')}} #{{$video->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.edit.nav')

                    <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane  {{$translation->locale == session('lang') ? 'active' : null}} language-{{$translation->locale}}" id="language-{{$translation->locale}}">
                                @include('admin.render.edit.title')
                                <div class="d-none">
                                    @include('admin.render.edit.slug')
                                </div>
                            </div>
                        @endforeach

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane {{$language->value == session('lang') ? 'active' : null}}" id="language-{{$language->value}}">
                                    <div class="tab-pane language-{{$language->value}}" id="language-{{$language->value}}">
                                        @include('admin.render.create.title')
                                        <div class="d-none">
                                            @include('admin.render.create.slug')
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label>{{__('lang.slug')}} {{__('lang.video')}} Youtube <span class="required">*</span></label>
                                <p class="font-13"><code>*</code> {{__('lang.note_url_video')}}</p>
                                <p><img src="{{asset('lib/images/note_upload_video.png')}}" class="w-auto"></p>
                                <input class="form-control" value="https://www.youtube.com/watch?v={{$video->video}}" name="data[video]" required>
                            </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="d-none">
                    @include('admin.render.edit.status', ['item' => $video])
                </div>
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
