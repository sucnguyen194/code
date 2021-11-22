<?php namespace App\Http\Controllers;

use App\Enums\ActiveDisable;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Support\Facades\App;

class AjaxController extends Controller {

    public function create($id, $qty = 1, $options = null){
        $product = Product::findOrFail($id);
        $weight = $request->weight ?? 0;
        $slug = route('alias',$product->alias);
        $image = asset($product->image);
        $price = $product->price_sale > 0 ? $product->price_sale : $product->price;
        $price_old = $product->price_sale > 0 ? $product->price : $product->price_sale;

        $options = is_null($options) || $options == "null" ? null : $options;

        Cart::add([
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=> $price,
            'weight'=> $weight,
            'qty'=>$qty,
            'options'=>[
                'price_old' => $price_old,
                'image'=> $image,
                'slug'=> $slug,
                'category_id'=> optional($product->category->id),
                'category_name'=> optional($product->category->name),
                'attributes' => $options
            ]
        ]);

        $data['carts'] = Cart::content();
        $data['count'] = Cart::content()->count();
        $data['total'] = Cart::subtotal(0);
        $data['product'] = $product;

        return response()->json($data);
    }

    public function update($rowId,$num){
        Cart::update($rowId,$num);
        $data['carts'] = Cart::content();
        $data['count'] = Cart::content()->count();
        $data['total'] = Cart::subtotal(0);
        return response()->json($data);
    }
    public function remove($rowId){
        Cart::remove($rowId);
        $data['carts'] = Cart::content();
        $data['count'] = Cart::content()->count();
        $data['total'] = Cart::subtotal(0);
        return response()->json($data);
    }
    public function destroy(){
        Cart::destroy();
        $data['count'] = 0;
        $data['total'] = 0;
        return response()->json($data);
    }

    public function change($lang){
        $language = Language::whereValue($lang)->first();
            if(!$language)
                return flash('Đã có lỗi xảy ra', 0);

        $languages = Language::whereNotIn('value',[$lang])->get();
        foreach ($languages as $item){
            $item->update(['status' => ActiveDisable::disable]);
        }
        $language->update(['status' => ActiveDisable::active]);
        session()->put('lang',$lang);

        return redirect()->back()->withInput();
    }
}
