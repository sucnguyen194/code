<div class="form-comment" id="comments">
    <form method="post" action="{{route('comments.store')}}" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Đánh giá</label>
            <div id="targetFormat" class="rating-md rating-star"></div>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Bình luận</label>
            <textarea rows="4" class="form-control" name="data[comment]" required></textarea>
            <input type="hidden" name="slug" value="{{\Illuminate\Support\Str::before(request()->path(),'.html')}}" readonly>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="data[name]" class="form-control" required value="{{session('name')}}" placeholder="Họ & tên *">
                </div>
                <div class="col-lg-6">
                    <input type="email" name="data[email]" class="form-control" required value="{{session('email')}}" placeholder="Email *">
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> Gửi</button>
        </div>
    </form>
</div>
<?php
    $comments = $translation->item->comments->where('status', \App\Enums\ActiveDisable::active);
?>
<div class="list-group-item">
    @foreach($comments->where('parent_id',0) as $comment)
        <div class="item-comment mb-3">
            <div class="item-comment-top mb-3">
                <div class="row">
{{--                    <div class="col-md-1 item-avatar text-center">--}}
{{--                        <img src="/lib/assets/images/users/{{$comment->admin_id ? "avatar-1.jpg" : "avatar-3.jpg"}}" alt="" class="rounded-circle img-thumbnail">--}}
{{--                    </div>--}}
                    <div class="col-md-11">
                        <div class="item-name">
                            @if($comment->admin_id)
                                <strong>{{$comment->email}}</strong> <span class="qtv">QTV</span>
                            @else
                                <strong>{{$comment->name}}</strong>
                            @endif
                        </div>
                        <div class="item-comment mt-1">
                            @if($comment->hidden == \App\Enums\ActiveDisable::active)  {!! $comment->comment !!} @else <em>Bình luận đã bị ẩn</em> @endif
                        </div>
                        <div class="action-comment mt-1">
                            @if($comment->admin_id)
                                <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$comment->id}}, '{{$comment->email}}')">Trả lời</a>
                            @else
                                <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$comment->id}}, '{{$comment->name}}')">Trả lời</a>
                            @endif
                            - {{$comment->created_at->diffForHumans()}}
                        </div>
                    </div>
                </div>
                <div class="box-comment mt-2" target="{{$comment->id}}">
                    <form method="post" action="{{route('comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Bình luận</label>
                            <textarea rows="4" class="form-control" name="data[comment]" required></textarea>
                            <input type="hidden" name="slug" value="{{\Illuminate\Support\Str::before(request()->path(),'.html')}}">
                            <input type="hidden" name="data[parent_id]" value="{{$comment->id}}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="data[name]" class="form-control" required value="{{session('name')}}" placeholder="Họ & tên *">
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="data[email]" class="form-control" required value="{{session('email')}}" placeholder="Email *">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            @foreach($comments->where('parent_id',$comment->id) as $sub)
                <div class="sub-comment mb-3 ml-5">
                    <div class="item-comment-top mb-3">
                        <div class="row">
{{--                            <div class="col-md-1 item-avatar">--}}
{{--                                <img src="/lib/assets/images/users/{{$sub->admin_id ? "avatar-1.jpg" : "avatar-3.jpg"}}" alt="" class="rounded-circle img-thumbnail">--}}
{{--                            </div>--}}
                            <div class="col-md-11">
                                <div class="item-name">
                                    @if($sub->admin_id)
                                        <strong>{{$sub->email}}</strong> <span class="qtv">QTV</span>
                                    @else
                                        <strong>{{$sub->name}}</strong>
                                    @endif
                                </div>
                                <div class="item-comment mt-1">
                                    @if($sub->hidden == \App\Enums\ActiveDisable::active)  {!! $sub->comment !!} @else <em>Bình luận đã bị ẩn</em> @endif
                                </div>
                                <div class="action-comment mt-1">
                                    @if($sub->admin_id)
                                        <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub->id}}, '{{$sub->email}}')">Trả lời</a> @else
                                        <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub->id}}, '{{$sub->name }}')">Trả lời</a> @endif
                                    - {{$sub->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                        <div class="box-comment mt-2" target="{{$sub->id}}">
                            <form method="post" action="{{route('comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">Bình luận</label>
                                    <textarea rows="4" class="form-control" name="data[comment]" required></textarea>
                                    <input type="hidden" name="slug" value="{{\Illuminate\Support\Str::before(request()->path(),'.html')}}">
                                    <input type="hidden" value="{{$sub->id}}" name="data[parent_id]">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="data[name]" class="form-control" required value="{{session('name')}}" placeholder="Họ & tên *">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="email" name="data[email]" class="form-control" required value="{{session('email')}}" placeholder="Email *">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach($comments->where('parent_id',$sub->id) as $sub_sub)
                        <div class="sub-comment mb-3 ml-5">
                            <div class="item-comment-top mb-3">
                                <div class="row">
{{--                                    <div class="col-md-1 item-avatar">--}}
{{--                                        @if($sub_sub->admin_id)--}}
{{--                                            <img src="/lib/assets/images/users/avatar-1.jpg" alt="" class="rounded-circle img-thumbnail">--}}
{{--                                        @else--}}
{{--                                            <img src="/lib/assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-thumbnail">--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
                                    <div class="col-md-11">
                                        <div class="item-name">
{{--                                                    <span class="status-comment font-15">--}}
{{--                                                       <i class="{{$sub_sub->status == 1 ? "pe-7s-like2 text-primary" : "pe-7s-info text-danger"}} font-weight-bold"></i>--}}
{{--                                                    </span>--}}
                                            @if($sub_sub->admin_id)
                                                <strong>{{$sub_sub->email}}</strong> <span class="qtv">QTV</span>
                                            @else
                                                <strong>{{$sub_sub->name}}</strong>
                                            @endif
                                        </div>
                                        <div class="item-comment mt-1">
                                            @if($sub_sub->hidden == \App\Enums\ActiveDisable::active)  {!! $sub_sub->comment !!} @else <em>Bình luận đã bị ẩn</em> @endif
                                        </div>
                                        <div class="action-comment mt-1">
                                            @if($sub_sub->admin_id)
                                                <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub_sub->id}}, '{{$sub_sub->email}}')">Trả lời</a>
                                            @else
                                                <a href="javascript:void(0)" class="font-weight-bold" onclick="openComment({{$sub_sub->id}}, '{{$sub_sub->name}}')">Trả lời</a>
                                            @endif
                                            - {{$sub_sub->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </div>
                                <div class="box-comment mt-2" target="{{$sub_sub->id}}">
                                    <form method="post" action="{{route('comments.store')}}" class="ajax-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-bold">Bình luận</label>
                                            <input type="hidden" name="slug" value="{{\Illuminate\Support\Str::before(request()->path(),'.html')}}">
                                            <input type="hidden" value="{{$sub->id}}" name="data[parent_id]">
                                            <textarea rows="4" class="form-control" name="data[comment]" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" name="data[name]" class="form-control" required value="{{session('name')}}" placeholder="Họ & tên *">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="email" name="data[email]" class="form-control" required value="{{session('email')}}" placeholder="Email *">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><span class="icon-button"><i class="pe-7s-paper-plane"></i> </span> Gửi</button>
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
<style>
    .qtv {
        display: inline;
        vertical-align: middle;
        font-style: normal;
        background-color: #eebc49;
        color: #222;
        font-size: 10px;
        padding: 5px 5px 3px 5px;
        border-radius: 2px;
        width: auto;
        height: auto;
        line-height: 1;
        margin-left: 5px;
    }
</style>
<!-- Init js -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#targetFormat").raty({
            starOff: "far fa-star",
            starOn: "fas fa-star text-danger",
            scoreName: 'data[rate]',
            score: 5
        })
    })
</script>
<script>
    $('.box-comment').hide();

    function openComment(id, name){
        $('.box-comment').hide();
        let box = $('.box-comment[target="'+id+'"]');
        box.show();
        box.find('textarea').val('@'+name+': ');
    }
</script>
