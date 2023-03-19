<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Receipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReceipeController extends Controller
{
    public function index()
    {
        $receipes = Receipe::all();
        return Inertia::render('Receipe/Index', [
            "receipes" => $receipes
        ]);
    }

    public function store(Request $request)
    {
        Receipe::create([
            "name" => $request->name,
            "ingredients" => $request->ingredients
        ]);
        Session::flash('message', 'Created successfully!');
        return redirect()->route('receipe');
    }
}
