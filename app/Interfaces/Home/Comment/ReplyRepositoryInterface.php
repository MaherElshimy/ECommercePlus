<?php


namespace App\Interfaces\Home\Comment;

interface ReplyRepositoryInterface
{
    public function create(array $data);
    public function getAllReplies();

}

?>
