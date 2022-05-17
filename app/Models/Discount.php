<?php

namespace App\Models;

use App\Enums\Activation;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class Discount extends AppModel
{
    use HasFactory, CastsEnums, SoftDeletes, LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    //   protected static $logAttributes = ['*'];
    //   protected static $logAttributesToIgnore = [ 'text'];

    protected $guarded = [];
    protected $casts = [
        'status' => Activation::class,
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class, 'voucher', 'code');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'voucher', 'code');
    }

}
