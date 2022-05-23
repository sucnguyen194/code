<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function generate() {
        $categories = Category::public()->latest()->get();
        $posts = Post::public()->latest()->get();
        $products = Product::public()->latest()->get();
        return response()->view('layouts.sitemap', [
            'posts' => $posts,
            'categories' => $categories,
            'products' => $products
        ])->header('Content-Type', 'text/xml');
    }
}
