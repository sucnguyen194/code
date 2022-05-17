<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends AppModel
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $with = ['translation','translations'];

    public function translations(){
        return $this->hasMany(MenuTranslation::class)->whereIn('locale', Language::pluck('value')->toArray());;
    }

    public function translation(){
        return $this->hasOne(MenuTranslation::class)->whereLocale(session('lang'));
    }

    public function parents(){
        return $this->hasMany(Menu::class,'parent_id');
    }
    public function scopePosition($q){
        $q->wherePosition(session('menu_position'));
    }

    public function scopeOfPosition($q, $position){
        return $q->with('parents')->whereParentId(0)->wherePosition($position)->sort();
    }

    public function getSlugAttribute(){
        if($this->path)
            return $this->path;

        if(!$this->translation)
            return '#';

        if(!$this->translation->slug)
            return '#';

        return route('slug', optional($this->translation)->slug);
    }

    public static function boot(){
        parent::boot();

        self::deleting(function($menu){
            if($menu->parents())
                $menu->parents()->update(['parent_id' => 0]);
        });
    }
}
