<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Param\StoreRequest;
use App\Http\Requests\Admin\Param\UpdateRequest;
use App\Http\Resources\Param\ParamResource;
use App\Models\Param;
use App\Services\ParamService;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ParamController extends Controller
{
     public function index()
    {
        $params = Param::query()
            ->latest()
            ->paginate(20);
        return Inertia::render(
            'Admin/Param/Index',
            ['params' => ParamResource::collection($params)]
        );
    }



    public function create()
    {
        return Inertia::render('Admin/Param/Create');
    }



    public function store(StoreRequest $request, ParamService $paramService)
    {
        $data = $request->validated();
        $param = $paramService->store($data);
        return ParamResource::make($param);

    }

    public function show(Param $param)
    {
        return Inertia::render('Admin/Param/Show', [
            'param' => ParamResource::make($param)
        ]);
    }



    public function edit(Param $param)
    {
        return Inertia::render('Admin/Param/Edit', [
            'param' => ParamResource::make($param)
        ]);
    }



    public function update(UpdateRequest $request, Param $param, ParamService $paramService)
    {
        $data = $request->validated();
        $param = $paramService->update($param, $data);
        return ParamResource::make($param);
    }



    public function destroy(Param $param)
    {
        $param->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
