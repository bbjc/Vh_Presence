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

     // Enregistrer un nouvel événement
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required',
             'description' => 'required',
             'event_date' => 'required|date',
         ]);
 
         Members::create($request->all());
 
         return redirect()->route('dashboard')
                          ->with('success', 'Membre Ajouté avec succes.');
     }
 
}
