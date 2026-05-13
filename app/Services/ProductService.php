<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store(array $data): Product
    {
        return Product::create($data);
    }

     public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product->fresh();
    }
}
 