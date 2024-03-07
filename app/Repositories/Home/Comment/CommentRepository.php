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

    // Implement other methods as needed
}

?>
