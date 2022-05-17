<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SocialIdentity extends AppModel
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $table = 'social_identities';

    protected $fillable = [
        'user_id',
        'provider_name',
        'provider_id',
    ];
}
