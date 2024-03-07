<?php

namespace App\Interfaces\Home\Cart;

interface CartRepositoryInterface
{
    public function find($id);

    public function create($data);

    public function findCartByProductIdAndUserId($productId, $userId);

}


?>
