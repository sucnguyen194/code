<div class="card-box">
    <div class="form-group select-category mb-0">
        <label>{{__('_category')}}</label>
        <a href="{{route('admin.categories.create',['type' => $type, 'selected' => '.category-main', 'option' => '.category-sub'])}}" class="edit-seo ajax-modal font-weight-medium add-category">{{__('_add_new')}}</a>
        <select class="form-control category-main" data-toggle="select2" name="data[category_id]">
            <option value="0">-----</option>
            @include('admin.render.options', ['options' => $categories, 'selected' => 0])
        </select>
    </div>
</div>

<div class="card-box">
    <div class="form-group mb-0">
        <label>{{__('_sub_category')}} </label>
        <a href="{{route('admin.categories.create',['type' => $type, 'selected' => '.category-sub', 'option' => '.category-main'])}}" class="edit-seo ajax-modal font-weight-medium add-category">{{__('_add_new')}}</a>

        <select class="form-control category-sub select2-multiple" data-toggle="select2" multiple="multiple" name="category_id[]" data-placeholder="-----">
            @include('admin.render.options', ['options' => $categories, 'selected' => 0])
        </select>
    </div>
</div>

