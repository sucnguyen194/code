<?php namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Enums\CommentMap;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function list($type){
        $this->authorize('comment.view');
        return  view('admin.comment.index', compact('type'));
    }

    public function reply($type, $id){
        $this->authorize('comment.edit');

        $reply = $type == CommentMap::products ? Product::findOrFail($id) : Post::findOrFail($id);
        $reply->withTranslation();
        $comments = $reply->comments;

        return view('admin.comment.edit', compact('reply','comments','type'));
    }


    public function data(){
        $this->authorize('comment.view');
        $comments = request()->type == CommentMap::products ? new Product() : new Post();

        $comments = $comments->query()->whereHas('comments')
            ->when(request()->search, function ($q, $keyword){
                return $q->whereHas('translation',function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%')->orWhere('slug', 'like', '%'.$keyword.'%');
                });
            })
            ->withTranslation();

        return datatables()->of($comments)
            ->editColumn('title',function ($comment){
                return $comment->translation->name;
            })

            ->editColumn('comment_last',function ($comment){
                return $comment->comments->last()->comment;
            })

            ->editColumn('comment_count',function ($comment){
                return $comment->comments->where('status', ActiveDisable::disable)->count();
            })
            ->editColumn('commenter',function ($comment){
                return $comment->comments->last()->name;
            })

            ->editColumn('created_at', function ($comment){
                return $comment->comments->last()->created_at->diffForHumans();
            })
            ->order(function($q){
                $q->orderBy(request()->input('sort','created_at'), request()->input('order','desc'));
            })->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('comment.create');

        Validator::make($request->data,[
            'comment' => 'required',
            'name' => 'required',
            'email' => 'email|required',
        ]);
        $translation = Translation::whereSlug($request->slug)->first();
        if(!$translation)
            return flash('Đã có lỗi xảy ra. Vui lòng thủ lại!',4);

        $comment = new Comment();
        $comment->forceFill($request->data);
        $comment->comment()->associate($translation->item);
        $comment->admin_id = Auth::id();
        $comment->status = ActiveDisable::active;
        $comment->save();

        if($request->reply){
          Comment::find($request->reply)->update(['status' => ActiveDisable::active]);
        }
        $route = route('admin.comments.reply',[$comment->comment_type, $comment->comment_id]);
        return  flash('Trả lời thành công!',1 , $route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('comment.edit');

        $comment = Comment::findOrFail($id);

        if($comment->hidden == ActiveDisable::disable){
            $comment->update([
                'hidden' => ActiveDisable::active
            ]);
        }else{
            $comment->update([
                'hidden' => ActiveDisable::disable
            ]);
        }
        return flash('Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('comment.destroy');

        Comment::query()->whereCommentId($id)->delete();

        return flash('Xóa bình luận thành công!');
    }


}
