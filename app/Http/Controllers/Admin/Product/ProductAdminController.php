<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Admin\Product\AdminProductRepositoryInterface;
use App\Interfaces\Admin\Category\CategoryServiceInterface;
use App\Models\Catagory;

class ProductAdminController extends Controller
{
    public function __construct(
        AdminProductRepositoryInterface $productRepository,
        CategoryServiceInterface $categoryService
    ) {
        $this->middleware(function ($request, $next) {
            if (!Auth::id()) {
                return redirect('login');
            }
            return $next($request);
        });

        $this->productRepository = $productRepository;
        $this->categoryService = $categoryService;
    }

    private function validateProductRequest(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'catagory' => 'required', // Assuming 'catagory' is the correct field name
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount_price' => 'numeric|nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    public function uploadImage($file)
    {
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move('product', $imageName);

        return $imageName;
    }




    public function viewProduct()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('admin.product', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $this->validateProductRequest($request);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $this->productRepository->createProduct($data);

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function showProducts()
    {
        $products = $this->productRepository->getAllProducts();

        return view('admin.show_product', compact('products'));
    }

    public function deleteProduct($id)
    {
        $this->productRepository->deleteProduct($id);

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function updateProduct($id)
    {
        $product = $this->productRepository->getProductById($id);
        $categories = $this->categoryService->getAllCategories();

        return view('admin.update_product', compact('product', 'categories'));
    }

    public function updateProductConfirm(Request $request, $id)
    {
        $data = $request->only(['title', 'description', 'catagory', 'quantity', 'price', 'discount_price']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $this->productRepository->updateProduct($id, $data);

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

}


?>
