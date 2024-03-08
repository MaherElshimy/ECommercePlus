<?php


namespace App\Repositories\Home\Comment;

use App\Interfaces\Home\Comment\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function getAllComments()
    {
        return Comment::orderBy('id', 'desc')->get();
    }


}

?>
