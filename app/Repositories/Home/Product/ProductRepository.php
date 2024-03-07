<?php
namespace App\Repositories\Home\Product;

use App\Interfaces\Home\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::paginate(6);
    }

    public function getProductDetails($id)
    {
        return Product::find($id);
    }

    public function searchProducts($searchText)
    {
        return Product::where('title', 'LIKE', "%$searchText%")
            ->orWhere('catagory', 'LIKE', "%$searchText%")
            ->paginate(10);
    }

    public function getAllFeaturedProducts()
    {
        return Product::paginate(9);
    }


}


?>
