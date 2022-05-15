<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.posts.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_add_new')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              @include('admin.render.create.nav')

                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    @foreach(languages() as $key => $language)
                        <div class="tab-pane {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                            @include('admin.render.create.title')
                            <div class="d-none">
                                @include('admin.render.create.slug')
                            </div>
                        </div>
                    @endforeach
                </div>
                    <div class="form-group">
                        <label>{{__('_slug')}} {{__('_video')}} Youtube <span class="required">*</span></label>
                        <p class="font-13"><code>*</code> {{__('_note_video')}}</p>
                        <p><img src="{{asset('lib/images/note_upload_video.png')}}" class="w-auto"></p>
                        <input class="form-control" value="" name="data[video]" required>

                    </div>
                    <input name="data[type]" type="hidden" value="{{\App\Enums\PostType::video}}">
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
