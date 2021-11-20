<div id="accordion-cat" class="u-accordion g-mb-20" role="tablist" aria-multiselectable="true">
    <!-- Card -->
    <div class="card rounded-0 g-brd-none">

        <div id="accordion-cat-heading-4" class="u-accordion__header g-pa-10 g-bg-main-10"
             role="tab">
            <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                <a class="d-flex justify-content-between g-color-white g-text-underline--none--hover"
                   href="#accordion-cat-body-4" data-toggle="collapse" data-parent="#accordion-cat"
                   aria-expanded="true" aria-controls="accordion-cat-body-4">
                    Danh mục sản phẩm
                    <span class="u-accordion__control-icon g-ml-10">
                              <i class="fa fa-angle-down"></i>
                              <i class="fa fa-angle-up"></i>
                            </span>
                </a>
            </h5>
        </div>
        <div id="accordion-cat-body-4" class="collapse show g-bg-main-9" role="tabpanel"
             aria-labelledby="accordion-cat-heading-4" data-parent="#accordion-cat" style="">
            <div class="u-accordion__body g-color-white g-pa-0">
                @php
                    $categories = \App\Models\Category::with('translation')->whereHas('translation')->whereType(\App\Enums\CategoryType::product)->public()->oldest('sort')->latest()->get();
                @endphp

                @foreach($categories->where('parent_id',0) as $category)
                <div id='accordion-itemcat-heading-{{$category->id}}'
                     class='u-accordion__header g-pa-10 g-bg-primary' role='tab'><h5
                        class='mb-0 g-font-size-default d-flex'>
                        @if($categories->where('parent_id', $category->id)->count())
                        <a
                            class='g-color-white g-text-underline--none--hover'
                            href='#accordion-itemcat-body-{{$category->id}}' data-toggle='collapse'
                            aria-expanded='true' aria-controls='accordion-itemcat-body-19'><span
                                class='u-accordion__control-icon g-mr-10'><i
                                    class='fa fa-angle-down'></i><i
                                    class='fa fa-angle-up'></i></span></a>
                        @endif
                        <a
                            class='g-color-white g-text-underline--none--hover text-uppercase g-font-weight-700'
                            href='{{$category->slug}}'>{{$category->name}}</a></h5></div>
                @if($categories->where('parent_id', $category->id)->count())
                <div id='accordion-itemcat-body-{{$category->id}}' class='collapse show g-bg-main-9'
                     role='tabpanel' aria-labelledby='accordion-itemcat-heading-19'>
                    <div class='u-accordion__body g-color-white g-pa-0'>
                        @foreach($categories->where('parent_id', $category->id) as $sub)
                        <div class='d-flex g-my-15 g-pl-25'>
                            <div class='g-mr-10'><span class='g-color-icon-footer'><i
                                        class='fa fa-caret-right g-mt-5'></i></span></div>
                            <p class='mb-0'><a class='g-color-white g-text-underline--none--hover'
                                               href='{{$sub->slug}}'>{{$sub->name}}</a></p></div>
                            @endforeach
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>


    </div>
    <!-- End Card -->
</div>


<div id="accordion-post" class="u-accordion g-mb-20" role="tablist" aria-multiselectable="true">
    <!-- Card -->
    <div class="card rounded-0 g-brd-none">

        <div id="accordion-post-heading-4" class="u-accordion__header g-pa-10 g-bg-main-10"
             role="tab">
            <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                <a class="d-flex justify-content-between g-color-white g-text-underline--none--hover"
                   href="#accordion-post-body-4" data-toggle="collapse" data-parent="#accordion-post"
                   aria-expanded="true" aria-controls="accordion-cat-body-4">
                    Tin mới nhất
                    <span class="u-accordion__control-icon g-ml-10">
                              <i class="fa fa-angle-down"></i>
                              <i class="fa fa-angle-up"></i>
                            </span>
                </a>
            </h5>
        </div>
        <div id="accordion-post-body-4" class="collapse show" role="tabpanel"
             aria-labelledby="accordion-post-heading-4" data-parent="#accordion-post" style="">
            <div class="u-accordion__body g-color-white g-pa-0">
                @foreach(\App\Models\Post::with('translation')->whereType(\App\Enums\PostType::post)->whereHas('translation')->public()->latest()->take(setting('site.post.index') ?? 6)->get() as $post)
                    <article class="position-relative pt-1 pb-2">
                        <div class="row">
                            <div class="col-lg-5 col-4 pr-0">
                                <a class="g-text-underline--none--hover"
                                   href="{{$post->slug}}">

                                    <img class="img-fluid w-100" src="{{$post->thumb}}"
                                         alt="{{$post->title}}"/></a>
                            </div>
                            <div class="col-lg-7 col-8">
                                <div class="g-bg-white g-pa-5">
                                    <!--<div class="g-mb-5 small">
                                      12/04/2021
                                    </div>
                                    <div class="g-width-60 g-brd-bottom g-brd-3 g-brd-primary g-mb-10"></div>-->
                                    <h3 class="h6 g-font-weight-600 g-mb-10">
                                        <a class="g-color-gray-dark-v2 g-text-underline--none--hover title-line-3"
                                           href="{{$post->slug}}">{{$post->title}}</a>
                                    </h3>

                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <style>
            .title-line-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
    </div>
    <!-- End Card -->
</div>
