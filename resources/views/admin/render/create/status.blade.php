<label class="font-15 mb-0">{{__('_status')}}</label>
<hr>
<div class="checkbox">
    <input id="checkbox_public" checked type="checkbox" value="{{\App\Enums\ActiveDisable::active}}" name="data[public]">
    <label for="checkbox_public">{{__('lang.display')}}</label>
</div>

<div class="checkbox">
    <input id="checkbox_status" type="checkbox" name="data[status]" value="{{\App\Enums\ActiveDisable::active}}">
    <label for="checkbox_status" class="mb-0">{{__('lang.highlights')}}</label>
</div>
