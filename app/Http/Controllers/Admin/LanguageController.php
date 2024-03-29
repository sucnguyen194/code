<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('setting.language');

        return view('admin.language.index');
    }

    /**
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function data()
    {
        $this->authorize('setting.language');
        $langs = Language::query()->when(\request()->search, function ($q, $search) {
            return $q->whereLie('name', 'like', "%{$search}%")->orWhere('id', $search);
        });

        return datatables()->of($langs)
            ->order(function ($q) {
                $q->orderby(\request()->input('sort', 'created_at'), \request()->input('order', 'desc'));
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('setting.language');

        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('setting.language');

        $request->validate([
            'name' => 'required|string|unique:languages',
            'value' => 'required|string|max:2|unique:languages',
        ]);

        $json_file = strtolower($request->value) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, '[]');

        Language::create([
            'name' => $request->name,
            'value' => $request->value,
            'image' => $request->image,
        ]);
        return flash(__('_the_record_is_added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $this->authorize('setting.language');

        return view('admin.language.edit', compact( 'language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $this->authorize('setting.language');

        $request->validate([
            'name' => 'required|string|unique:languages,name,' . $language->id,
        ]);
        $language->update([
            'name' => $request->name,
            'image' => $request->image
        ]);
        return flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $this->authorize('setting.language');

        if (Language::count() == 1)
            return flash(__('_error'), 3);

        $path = resource_path('lang/') . $language->value . '.json';

        file_exists($path) && is_file($path) ? @unlink($path) : false;

        $language->delete();

        return flash(__('_the_record_is_updated_successfully'));

    }

    /**
     * @param $lang
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function change($lang)
    {
        $this->authorize('setting.language');
        $language = Language::whereValue($lang)->first();

        if (!$language)
            return flash(__('_error'), 0);

        Language::query()->update(['status' => ActiveDisable::disable]);

        $language->update(['status' => ActiveDisable::active]);

        session()->put('lang', $lang);
        App::setLocale($lang);

        return flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * @param $lang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function translate($lang)
    {
        $this->authorize('setting.language');

        $language = Language::whereValue($lang)->first();

        if (!$language)
            return flash(__('_error'), 0);

        return view('admin.language.translate.index', compact('language'));
    }

    public function dataTranslate(Request $request, $lang){

        $json = file_get_contents(resource_path('lang/') . $lang . '.json');

        $jsons = collect((array) json_decode($json));

        $collect = collect();

        $data = [];
        foreach ($jsons as $key => $value){
            $data['key'] = $key;
            $data['value'] = $value;

            $collect->add($data);
        }

        $collection = collect($collect);

        if ($request->has('search') && $request->filled('search')){

            $keyword = Str::replaceArray('_',['','_'], $request->get('search'));

            $collection = $collection->filter(function ($item) use ($keyword) {
                $keyword = Str::lower($keyword);
                $value = Str::lower($item['value']);
                $key = Str::lower($item['key']);
                return false !== (str_contains($value, $keyword)  ||  str_contains($key, $keyword));
            });
        }

        $collection = $collection->sortByDesc(function ($string){
            return $string['key'];
        });

        return datatables()->of($collection)

            ->addColumn('lang', function ($collect) use ($lang){
                return $lang;
            })->make();
    }

    public function createTranslate($lang){

        $this->authorize('setting.language');

        return view('admin.language.translate.create', compact('lang'));
    }

    public function storeTranslate(Request $request, $value){

        $this->authorize('setting.language');

        $lang = Language::whereValue($value)->first();

        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        $items = file_get_contents(resource_path('lang/') . $lang->value . '.json');

        $reqKey = trim($request->key);

        if (array_key_exists($reqKey, json_decode($items, true))) {
            return flash(__('_record_already_exists'),0);

        } else {
            $newArr[$reqKey] = trim($request->value);
            $itemsss = json_decode($items, true);
            $result = array_merge($itemsss, $newArr);
            file_put_contents(resource_path('lang/') . $lang->value . '.json', json_encode($result));

            return flash(__('_the_record_is_added_successfully'));

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function editTranslate(Request $request)
    {
        $this->authorize('setting.language');

        $key = $request->key;
        $value = Str::replace('_|_',' ',$request->value);
        $lang = $request->lang;

        return view('admin.language.translate.edit', compact('key', 'value', 'lang'));
    }

    /**
     * @param Request $request
     * @param $value
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */

    public function updateTranslate(Request $request, $value)
    {
        $this->authorize('setting.language');

        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        $reqkey = trim($request->key);
        $reqValue = $request->value;
        $lang = Language::whereValue($value)->first();

        $data = file_get_contents(resource_path('lang/') . $lang->value . '.json');

        $json_arr = json_decode($data, true);

        $json_arr[$reqkey] = $reqValue;

        file_put_contents(resource_path('lang/') . $lang->value . '.json', json_encode($json_arr));

        return flash('Updated Successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteTranslate(Request $request)
    {
        $this->authorize('setting.language');

        $reqkey = $request->key;
        $value = $request->lang;
        $lang = Language::whereValue($value)->first();
        $data = file_get_contents(resource_path('lang/') . $lang->value . '.json');

        $json_arr = json_decode($data, true);
        unset($json_arr[$reqkey]);

        file_put_contents(resource_path('lang/') . $lang->value . '.json', json_encode($json_arr));

        return flash(trim($request->key). "has been removed");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function import(Request $request)
    {

        $this->authorize('setting.language');

        $to = $request->to;

        $languages = Language::where('value', '!=', $to)->get();
        return view('admin.language.translate.import', compact('languages', 'to'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function importTranslate(Request $request)
    {
        $this->authorize('setting.language');

        $tolang = Language::whereValue($request->to)->first();
        $fromLang = Language::whereValue($request->from)->first();
        $json = file_get_contents(resource_path('lang/') . $fromLang->value . '.json');

        $json_arr = json_decode($json, true);

        file_put_contents(resource_path('lang/') . $tolang->value . '.json', json_encode($json_arr));

        return flash('Import successfully');
    }
}
