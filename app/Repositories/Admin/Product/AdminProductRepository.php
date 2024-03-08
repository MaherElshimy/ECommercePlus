<?php
// app/Repositories/Admin/Product/ProductRepository.php

namespace App\Repositories\Admin\Product;

use App\Interfaces\Admin\Product\AdminProductRepositoryInterface;
use App\Models\Product;

class AdminProductRepository implements AdminProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct($id, array $data)
    {
        $product = Product::find($id);
        $product->fill($data);

        // Add logic to handle image upload if needed

        $product->save();

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
    }


}

?>
