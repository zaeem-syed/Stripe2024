<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\Petitionresource;
use App\Models\Petition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //  return Petitionresource::collection(Petition::all());
        // return new PetitionCollection(Petition::all());
        return response()->json(['status' => 200,
         'data' => new PetitionCollection(Petition::all())
    ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $petition=Petition::create($request->only([
            'title','description','category','signee','author'
        ]));

        return new Petitionresource($petition);

    }

    /**
     * Display the specified resource.
     */
    public function show(Petition $petition)
    {
        //
        return new Petitionresource($petition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Petition $petition)
    {
        //
        $petition->update($request->only([
            'author','title','signee','category','description'
        ]));

        return new Petitionresource($petition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Petition $petition)
    {
        //
        $petition->delete();
        return response()->json([
            'status' => 204,
            'data' => null
        ]);
    }
}
