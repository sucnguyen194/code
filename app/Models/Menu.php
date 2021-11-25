<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = ['id'];

    public function translations(){
        return $this->hasMany(Translation::class)->whereIn('locale', Language::pluck('value')->toArray());;
    }

    public function translation(){
        return $this->hasOne(Translation::class)->whereLocale(session('lang'));
    }

    public function parents(){
        return $this->hasMany(Menu::class,'parent_id');
    }
    public function scopePosition($q){
        $q->wherePosition(session()->get('menu_position'));
    }

    public function scopeSort($q){
        $q->oldest('sort');
    }

    public function scopeOfPosition($q, $position){
        return $q->with('translation')->whereHas('translation')->wherePosition($position)->sort();
    }

    public function getSlugAttribute(){
        $menu = $this->translation;

        if($this->path)
            return $this->path;
        if($menu->slug)
            return route('slug',$menu->slug);

        return route('home');
    }

    public function getNameAttribute(){
        return optional($this->translation)->name;
    }

    public static function boot(){
        parent::boot();

        self::deleting(function($menu){
            if($menu->parents())
                $menu->parents()->update(['parent_id' => 0]);

        });
    }
}
