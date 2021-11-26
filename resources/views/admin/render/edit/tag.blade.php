<label>{{__('lang.tag')}}</label>
<a href="{{route('admin.tags.add',['type' => $type, 'selected' => '.select-tag'])}}" class="edit-seo ajax-modal font-weight-medium">{{__('lang.create')}} <span class="text-lowercase">{{__('lang.tag')}}</span></a>
<p class="font-13"><code>*</code> {{__('lang.select_multiple')}} {{__('lang.tag')}}</p>
<select class="form-control select-tag select2-multiple" data-toggle="select2" multiple="multiple" name="tag[]" data-placeholder="add tags">
    @foreach($tags as $tag)
        @if($item->translation)
            <option value="{{$tag->id}}" {{selected($tag->id, optional($item->translation->tags->pluck('id'))->toArray())}}>{{$tag->name}}</option>
        @else
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endif
    @endforeach
</select>