
@foreach($pages as $page)
    <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2c206567 feature-style3"
         data-id="2c206567" data-element_type="column"
         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-column-wrap elementor-element-populated">
            <div class="elementor-widget-wrap">
                <div class="elementor-element elementor-element-5c161be7 elementor-widget elementor-widget-instive-insurance"
                     data-id="5c161be7" data-element_type="widget"
                     data-widget_type="instive-insurance.default">
                    <div class="elementor-widget-container">

                        <div class="ts-feature-box style1">

                            <h3 class="ts-title md">
                                <a href="{{$page->slug}}">{{$page->title}}</a>
                            </h3>

                            <div class="media-body">

                                <p>{!! str_limit($page->description,1000) !!}</p>

                                <a href="{{$page->slug}}"
                                   class="btn-link readmore"> Tìm hiểu
                                    thêm </a>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
