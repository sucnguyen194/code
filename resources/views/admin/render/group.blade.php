<div class="form-group">
    <label>{{__('_group')}}</label>
    <select class="form-control" data-toggle="select2" name="data[parent_id]">
        <option value="0">-----</option>
        @include('admin.render.options',['options' => $categories, 'selected' => $selected ?? 0])
    </select>
</div>
