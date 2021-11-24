<div class="card-box">
    <label>{{__('lang.category')}} {{__('lang.main')}}</label>
    <select class="form-control" data-toggle="select2" name="data[category_id]">
        <option value="0">-----</option>
        @include('admin.render.options', ['options' => $categories, 'selected' => $item->category_id])
    </select>
</div>
<div class="card-box">
    <label>{{__('lang.category')}} {{__('lang.sub')}}</label>
    <p class="font-13"><code>*</code> {{__('lang.select_multiple')}} <span class="text-lowercase">{{__('lang.category')}}</span></p>
    <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" name="category_id[]" data-placeholder="-----">
        @include('admin.render.options', ['options' => $categories, 'selected' => $item->categories->pluck('id')->toArray()])
    </select>
</div>
