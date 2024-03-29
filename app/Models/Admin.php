<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Yadahan\AuthenticationLog\AuthenticationLogable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable,AuthenticationLogable, HasRoles, LogsActivity, SoftDeletes;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

//    protected $table = 'admins';
//
//    protected $guarded = 'admin';
//
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getGravatarAttribute(){
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=identicon';
    }

    public static function boot(){
        parent::boot();

        static::deleting(function($admin){
            $admin->email = $admin->email.'.'.now();
        });
    }
}
