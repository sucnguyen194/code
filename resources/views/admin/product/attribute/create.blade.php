<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.attributes.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.create')}} {{\Illuminate\Support\Str::lower(__('lang.filter'))}}</h5>
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
                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                            </div>
                        @endforeach
                    </div>

                <div class="form-group d-none">
                    <label>{{__('lang.value')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" value="{{old('data.value') ?? 0}}" id="value" name="data[value]" required>
                </div>

                <div class="form-group">
                    <label>{{__('lang.group')}}</label>
                    <select class="form-control" data-toggle="select2" name="data[category_id]">
                        <option value="0">-----</option>
                        @foreach($categories as $item )
                            <option value="{{$item->id}}" class="font-weight-bold">{{$item->translation->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });
    })

</script>
