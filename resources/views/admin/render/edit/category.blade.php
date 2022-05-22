<div class="card-box">
    <label>{{__('_category')}} </label>
    <a href="{{route('admin.categories.create',['type' => $type, 'selected' => '.category-main', 'option' => '.category-sub'])}}" class="edit-seo ajax-modal font-weight-medium add-category">{{__('_add_new')}}</a>
    <select class="form-control category-main" data-toggle="select2" name="data[category_id]">
        <option value="0">-----</option>
        @include('admin.render.options', ['options' => $categories, 'selected' => $item->category_id])
    </select>
</div>

<div class="card-box">
    <label>{{__('_sub_category')}}</label>
    <a href="{{route('admin.categories.create',['type' => $type, 'selected' => '.category-sub', 'option' => '.category-main'])}}" class="edit-seo ajax-modal font-weight-medium add-category">{{__('_add_new')}} </a>
    <select class="form-control category-sub select2-multiple" data-toggle="select2" multiple="multiple" name="category_id[]" data-placeholder="-----">
        @include('admin.render.options', ['options' => $categories, 'selected' => $item->categories->pluck('id')->toArray()])
    </select>
</div>

<style>
    @media(max-width: 1366px){
        .add-category span {
            display: none;
        }
    }
</style>
