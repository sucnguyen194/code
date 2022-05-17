<?php namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getAllAdmins(){
        $admins = Admin::query()->when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        });

        return $admins;
    }
}
