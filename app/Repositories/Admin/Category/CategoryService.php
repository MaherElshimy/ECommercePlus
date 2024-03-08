<?php

namespace App\Repositories\Admin\Category;

use App\Interfaces\Admin\Category\CategoryRepositoryInterface;
use App\Interfaces\Admin\Category\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }

    public function addCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }
}

?>
