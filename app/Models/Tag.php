<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends AppModel
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $with = ['translation'];

    public function translations(){
        return $this->hasMany(TagTranslation::class)->where(function($q){
            $q->whereIn('locale', Language::pluck('value')->toArray());
        });
    }

    public function translation(){
        return $this->hasOne(TagTranslation::class)->withDefault(function ($translation){
            $translation->locale = session('lang');
        });
    }

    public function scopeOfType($q, $type){
        return $q->whereType($type);
    }
}
