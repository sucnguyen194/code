<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\TakeItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function translations(){
        return $this->hasMany(Translation::class)->where(function($q){
            $q->whereIn('locale', Language::pluck('value')->toArray());
        });
    }

    public function translation(){
        return $this->hasOne(Translation::class)->withDefault(function ($translation){
            $translation->locale = session('lang');
        });
    }

    public function comments(){
        return $this->morphMany(Comment::class,'comment');
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

    public function getTitleAttribute(){

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

    public function getContentAttribute(){
        return optional($this->translation)->content;
    }

    public function getTitleSeoAttribute(){
        return optional($this->translation)->title_seo;
    }

    public function getDescriptionSeoAttribute(){
        return optional($this->translation)->description_seo;
    }

    public function scopeOfCategory($q, $category){
        return $q->whereCategoryId($category)->orWhere(function($q) use ($category){
            $q->whereHas('categories',function($q) use ($category){
                $q->whereCategoryId($category);
            });
        });
    }

    public function scopeOfType($q, $type){
        return $q->whereType($type)->public()->sort();
    }
}
