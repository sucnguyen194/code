<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends AppModel
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected $guarded = ['id'];

    public function comment(){
        return $this->morphTo();
    }

    public function getAvatarAttribute(){
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=identicon';
    }

    public function scopeWithCommentLast($q){
        return $q->addSelect([
            'comment_last' => Comment::select('comment')->whereColumn('id', 'comments.id')->latest()->take(1)
        ]);
    }

    public function getRatingAttribute(){
        if(!$this->rate)
            return;

        $max = 5;
        $rate = null;
        for($i = 0; $i < $this->rate; $i++ ){
            $rate .= '<i class="fa fa-star text-warning" aria-hidden="true"></i>';
        }

        for ($i =0 ; $i < $max - $this->rate; $i++){
            $rate .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        }
        return $rate;
    }

    public function scopeWithPostTitle($q){
        return $q->addSelect([
            'post_title' => Translation::select('name')->whereColumn('post_id', 'translations.post_id')->locale()->take(1)
        ]);
    }

    public function scopeWithProductName($q){
        return $q->addSelect([
            'product_name' => Translation::select('name')->whereColumn('product_id', 'translations.product_id')->locale()->take(1)
        ]);
    }
}
