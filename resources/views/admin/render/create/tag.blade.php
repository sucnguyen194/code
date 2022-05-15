@can('tag.view')
<div class="card-box">
    <label>{{__('_tag')}}</label>
    <a href="{{route('admin.tags.add',['type' => $type, 'selected' => '.select-tag'])}}"
       class="edit-seo ajax-modal font-weight-medium">{{__('_add_new')}}</a>
    <select class="form-control select-tag select2-multiple" data-toggle="select2" multiple="multiple" name="tag[]"
            data-placeholder="add tags">
        @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
    </select>
</div>
@endcan
