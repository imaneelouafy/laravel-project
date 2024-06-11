<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appartement;

class AppartementController extends Controller
{

    public function index()
    {
        return Appartement::with('block')->get();
    }

    public function store(Request $request)
    {
        return Appartement::create($request->all());
    }
    public function show($id)
    {
        return Appartement::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $appartement = Appartement::findOrFail($id);
        $appartement->update($request->all());
        return $appartement;
    }

    public function destroy($id)
    {
        return Appartement::destroy($id);
    }
}
