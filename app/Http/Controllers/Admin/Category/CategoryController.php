<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Admin\Category\CategoryServiceInterface;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    private function checkAuthentication()
    {
        if (!auth()->check()) {
            return redirect('login');
        }
    }

    public function viewCategory()
    {
        $this->checkAuthentication();

        $categories = $this->categoryService->getAllCategories();

        return view('admin.category', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $this->checkAuthentication();

        $data = [
            'catagory_name' => $request->categoryName,
        ];

        $this->categoryService->addCategory($data);

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function deleteCategory($id)
    {
        $this->checkAuthentication();

        $this->categoryService->deleteCategory($id);

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
}

?>
