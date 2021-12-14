<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function generate() {
        $categories = Category::with('translation')->public()->latest()->get();
        $posts = Post::with('translation')->public()->latest()->get();
        $products = Product::with('translation')->public()->latest()->get();
        return response()->view('layouts.sitemap', [
            'posts' => $posts,
            'categories' => $categories,
            'products' => $products
        ])->header('Content-Type', 'text/xml');
    }
}
