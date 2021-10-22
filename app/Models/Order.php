<?php

namespace App\Models;

use App\Enums\ProductSessionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    protected $guarded = ['id'];

    protected $table = 'orders';

    protected $casts = [
        'content' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAmountAttribute(){

        $amount = 0;
        foreach (json_decode($this->content) as $item){
            $amount += $item->qty;
        }
        return $amount;
    }
}
