@extends('layouts.layout')
@section('title', 'Danh sách trung tâm')
@section('url') {{route('map')}} @stop

@section('content')
    <section id="wrapper-content" class="wrapper-content">
        <div class="title-container">
            <div class="title">
                <nav class="bread-crumbs">
                    <ul>

                        <li data-key="home"><a href="/">Trang chủ</a></li>
                        <li>/</li>

                        <li data-key="category"><span class="current">Danh sách trung tâm</span></li>
                    </ul>
                </nav>
                <h3 class="heading">Danh sách trung tâm</h3>
            </div>
        </div>

        <section class="container row content-main archive clearfix">
            <div class="result_dealer">
                <div class="result_info">
                    <div id="viewList" class="list-view">
                        <div class="r-count">Tìm được <span id="map_num">{{$maps->count()}}</span> trung tâm</div>
                        <div class="show-result result-wrapper" id="viewList">
                            <div class="item-view">
                                @foreach($maps as $map)
                                <div class="item" data-map="{{$map->map}}">
                                    <div class="info">
                                        <div class="name">{{$map->name}}</div>
                                        <div class="address">{{$map->address}}</div>
                                        <div class="phone"><span>{{$map->phone}}</span></div>
                                        <div class="timeopen"><span>Mở cửa</span>{{$map->time_open}}</div>
                                        <div class="listPa">
                                            <ul>
                                                @if($map->wifi === \App\Enums\ActiveDisable::active)
                                                <li><i class="fa fa-wifi"></i> Wifi Miễn Phí</li>
                                                @endif
                                                @if($map->checkout === \App\Enums\ActiveDisable::active)
                                                <li><i class="fa fa-credit-card"></i> Thanh toán bằng thẻ</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
                <div class="result_map" id="viewMap" style="position: relative; zoom: 1;">
                    <div class="mapdemo showmap">
                        <div id="map" style="position: relative; overflow: hidden;"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>

        <div id="back-to-top">
            <a href="#top">{{__('client.top')}}</a>
        </div> <!-- back-to-top -->

    </section>
@stop

