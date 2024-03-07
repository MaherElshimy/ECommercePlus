<?php

// app/Http/Controllers/Home/Comments/CommentController.php

namespace App\Http\Controllers\Home\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Home\Comment\CommentRepositoryInterface;
use App\Interfaces\Home\Comment\ReplyRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $user;
    private $commentRepository;
    private $replyRepository;

    public function __construct(
        CommentRepositoryInterface $commentRepository,
        ReplyRepositoryInterface $replyRepository
    ) {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->commentRepository = $commentRepository;
        $this->replyRepository = $replyRepository;
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
            $commentData = [
                'name' => $this->user->name,
                'user_id' => $this->user->id,
                'comment' => $request->comment,
            ];

            $this->commentRepository->create($commentData);

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
            $replyData = [
                'name' => $this->user->name,
                'user_id' => $this->user->id,
                'comment_id' => $request->commentId,
                'reply' => $request->reply,
            ];

            $this->replyRepository->create($replyData);

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
}

?>
