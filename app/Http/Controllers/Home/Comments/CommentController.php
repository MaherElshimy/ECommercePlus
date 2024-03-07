<?php

namespace App\Http\Controllers\Home\Comments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth ;


use App\Models\User ;
use App\Models\Product ;
use App\Models\Comment ;
use App\Models\Reply ;



class CommentController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    /**
     * Add a comment to a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(Request $request)
    {
        if ($this->user) {
            $comment = new Comment;
            $comment->name = $this->user->name;
            $comment->user_id = $this->user->id;
            $comment->comment = $request->comment;
            $comment->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

        /**
     * Add a reply to a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addReply(Request $request)
    {
        if ($this->user) {
            $reply = new Reply;
            $reply->name = $this->user->name;
            $reply->user_id = $this->user->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }


}
