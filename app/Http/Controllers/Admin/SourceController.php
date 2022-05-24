<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('setting.source');
        $icon = ['/', '_'];

        return view('admin.source.list', compact('icon'));
    }

    public function load(Request $request){
        $this->authorize('setting.source');

        $path = $request->path;
        $data['file'] = Str::afterLast($path,'/');
        $data['content'] = file_get_contents($path);
        return response()->json($data);
    }

    public function push(Request $request){
        $this->authorize('setting.source');

        $content = $request->put_file;
        $dir = $request->dir;
        file_put_contents($dir,$content);
        $time = time();
        return $time;
    }
}
