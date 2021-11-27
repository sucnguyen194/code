<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Attribute extends Model
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = [];

    public function translations(){
        return $this->hasMany(AttributeTranslation::class)->whereIn('locale', Language::pluck('value')->toArray());;
    }

    public function parents(){
        return $this->hasMany(Attribute::class,'category_id');
    }

    public function translation(){
        return $this->hasOne(AttributeTranslation::class)->whereLocale(session('lang'));
    }

    public function getNameAttribute(){
        return optional($this->translation)->name;
    }

    public function getSlugAttribute(){
        if(!$this->name)
            return;

        $name = $this->name;

        $slug = request()->fullUrl().'?attr='.$name;

        if(request()->attr && !empty(request()->attr))
            $slug = request()->fullUrl().','.$name;

        if(empty(request()->attr) && request()->has('attr'))
            $slug = request()->fullUrl().$name;

        return $slug;
    }

    public function getRemoveSlugAttribute(){
        $slug = Str::replace($this->name, '', request()->attr);

        if(Str::contains(request()->attr ,$this->name.','))
            $slug = Str::replace($this->name.',', '', request()->attr);

        if(Str::contains(request()->attr ,','.$this->name))
            $slug = Str::replace(','.$this->title, '', request()->attr);

        return request()->url().'?attr='.$slug;
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::deleting(function($attribute){
            if($attribute->parents())
                $attribute->parents()->delete();
        });
    }
}
