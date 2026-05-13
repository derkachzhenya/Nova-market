<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function store(array $data): Category
    {
        return Category::create($data);
    }

     public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category->fresh();
    }
}
