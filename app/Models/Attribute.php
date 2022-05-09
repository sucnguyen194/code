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

    public $timestamps = false;

    public function items() {
        return $this->hasMany(ItemAttribute::class)->groupBy('name')->oldest('id');
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

    }
}
