<?php

namespace App\Interfaces\Home\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductDetails($id);
    public function searchProducts($searchText);

    public function getAllFeaturedProducts();

}

?>
