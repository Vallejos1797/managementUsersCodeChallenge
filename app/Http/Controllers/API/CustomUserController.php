<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomUserRequest;
use App\Http\Resources\CustomUserResource;
use App\Models\CustomUser;
use Illuminate\Http\Request;

class CustomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = CustomUser::orderByDesc('id');

        $search = $request->query('search');
        if ($search) {
            $query->where('user', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
        }

        $perPage = $request->query('per_page', 10);

        return CustomUserResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomUserRequest $request
     * @return CustomUserResource
     */
    public function store(CustomUserRequest $request)
    {
        $data = $request->validated();
        $customUser = CustomUser::create($data);
        $customUser->refresh();
        return CustomUserResource::make($customUser);
    }

    /**
     * Display the specified resource.
     *
     * @param CustomUser $customUser
     * @return CustomUserResource
     */
    public function show(CustomUser $customUser)
    {
        abort_if(!$customUser, 404);
        return CustomUserResource::make($customUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomUserRequest $request
     * @param CustomUser $customUser
     * @return CustomUserResource
     */
    public function update(CustomUserRequest $request, CustomUser $customUser)
    {
        try {
            $data = $request->validated();
            $customUser->update($data);
            return CustomUserResource::make($customUser);
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
        $customUser = CustomUser::findOrFail($id);
        $customUser->delete();
        return response()->json(['message' => 'Registro eliminado con éxito'], 200);
    }
}
