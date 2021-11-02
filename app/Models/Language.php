<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Language extends Model
{
    use HasFactory, LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = ['id'];

    public function scopeLocale($q){
        return $q->whereLanguage(config('locale'));
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($language){

        });

        static::deleting(function($language){
            if($language->status == 1){
                $language = Language::whereStatus(0)->update(['status' => 1]);
                session()->put('lang', $language->value);
            }
        });
    }
}
