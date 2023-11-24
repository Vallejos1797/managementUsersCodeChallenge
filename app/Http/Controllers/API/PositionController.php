<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Position::orderByDesc('id');

        $search = $request->query('search');
        if ($search) {
            $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }

        $perPage = $request->query('per_page', 10);

        return PositionResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PositionRequest $request
     * @return PositionResource
     */
    public function store(PositionRequest $request)
    {
        $data = $request->validated();
        $position = Position::create($data);
        $position->refresh();
        return PositionResource::make($position);
    }

    /**
     * Display the specified resource.
     *
     * @param Position $position
     * @return PositionResource
     */
    public function show(Position $position)
    {
        abort_if(!$position, 404);
        return PositionResource::make($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PositionRequest $request
     * @param Position $position
     * @return PositionResource
     */
    public function update(PositionRequest $request, Position $position)
    {
        try {
            $data = $request->validated();
            $position->update($data);
            return PositionResource::make($position);
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
        $position = Position::findOrFail($id);
        $position->delete();
        return response()->json(['message' => 'Registro eliminado con éxito'], 200);
    }
}
