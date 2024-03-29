<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
// use Illuminate\Http\Response; // Esto seria sin inertia
use Inertia\Inertia; // Inertia
use Inertia\Response; // Response de Inertia

use Illuminate\Http\RedirectResponse; // Redireccionar la Response
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Gate;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),  
        ]); 
        //latest() muestra el ultimo en crearse
        // Para produccion hay que paginar!
        // (Chirps/Index, []); // Chirps/Index: Renderiza el jsx Index.jsx de la carpeta Chirps. El root es Pages/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validate = $request->validate([
            'message' => "required|string|max:255"
        ]);

        $request->user()->chirps()->create($validate);

        return redirect(route("chirps.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp) : RedirectResponse
    {
        Gate::authorize('update', $chirp);

        $validated = $request -> validate([
            'message' => 'required|string|max:255'
        ]);

        $chirp -> update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp) : RedirectResponse
    { 
        Gate::authorize('delete', $chirp);

        $chirp -> delete();

        return redirect(route('chirps.index'));
    }
}
