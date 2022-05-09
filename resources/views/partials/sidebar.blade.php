<aside id="sidebar" class="sidebar" role="complementary">
    <div id="categories-2" class="widget widget_categories"><h3 class="widget-title">Chuyên mục</h3>
        <ul>
            @foreach($categories as $category)
            <li class="cat-item cat-item-42"><a href="{{$category->slug}}">{{$category->name}}</a>
            </li>
            @endforeach
        </ul>

    </div>
    <div id="recent-posts-2" class="widget widget_recent_entries">
        <h3 class="widget-title">Bài viết mới</h3>
        <ul>
            @foreach($posts as $post)
            <li>
                <a href="{{$post->slug}}">{{$post->title}}</a>
            </li>
             @endforeach
        </ul>

    </div>
    <div id="tag_cloud-2" class="widget widget_tag_cloud"><h3 class="widget-title">Thẻ</h3>
        <div class="tagcloud">
            @foreach($tags as $tag)
            <a href="{{$tag->slug}}" class="tag-cloud-link tag-link-47 tag-link-position-13"
               style="font-size: 8pt;" aria-label="{{$tag->name}}">{{$tag->name}}</a>
            @endforeach
        </div>
    </div>
</aside> <!-- #sidebar -->
