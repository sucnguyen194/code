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
        return $this->hasMany(Translation::class);
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
        $q->oldest('sort')->oldest();
    }

    public function scopeTop($q){
        $q->wherePosition('top')->oldest('sort');
    }

    public function scopeBottom($q){
        $q->wherePosition('bottom')->oldest('sort');
    }

    public function scopeLeft($q){
        $q->wherePosition('left')->oldest('sort');
    }

    public function scopeHome($q){
        $q->wherePosition('home')->oldest('sort');
    }

    public function scopeRight($q){
        $q->wherePosition('right')->oldest('sort');
    }

    public function getSlugAttribute(){
        $menu = $this->withTranslation();

        if($menu->path)
            return $menu->path;
        if($menu->translation->slug)
            return route('slug',$menu->translation->slug);

        return route('home');
    }

    public static function boot(){
        parent::boot();

        self::deleting(function($menu){
            if($menu->parents())
                $menu->parents()->update(['parent_id' => 0]);

        });
    }
}
