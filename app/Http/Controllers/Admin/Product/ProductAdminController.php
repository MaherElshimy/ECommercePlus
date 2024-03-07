<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

use App\Models\Product;
use App\Models\Catagory;


class ProductAdminController extends Controller
{
    private function checkAuthentication()
    {
        if (!Auth::id()) {
            return redirect('login');
        }
    }

    private function validateProductRequest(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount_price' => 'numeric|nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }


    private function uploadImage($file)
    {
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move('product', $imageName);

        return $imageName;
    }





    public function viewProduct()
    {
        $this->checkAuthentication();

        $categories = Catagory::all();

        return view('admin.product', compact('categories'));
    }


    public function addProduct(Request $request)
    {
        $this->checkAuthentication();

        $this->validateProductRequest($request);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $product->image = $this->uploadImage($request->file('image'));
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }




    public function showProducts()
    {
        $this->checkAuthentication();

        $products = Product::all();

        return view('admin.show_product', compact('products'));
    }



    public function deleteProduct($id)
    {
        $this->checkAuthentication();

        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }



    public function updateProduct($id)
    {
        $this->checkAuthentication();

        $product = Product::find($id);
        $categories = Catagory::all();

        return view('admin.update_product', compact('product', 'categories'));
    }



    public function updateProductConfirm(Request $request, $id)
    {
        $this->checkAuthentication();

        $product = Product::find($id);
        $product->fill($request->only(['title', 'description', 'catagory', 'quantity', 'price', 'discount_price']));

        if ($request->hasFile('image')) {
            $product->image = $this->uploadImage($request->file('image'));
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }



}
