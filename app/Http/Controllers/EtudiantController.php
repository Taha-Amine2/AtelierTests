<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::all();
        return response()->json(['etudiants' => $etudiants], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'niveau' => 'required',
        ]);

        $etudiant = new Etudiant();
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->adresse = $request->input('adresse');
        $etudiant->niveau = $request->input('niveau');
        $etudiant->save();

        return response()->json(['etudiant' => $etudiant], 201);
    }

    public function show($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return response()->json(['etudiant' => $etudiant], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'niveau' => 'required',
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->adresse = $request->input('adresse');
        $etudiant->niveau = $request->input('niveau');
        $etudiant->save();

        return response()->json(['etudiant' => $etudiant], 200);
    }

    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return response()->json(['message' => 'Etudiant supprimé avec succès.'], 204);
    }
}
