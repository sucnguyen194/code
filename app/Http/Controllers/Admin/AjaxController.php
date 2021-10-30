<?php namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Enums\AttributeType;
use App\Enums\CategoryType;
use App\Enums\PhotoType;
use App\Enums\PostType;
use App\Enums\ProductType;
use App\Enums\SupportType;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller {

    public function getSystem($type){
        switch ($type){
            case ProductType::product:
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

            case AttributeType::attribute:
                $data = Attribute::find(request()->id);
                break;

            default;
        }
        return $data;
    }
    public function getEditDataSort(){
        $data = $this->getSystem(request()->type);
        $data->update(['sort' => request()->num]);
        return $data;
    }
    public function getEditDataStatus(){
        $data = $this->getSystem(request()->type);
        $status = $data->status == ActiveDisable::active ? ActiveDisable::disable :  ActiveDisable::active;
        $data->update(['status' => $status]);
        return $data;
    }
    public function getEditDataPublic(){
        $data = $this->getSystem(request()->type);
        $public = $data->public == ActiveDisable::active ? ActiveDisable::disable :  ActiveDisable::active;
        $data->update(['public' => $public]);
        return $data;
    }
}
