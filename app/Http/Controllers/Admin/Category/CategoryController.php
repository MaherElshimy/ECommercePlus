<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

use App\Models\Catagory;

class CategoryController extends Controller
{
    private function checkAuthentication()
    {
        if (!Auth::id()) {
            return redirect('login');
        }
    }


    public function viewCategory()
    {
        $this->checkAuthentication();

        $categories = Catagory::all();

        return view('admin.category', compact('categories'));
    }


    public function addCategory(Request $request)
    {
        $this->checkAuthentication();

        $category = new Catagory;
        $category->catagory_name = $request->categoryName;
        $category->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function deleteCategory($id)
    {
        $this->checkAuthentication();

        $category = Catagory::find($id);
        $category->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

}
