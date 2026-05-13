<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductParent\StoreRequest;
use App\Http\Requests\Admin\ProductParent\UpdateRequest;
use App\Http\Resources\ProductParent\ProductParentResource;
use App\Models\ProductParent;
use App\Services\ProductParentService;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;


class ProductParentController extends Controller
{
    public function index()
    {
        $productParents = ProductParent::query()
            ->latest()
            ->paginate(20);
        return Inertia::render(
            'Admin/ProductParent/Index',
            ['productParents' => ProductParentResource::collection($productParents)]
        );
    }



    public function create()
    {
        return Inertia::render('Admin/ProductParent/Create');
    }



    public function store(StoreRequest $request, ProductParentService $productParentService)
    {
        $data = $request->validated();
        $productParent = $productParentService->store($data);
        return ProductParentResource::make($productParent);
    }



    public function show(ProductParent $productParent)
    {
        return Inertia::render('Admin/ProductParent/Show', [
            'productParent' => ProductParentResource::make($productParent)
        ]);
    }



    public function edit(ProductParent $productParent)
    {
        return Inertia::render('Admin/ProductParent/Edit', [
            'productParent' => ProductParentResource::make($productParent)
        ]);
    }



    public function update(UpdateRequest $request, ProductParent $productParent, ProductParentService $productParentService)
    {
        $data = $request->validated();
        $productParent = $productParentService->update($productParent, $data);
        return ProductParentResource::make($productParent);
    }



    public function destroy(ProductParent $productParent)
    {
        $productParent->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
