<?php

namespace App\Repositories\Home\Cart;
use App\Interfaces\Home\Cart\CartRepositoryInterface;

use App\Models\Cart;

class CartRepository implements CartRepositoryInterface
{
    public function find($id)
    {
        return Cart::find($id);
    }

    public function create($data)
    {
        return Cart::create($data);
    }

    public function findCartByProductIdAndUserId($productId, $userId)
    {
        return Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->value('id');
    }


}
?>
