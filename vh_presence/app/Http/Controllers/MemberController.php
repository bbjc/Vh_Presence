<?php

namespace App\Http\Controllers;
use App\Models\Members;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Afficher une liste des membres
    public function index()
    {
        $membres = Members::all();
        return view('dashboard')->with('membres', $membres);
    }
    public function create()
    {
        return view('createmember');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:Masculin,Feminin',
            'numero' => 'required|string|max:10',
            'date_anniversaire' => 'required|date',
        ]);

        Members::create($validatedData);

        return redirect()->route('members.index')->with('success', 'Membre ajouté avec succès.');
    }
    public function edit($id)
    {
        $member = Members::findOrFail($id);
        return view('editmember', compact('member'));
    }
    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:Masculin,Feminin',
            'numero' => 'required|string|max:10',
            'date_anniversaire' => 'required|date',
        ]);

        // Mettre à jour le membre
        $member = Members::findOrFail($id);
        $member->update($validatedData);

        // Redirection avec un message flash 'success'
        return redirect()->route('members.index')->with('success', 'Membre modifié avec succès.');
    }
    public function destroy($id)
    {
        $member = Members::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Membre supprimé avec succès.');
    }

}
