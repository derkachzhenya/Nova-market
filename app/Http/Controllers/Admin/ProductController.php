<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::query()
            ->latest()
            ->paginate(20);
        return Inertia::render(
            'Admin/Product/Index',
            ['products' => ProductResource::collection($products)]
        );
    }



    public function create()
    {
        return Inertia::render('Admin/Product/Create');
    }



    public function store(StoreRequest $request, ProductService $productService)
    {
        $data = $request->validated();
        $product = $productService->store($data);
        return ProductResource::make($product);
    }



    public function show(Product $product)
    {
        return Inertia::render('Admin/Product/Show', [
            'product' => ProductResource::make($product)
        ]);
    }



    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', [
            'product' => ProductResource::make($product)
        ]);
    }



    public function update(UpdateRequest $request, Product $product, ProductService $productService)
    {
        $data = $request->validated();
        $product = $productService->update($product, $data);
        return ProductResource::make($product);
    }



    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
