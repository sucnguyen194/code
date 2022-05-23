<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\AliasType;
use App\Enums\CategoryType;
use App\Enums\PostType;
use App\Enums\SystemType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends AppModel
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = ['id'];

    protected $with = ['translation'];

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
