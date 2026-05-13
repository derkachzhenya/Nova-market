<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->latest()
            ->paginate(20);
        return Inertia::render(
            'Admin/Category/Index',
            ['categories' => CategoryResource::collection($categories)]
        );
    }



    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }



    public function store(StoreRequest $request, CategoryService $categoryService)
    {
        $data = $request->validated();
        $category = $categoryService->store($data);
        return CategoryResource::make($category);
    }



    public function show(Category $category)
    {
        return Inertia::render('Admin/Category/Show', [
            'category' => CategoryResource::make($category)
        ]);
    }



    public function edit(Category $category)
    {
        return Inertia::render('Admin/Category/Edit', [
            'category' => CategoryResource::make($category)
        ]);
    }



    public function update(UpdateRequest $request, Category $category, CategoryService $categoryService)
    {
        $data = $request->validated();
        $category = $categoryService->update($category, $data);
        return CategoryResource::make($category);
    }



    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
