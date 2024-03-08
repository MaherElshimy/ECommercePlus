<?php

namespace App\Repositories\Admin\Category;

use App\Interfaces\Admin\Category\CategoryRepositoryInterface;
use App\Models\Catagory;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Catagory::all();
    }

    public function create(array $data)
    {
        return Catagory::create($data);
    }

    public function find($id)
    {
        return Catagory::find($id);
    }

    public function delete($id)
    {
        $category = Catagory::find($id);
        if ($category) {
            $category->delete();
        }
    }
}

?>
