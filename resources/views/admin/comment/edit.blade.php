@extends('admin.layouts.layout')
@section('title')
    {{__('_comment')}} #{{$reply->id}}
@stop
@section('content')

    <div class="container-fluid" id="app-comments">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.comments.list',$type)}}">{{__('_comment')}}</a></li>
                            <li class="breadcrumb-item">#{{$reply->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title"> <a href="{{route('slug',$reply->translation->slug)}}" target="_blank">#{{$reply->translation->name}}</a></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container">
        <div class="card-box">
            <div class="form-comment" id="comments">
                <form method="post" action="{{route('admin.comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">{{__('_comment')}}</label>
                        <textarea rows="4" class="form-control summerdescription" name="data[comment]"></textarea>
                        <input type="hidden" name="slug" value="{{$reply->translation->slug}}" readonly>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="data[name]" class="form-control" value="{{auth()->user()->name}}" placeholder="{{__('lang.fullname')}} *">
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="data[email]" class="form-control" value="{{auth()->user()->email}}" placeholder="{{__('_email')}} *">
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-default"><span class="icon-button"><i class="pe-7s-refresh"></i> </span> {{__('_back')}}</button>
                        <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> {{__('_save')}} <span class="text-lowercase">{{__('_comment')}}</span></button>
                    </div>
                </form>
            </div>
            <div class="list-group-item">
                @foreach($comments->where('parent_id',0) as $comment)
                    <div class="item-comment mb-3">
                        <div class="item-comment-top mb-3">
                            <div class="row">
                                <div class="col-md-1 item-avatar text-center">
                                    <span class="font-24 font-weight-bold border d-block w-100 h-100" style="line-height: 76px;">{{user_avatar($comment->name)}}</span>
                                </div>
                                <div class="col-md-11">
                                    <div class="item-name">
                                         <span class="status-comment font-15">
                                               <i class="{{$comment->status == \App\Enums\ActiveDisable::active ? "pe-7s-like2 text-primary" : "pe-7s-info text-danger"}} font-weight-bold"></i>
                                             </span>
                                        @if($comment->admin_id)
                                            <strong>{{$comment->email}}</strong> <span class="qtv">{{__('_qtv')}} </span>
                                        @else
                                            <strong>{{$comment->name}}</strong>
                                        @endif

                                      <span class="app-rating-star">
                                          {!! $comment->rating !!}
                                      </span>
                                    </div>
                                    <div class="item-comment mt-1 {{$comment->hidden != \App\Enums\ActiveDisable::active ? "d-none" : ""}}">
                                        {!! $comment->comment !!}
                                    </div>
                                    <div class="item-hidden mt-1 {{$comment->hidden == \App\Enums\ActiveDisable::active ? "d-none" : ""}}">
                                        <em>{{__('lang.hidden_comment')}} </em>
                                    </div>
                                    <div class="action-comment mt-1">
                                        @if($comment->admin_id)
                                            <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$comment->id}}, '{{$comment->email}}')">{{__('_answer')}} </a>
                                        @else
                                            <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$comment->id}}, '{{$comment->name}}')">{{__('_answer')}}</a>
                                        @endif
                                         -   <a class="text-primary font-weight-bold ajax-link" data-method="PUT" data-refresh="true" href="{{route('admin.comments.update',$comment)}}">{{$comment->hidden == \App\Enums\ActiveDisable::active ? "_hide_comment" : "_un_hide"}}</a>
                                        - {{$comment->created_at->diffForHumans()}}
                                    </div>
                                </div>
                            </div>
                            <div class="box-comment mt-2" target="{{$comment->id}}">
                                <form method="post" action="{{route('admin.comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="font-weight-bold">{{__('_comment')}}</label>
                                        <textarea rows="4" class="form-control summerdescription" name="data[comment]"></textarea>
                                        <input type="hidden" name="slug" value="{{$reply->translation->slug}}">
                                        <input type="hidden" name="data[parent_id]" value="{{$comment->id}}">
                                        <input type="hidden" value="{{$comment->id}}" name="reply">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" name="data[name]" class="form-control" value="{{auth()->user()->name}}" placeholder="{{__('lang.fullname')}} *">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="email" name="data[email]" class="form-control" value="{{auth()->user()->email}}" placeholder="{{__('_email')}} *">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-default"><span class="icon-button"><i class="pe-7s-refresh"></i> </span> {{__('_back')}}</button>
                                        <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> {{__('_save')}} <span class="text-lowercase">{{__('_comment')}}</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @foreach($comments->where('parent_id',$comment->id) as $sub)
                            <div class="sub-comment mb-3 ml-5">
                                <div class="item-comment-top mb-3">
                                    <div class="row">
                                        <div class="col-md-1 item-avatar text-center">
                                            <span class="font-24 font-weight-bold border d-block w-100 h-100" style="line-height: 76px;">{{user_avatar($sub->name)}}</span>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="item-name">
                                                <span class="status-comment font-15">
                                               <i class="{{$sub->status == \App\Enums\ActiveDisable::active ? "pe-7s-like2 text-primary" : "pe-7s-info text-danger"}} font-weight-bold"></i>
                                             </span>
                                                @if($sub->admin_id)
                                                    <strong>{{$sub->email}}</strong> <span class="qtv">{{__('_qty')}}</span>
                                                @else
                                                    <strong>{{$sub->name}}</strong>
                                                @endif
                                            </div>
                                            <div class="item-comment mt-1 {{$sub->hidden != \App\Enums\ActiveDisable::active ? "d-none" : ""}}">
                                                  {!! $sub->comment !!}
                                            </div>
                                            <div class="item-hidden mt-1 {{$sub->hidden == \App\Enums\ActiveDisable::active ? "d-none" : ""}}">
                                               <em>{{__('lang.hidden_comment')}}</em>
                                            </div>
                                            <div class="action-comment mt-1">
                                                @if($sub->admin_id)
                                                    <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub->id}}, '{{$sub->email}}')">{{__('_answer')}}</a> @else
                                                    <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub->id}}, '{{$sub->name }}')">{{__('_answer')}}</a> @endif
                                                    -   <a class="text-primary font-weight-bold ajax-link" data-method="PUT" data-refresh="true" href="{{route('admin.comments.update',$sub)}}">{{$sub->hidden == \App\Enums\ActiveDisable::active ? "_hide_comment" : "_un_hide"}}</a>
                                                    - {{$sub->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-comment mt-2" target="{{$sub->id}}">
                                        <form method="post" action="{{route('admin.comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="font-weight-bold">{{__('_comment')}}</label>
                                                <textarea rows="4" class="form-control summerdescription" name="data[comment]"></textarea>
                                                <input type="hidden" name="slug" value="{{$reply->translation->slug}}">
                                                <input type="hidden" value="{{$sub->id}}" name="data[parent_id]">
                                                <input type="hidden" value="{{$sub->id}}" name="reply">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" name="data[name]" class="form-control" value="{{auth()->user()->name}}" placeholder="{{__('lang.fullname')}} *">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="email" name="data[email]" class="form-control" value="{{auth()->user()->email}}" placeholder="{{__('_email')}} *">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="reset" class="btn btn-default"><span class="icon-button"><i class="pe-7s-refresh"></i> </span> {{__('_back')}}</button>
                                                <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> {{__('_save')}} <span class="text-lowercase">{{__('_comment')}}</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @foreach($comments->where('parent_id',$sub->id) as $sub_sub)
                                    <div class="sub-comment mb-3 ml-5">
                                        <div class="item-comment-top mb-3">
                                            <div class="row">
                                                <div class="col-md-1 item-avatar text-center">
                                                    <span class="font-24 font-weight-bold border d-block w-100 h-100" style="line-height: 76px;">{{user_avatar($sub_sub->name)}}</span>
                                                </div>
                                                <div class="col-md-11">
                                                    <div class="item-name">
                                                         <span class="status-comment font-15">
                                                            <i class="{{$sub_sub->status == \App\Enums\ActiveDisable::active ? "pe-7s-like2 text-primary" : "pe-7s-info text-danger"}} font-weight-bold"></i>
                                                         </span>
                                                        @if($sub_sub->admin_id)
                                                            <strong>{{$sub_sub->email}}</strong> <span class="qtv">{{__('_qty')}}</span>
                                                        @else
                                                            <strong>{{$sub_sub->name}}</strong>
                                                        @endif
                                                    </div>
                                                    <div class="item-comment mt-1 {{$sub_sub->hidden != \App\Enums\ActiveDisable::active ? "d-none" : ""}}">
                                                        {!! $sub_sub->comment !!}
                                                    </div>
                                                    <div class="item-hidden mt-1 {{$sub_sub->hidden == \App\Enums\ActiveDisable::active ? "d-none" : ""}}">
                                                        <em>{{__('lang.hidden_comment')}}</em>
                                                    </div>
                                                    <div class="action-comment mt-1">
                                                        @if($sub_sub->admin_id)
                                                            <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub_sub->id}}, '{{$sub_sub->email}}')">{{__('_answer')}}</a>
                                                        @else
                                                            <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub_sub->id}}, '{{$sub_sub->name}}')">{{__('_answer')}}</a>
                                                        @endif
                                                            -   <a class="text-primary font-weight-bold ajax-link" data-method="PUT" data-refresh="true" href="{{route('admin.comments.update',$sub_sub)}}">{{$sub_sub->hidden == \App\Enums\ActiveDisable::active ? "_hide_comment" : "_un_hide"}}</a>
                                                            - {{$sub_sub->created_at->diffForHumans()}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-comment mt-2" target="{{$sub_sub->id}}">
                                                <form method="post" action="{{route('admin.comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">{{__('_comment')}}</label>
                                                        <input type="hidden" name="slug" value="{{$reply->translation->slug}}">
                                                        <input type="hidden" value="{{$sub->id}}" name="data[parent_id]">
                                                        <input type="hidden" value="{{$sub_sub->id}}" name="reply">
                                                        <textarea rows="4" class="form-control summerdescription" name="data[comment]"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input type="text" name="data[name]" class="form-control" value="{{auth()->user()->name}}" placeholder="{{__('lang.fullname')}} *">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="email" name="data[email]" class="form-control" value="{{auth()->user()->email}}" placeholder="{{__('_email')}} *">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button type="reset" class="btn btn-default"><span class="icon-button"><i class="pe-7s-refresh"></i> </span> {{__('_back')}}</button>
                                                        <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> {{__('_save')}} <span class="text-lowercase">{{__('_comment')}}</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- rating js -->

    <script>
        $('.box-comment').hide();
        function openComment(id, name){
            $('.box-comment').hide();
            let box = $('.box-comment[target="'+id+'"]');
            box.show();
            box.find('textarea').val('@'+name+': ');
        }

        $('.ajax-link').click(function(){
           let comment =  $(this).closest('.item-comment');
           if($(comment).find('.item-comment').hasClass('d-none')){
               $(comment).find('.item-comment').removeClass('d-none');
               $(comment).find('.item-hidden').addClass('d-none');
           }else{
               $(comment).find('.item-comment').addClass('d-none');
               $(comment).find('.item-hidden').removeClass('d-none');
           }
        })
    </script>
@stop
