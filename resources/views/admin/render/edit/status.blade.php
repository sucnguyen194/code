<label class="font-15 mb-0">{{__('_status')}}</label>
<hr>
<div class="checkbox">
    <input id="checkbox_public" {{checked($item->public, \App\Enums\ActiveDisable::active)}} type="checkbox" value="{{\App\Enums\ActiveDisable::active}}" name="public">
    <label for="checkbox_public">{{__('lang.display')}}</label>
</div>

<div class="checkbox">
    <input id="checkbox_status" {{checked($item->status, \App\Enums\ActiveDisable::active)}} type="checkbox" value="{{\App\Enums\ActiveDisable::active}}" name="status">
    <label for="checkbox_status" class="mb-0">{{__('lang.highlights')}}</label>
</div>
