<?php

namespace App\Models;

use App\Enums\ActiveDisable;
use App\Enums\SystemType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Support extends AppModel
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $with = ['translation'];

    public function translations(){
        return $this->hasMany(SupportTranslation::class)->where(function($q){
            $q->whereIn('locale', Language::pluck('value')->toArray());
        });
    }

    public function translation(){
        return $this->hasOne(SupportTranslation::class)->withDefault(function ($translation){
            $translation->locale = session('lang');
        });
    }

    public function getRouteAttribute(){
        switch ($this->type){
            case SystemType::CUSTOMER:
                return route('admin.supports.customers.index');
                break;
            case SystemType::SUPPORT:
                return route('admin.supports.index');
                break;
        }
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::saving(function($support){
            $support->admin_id = $support->admin_id ? $support->admin_id : auth()->id();
        });
    }
}
