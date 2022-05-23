<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\TakeItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends AppModel
{
    use LogsActivity, SoftDeletes;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = ['id'];

    protected $with = ['comments','tags','translation'];

    protected $casts = [
        'options' => 'array',
        'photo' => 'array'
    ];

    public function attributes(){
        return $this->hasMany(Attribute::class);
    }

    public function filters(){
        return $this->belongsToMany(Filter::class);
    }

    public function getPriceAttribute(){

        $price = 0.00;

        if($this->options)
            $price = $this->options[0]['price'];

        return $price;
    }

    public function getImageAttribute(){
        $image = null;
        if($this->photo)
            $image = $this->photo[0];
        return $image;
    }

    public function getThumbAttribute(){
        return resize_image($this->image, setting('site.product.size'));
    }

    public function getPercentAttribute(){
        if($this->price == 0) return;

        $percent = ($this->price_sale - $this->price) / $this->price * 100;

        return round($percent,2);
    }

    public function scopeOfTake($q, $take = null){
        if($take == TakeItem::index)
            return $q->take(setting('site.product.index'));
        if($take == TakeItem::category)
            return $q->take(setting('site.product.category'));
        if($take == TakeItem::replated)
            return $q->take(setting('site.product.related'));

        return $q->take(6);
    }

    public function scopeOfTranslation($q){
        return $q->public()->sort();
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::saving(function($product){
            $product->admin_id = $product->admin_id ?? Auth::id();
        });

        static::saved(function($product){
            $product->tags()->sync(request()->tag);
        });

        static::deleting(function($product){
            $product->comments()->delete();
            $product->translations()->update(['deleted_at' => now()]);
        });
    }

}
