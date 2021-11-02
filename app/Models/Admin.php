<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

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
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email ?? $this->account)).'.jpg?s=200&d=identicon';
    }
}
