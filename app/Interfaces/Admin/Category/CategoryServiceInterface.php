<?php

namespace App\Interfaces\Admin\Category;

interface CategoryServiceInterface
{
    public function getAllCategories();

    public function addCategory(array $data);

    public function deleteCategory($id);
}


?>
