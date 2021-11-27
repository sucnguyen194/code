<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends Model
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = [];

    public function translations(){
        return $this->hasMany(TagTranslation::class)->whereIn('locale', Language::pluck('value')->toArray());
    }

    public function translation(){
        return $this->hasOne(TagTranslation::class)->whereLocale(session('lang'));
    }

    public function getNameAttribute(){
        return optional($this->translation)->name;
    }

    public function getSlugAttribute(){
        if(!$this->translation)
            return '#';

        return route('tag.show', $this->translation->slug);
    }

    public function getDescriptionAttribute(){
        return optional($this->translation)->description;
    }

    public function getTitleSeoAttribute(){
        return optional($this->translation)->title_seo;
    }

    public function getDescriptionSeoAttribute(){
        return optional($this->translation)->description_seo;
    }

    public function scopeOfType($q, $type){
        return $q->with('translation', function($q){
            $q->select('id','tag_id','name','slug','description','title_seo','description_seo','locale');
        })->whereType($type);
    }

}
