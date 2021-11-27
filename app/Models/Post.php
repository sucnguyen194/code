<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\PostType;
use App\Enums\SystemType;
use App\Enums\TakeItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $casts = [
        'photo' => 'array'
    ];

    public function comments(){
        return $this->morphMany(Comment::class,'comment');
    }

    public function translations(){
        return $this->hasMany(Translation::class)->whereIn('locale', Language::pluck('value')->toArray());
    }

    public function translation(){
        return $this->hasOne(Translation::class)->whereLocale(session('lang'));
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getSlugAttribute(){
        if(!$this->translation)
            return '#';

        return route('slug', optional($this->translation)->slug);
    }

    public function getTitleAttribute(){

        return optional($this->translation)->name;
    }

    public function getDescriptionAttribute(){
        return optional($this->translation)->description;
    }

    public function getContentAttribute(){
        return optional($this->translation)->content;
    }

    public function getRouteAttribute(){
        if($this->type == PostType::page)
            return route('admin.posts.pages.index');
        if($this->type == PostType::post)
            return route('admin.posts.pages.index');

        return ;
    }

    public function scopeOfCategory($q, $category){
        return $q->whereCategoryId($category)->orWhere(function($q) use ($category){
           $q->whereHas('categories',function($q) use ($category){
              $q->whereCategoryId($category);
           });
        });
    }

    public function scopeOfType($q, $type){
        return $q->whereType($type)->with('translation')->whereHas('translation')->public();
    }

    public function scopeOfTake($q, $take){
        if($take == TakeItem::index)
            return $q->take(setting('site.post.index'));
        if($take == TakeItem::category)
            return $q->take(setting('site.post.category'));
        if($take == TakeItem::replated)
            return $q->take(setting('site.post.related'));

        return $q->take(6);
    }

    public function scopeSort($q){
        return $q->oldest('sort')->latest();
    }

    public function scopePublic($q){
        return $q->wherePublic(ActiveDisable::active);
    }

    public function scopeStatus($q){
        return $q->whereStatus(ActiveDisable::active);
    }

    public function getThumbAttribute(){

        return resize_image($this->image, setting('site.post.size'));
    }

    public static function boot(){
        parent::boot();

        static::saving(function($post){
            $post->admin_id = $post->admin_id ?? Auth::id();
        });

        static::saved(function($post){
            $post->tags()->sync(request()->tag);
        });

        static::deleting(function($post){
           $post->comments()->delete();
        });
    }
}
