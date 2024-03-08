<?php


namespace App\Interfaces\Admin\Category;

interface CategoryRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);

    public function delete($id);
}
