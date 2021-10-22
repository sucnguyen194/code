<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
   protected $guarded = ['id'];

    public function getTypeAttribute(){

        $type = array();
        foreach(json_decode($this->fields) as $item){
            $type[] = $item->display_type;
        }
        if(in_array('1', $type) || in_array('3', $type) || in_array('4', $type) || in_array('4', $type)){
            return true;
        }
        return false;
    }
}
