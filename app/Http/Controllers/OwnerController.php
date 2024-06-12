<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{
    // Récupérer tous les propriétaires
    public function index()
    {
        $owners = Owner::all();
        return response()->json($owners);
    }

    // Créer un nouveau propriétaire
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:owners,email',
            'phone' => 'nullable'
        ]);

        $owner = Owner::create($request->all());
        return response()->json($owner, 201);
    }

    // Afficher un propriétaire spécifique
    public function show($id)
    {
        $owner = Owner::findOrFail($id);
        return response()->json($owner);
    }

    // Mettre à jour un propriétaire
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:owners,email,' . $id,
            'phone' => 'nullable'
        ]);

        $owner = Owner::findOrFail($id);
        $owner->update($request->all());
        return response()->json($owner, 200);
    }

    // Supprimer un propriétaire
    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();
        return response()->json(null, 204);
    }
}
