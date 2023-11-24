<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomUsersRequest;
use App\Http\Resources\CustomUsersResource;
use App\Models\CustomUsers;
use Illuminate\Http\Request;

class CustomUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = CustomUsers::orderByDesc('id');
        $search = $request->query('search');
        if ($search) {
            $query->where('user', 'like', "%{$search}%");
        }
        $perPage = $request->query('per_page', 1);
        return CustomUsersResource::collection($query->paginate($perPage));  //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CustomUsersResource
     */
    public function store(CustomUsersRequest $request)
    {
        $data = $request->validated();
        $customUsers = CustomUsers::create($data);
        $customUsers->refresh();
        return CustomUsersResource::make($customUsers);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomUsers $customUsers
     */
    public function show(CustomUsers $customUser)
    {
        abort_if(!$customUser, 404); // Devolver un error 404 si el modelo no existe
        return CustomUsersResource::make($customUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomUsers $customUsers
     * @return CustomUsersResource
     */
    public function update(CustomUsersRequest $request, CustomUsers $customUser)
    {
        try {
            // Validar la solicitud
            $data = $request->validated();

            // Actualizar el modelo con los datos validados
            $customUser->update($data);

            // Devolver la respuesta con el recurso actualizado
            return CustomUsersResource::make($customUser);
        } catch (\Exception $e) {
            // Manejar el error de actualización
            return response()->json(['message' => 'Error al actualizar el recurso.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CustomUsers $customUsers
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
       $customUser = CustomUsers::findOrFail($id);
        $customUser->delete();
       return response()->json(['message' => 'Registro eliminado con éxito'], 200);
    }

    public function restore($id)
    {
        $customUser = CustomUsers::withTrashed()->findOrFail($id);
        $customUser->restore();
        return response()->json(['message' => 'Registro restaurado con éxito'], 200);
    }
    public function updateField($id, Request $request)
    {
        $customUser = CustomUsers::findOrFail($id);
        $request->validate([
            'nombre_del_campo' => 'required', // Ajusta el nombre del campo y las reglas de validación según tu necesidad
        ]);

        $customUser->nombre_del_campo = $request->input('nombre_del_campo');
        $customUser->save();
        return response()->json(['message' => 'Campo actualizado con éxito'], 200);
    }

}
