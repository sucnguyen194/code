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
        return $this->hasMany(Translation::class)->whereIn('locale', Language::pluck('value')->toArray());
    }

    public function translation(){
        return $this->hasOne(Translation::class)->whereLocale(session('lang'));
    }

    public function getNameAttribute(){
        if(!$this->translation && $this->translations)
            return $this->translations[0]->name;

        return optional($this->translation)->name;
    }

    public function getSlugAttribute(){
        if(!$this->translation)
            return '#';

        return route('slug', $this->translation->slug);
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
