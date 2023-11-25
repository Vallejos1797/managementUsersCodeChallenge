<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Department::orderBy('id');

        $search = $request->query('search');
        if ($search) {
            $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }

        $perPage = $request->query('per_page', 10);
        if ($perPage == -1) {
            return DepartmentResource::collection($query->get());
        }
        return DepartmentResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return DepartmentResource
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        $department = Department::create($data);
        $department->refresh();
        return DepartmentResource::make($department);
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return DepartmentResource
     */
    public function show(Department $department)
    {
        abort_if(!$department, 404);
        return DepartmentResource::make($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return DepartmentResource
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $data = $request->validated();
            $department->update($data);
            return DepartmentResource::make($department);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el recurso.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json(['message' => 'Registro eliminado con éxito'], 200);
    }
}
