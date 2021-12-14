<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

        <url>
            <loc>{{asset('/')}}</loc>
            <lastmod>2021-12-12T12:00:00+00:00</lastmod>
            <priority>1.00</priority>
        </url>
        @foreach ($categories as $category)
            <url>
                <loc>{{$category->slug}}</loc>
                <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endforeach
        @foreach ($posts as $post)
            <url>
                <loc>{{$post->slug}}</loc>
                <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endforeach
        @foreach ($products as $product)
            <url>
                <loc>{{$product->slug}}</loc>
                <lastmod>{{ $product->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <priority>0.64</priority>
            </url>
        @endforeach
</urlset>
