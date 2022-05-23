<?php

namespace App\Models;

use App\Enums\PostType;
use App\Enums\TakeItem;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends AppModel
{
    use LogsActivity, SoftDeletes;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $casts = [
        'photo' => 'array'
    ];

    protected $with = ['comments','tags','translation'];

    protected $withCount = ['comments','tags'];

    public function getRouteAttribute(){
        if($this->type == PostType::page)
            return route('admin.posts.pages.index');
        if($this->type == PostType::post)
            return route('admin.posts.index');
        if($this->type == PostType::recruitment)
            return route('admin.recruitments.index');

        return ;
    }

    public function getViewsAttribute(){

        if($this->type == PostType::page)
            return 'post.page';
        if($this->type == PostType::post)
            return 'post.show';
        if($this->type == PostType::video)
            return 'post.video.show';
        if($this->type == PostType::gallery)
            return 'post.gallery.show';
        if($this->type == PostType::recruitment)
            return 'post.recruitment.show';

        return abort(404);
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
           $post->translations()->update(['deleted_at' => now()]);
        });
    }
}
