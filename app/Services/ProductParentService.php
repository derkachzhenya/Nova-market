<?php

namespace App\Services;

use App\Models\ProductParent;

class ProductParentService
{
  public function store(array $data): ProductParent
    {
        return ProductParent::create($data);
    }

     public function update(ProductParent $productParent, array $data): ProductParent
    {
        $productParent->update($data);
        return $productParent->fresh();
    } 
}
