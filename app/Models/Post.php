<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\PostType;
use App\Enums\SystemType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tags' => 'array'
    ];

    public function comments(){
        return $this->morphMany(Comment::class,'comment');
    }

    public function translations(){
        return $this->hasMany(Translation::class);
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

    public function scopeWithTranslation($q){
        $q->with('translation', function ($q){
            $q->locale();
        });
    }

    public function getSlugAttribute(){
        return route('slug', $this->translation->slug);
    }

    public function getRouteAttribute(){
        switch ($this->type){
            case PostType::page:
                return route('admin.posts.pages.index');
                break;
            case PostType::post:
                return route('admin.posts.index');
        }
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

        static::deleting(function($post){
           $post->comments()->delete();
        });
    }
}
