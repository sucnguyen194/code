<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\AliasType;
use App\Enums\SystemType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
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

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function parents(){
        return $this->hasMany(Category::class,'parent_id');
    }

    public function scopePublic($q) {
        $q->wherePublic(ActiveDisable::active);
    }

    public function scopeStatus($q) {
        $q->whereStatus(ActiveDisable::active);
    }

    public static function boot(){

        parent::boot();

        static::saving(function($category){
            $category->admin_id = $category->admin_id ? $category->admin_id : auth()->id();
        });

        static::deleting(function($category){

            if($category->parents())
                $category->parents()->update(['parent_id' => 0]);

            if($category->products())
                $category->products()->update(['category_id' => 0]);

        });
    }
}
