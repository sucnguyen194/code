@extends('admin.layouts.layout')
@section('title')
    Tin nhắn #ID{{$contact->id}}
@stop
@section('content')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.contacts.index')}}">Tin nhắn</a></li>
                            <li class="breadcrumb-item active">#ID {{$contact->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><strong>ĐÃ XEM</strong></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container">
        <!-- end page title -->
        <div class="row">

            <!-- Right Sidebar -->
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="mt-0">
                        <div class="media mb-4">
                            <img class="d-flex mr-3 rounded-circle avatar-sm" src="{{$contact->avatar}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <span class="float-right">{{$contact->created_at->diffForHumans()}}</span>
                                <h5 class="m-0">{{$contact->name}}</h5>
                                <small class="text-muted">From: {{$contact->email}}</small><br>
                                <small class="text-muted">Phone: {{$contact->phone}}</small>
                            </div>
                        </div>
                        @if($contact->note)
                        <p>{!! nl2br($contact->note) !!}</p>
                        @else
                            <p>Khách hàng yêu cầu nhận thông tin: <a href="mailto:{{$contact->email}}" class="font-weight-bold"> {{$contact->email}}</a></p>
                        @endif
                        <hr/>
                    </div> <!-- card-box -->
                    <hr>
                    <div class="ml-3">
                        @foreach($replys as $item)
                        <div class="media mb-4">
                            <img class="d-flex mr-3 rounded-circle avatar-sm" src="{{$item->user->gravatar}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <span class="float-right">{{$item->created_at->diffForHumans()}}</span>
                                <h5 class="m-0">{{$item->user->name ?? $item->user->account}}</h5>
                                <small class="text-muted">To: {{$item->user->email}}</small><br>
                                <small class="text-muted">Phone: {{$item->user->phone}}</small>
                            </div>
                        </div>
                        <p>{!! $item->note !!}</p>
                        <hr/>
                        @endforeach
                    </div>
                    @if($contact->email)
                    <form method="post" action="{{route('admin.contacts.update',$contact)}}" class="ajax-form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-5">
                            <lable class="font-weight-bold mb-2">Trả lời</lable>
                            <p class="mt-2">* Nội dung email không được bỏ trống!</p>
                            <textarea class="form-control summernote" data-height="600" name="data[note]"></textarea>

                        </div>

                        <div class="text-right">
                            <a href="{{route('admin.contacts.index')}}" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại</a>
                            @if(setting('contact.email'))
                            <button type="submit" class="btn btn-primary waves-effect waves-light"><span class="icon-button"><i class="fe-edit-1"></i></span> Trả lời</button>
                            @else
                                <a href="{{route('admin.settings')}}" class="btn btn-primary waves-effect waves-light"><span class="icon-button"><i class="fe-edit-1"></i></span> Email chưa được cấu hình!</a>
                            @endif
                        </div>
                    </form>
                    @else
                        <div class="text-right">
                            <a href="{{route('admin.contacts.index')}}" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại</a>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>

            </div> <!-- end Col -->

        </div><!-- End row -->
    </div>

@stop

