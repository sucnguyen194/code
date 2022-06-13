<?php namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Enums\CategoryType;
use App\Enums\FilterType;
use App\Enums\PhotoType;
use App\Enums\PostType;
use App\Enums\SupportType;
use App\Enums\TagType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use App\Models\Support;

class AjaxController extends Controller {

    public function getModule($type){
        switch ($type){
            case TagType::product:
                $data = Product::find(request()->id);
                break;
            case CategoryType::category:
                $data = Category::find(request()->id);
                break;
            case PostType::post:
                $data = Post::find(request()->id);
                break;
            case SupportType::support:
                $data = Support::find(request()->id);
                break;
            case PhotoType::photo:
                $data = Photo::find(request()->id);
                break;

            case FilterType::filter:
                $data = Filter::find(request()->id);
                break;
            default;
        }
        return $data;
    }
    public function updateSort(){
        $data = $this->getModule(request()->type);
        $data->update(['sort' => request()->num]);
        return $data;
    }
    public function updateStatus(){
        $data = $this->getModule(request()->type);
        $status = $data->status == ActiveDisable::active ? ActiveDisable::disable :  ActiveDisable::active;
        $data->update(['status' => $status]);
        return $data;
    }
    public function updatePublic(){
        $data = $this->getModule(request()->type);
        $public = $data->public == ActiveDisable::active ? ActiveDisable::disable :  ActiveDisable::active;
        $data->update(['public' => $public]);
        return $data;
    }
}
