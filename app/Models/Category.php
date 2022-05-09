<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\AliasType;
use App\Enums\PostType;
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

    protected $with = ['translation'];

    public function translations(){
        return $this->hasMany(Translation::class)->whereIn('locale', Language::pluck('value')->toArray());
    }

    public function translation(){
        return $this->hasOne(Translation::class,'category_id')->where('locale',session()->get('lang'));
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

    public function scopeOfType($q, $type){
        return $q->whereType($type)->public()->sort();
    }

    public function scopeSort($q){
        return $q->oldest('sort')->latest();
    }

    public function scopePublic($q) {
        $q->wherePublic(ActiveDisable::active);
    }

    public function scopeStatus($q) {
        $q->whereStatus(ActiveDisable::active);
    }
    public function getNameAttribute(){
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

    public function getThumbAttribute(){

        return resize_image($this->image);
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
