<?php

namespace App\Repositories\Home\Comment;

use App\Interfaces\Home\Comment\ReplyRepositoryInterface;
use App\Models\Reply;

class ReplyRepository implements ReplyRepositoryInterface
{
    public function create(array $data)
    {
        return Reply::create($data);
    }
    public function getAllReplies()
    {
        return Reply::all();
    }

}


?>
