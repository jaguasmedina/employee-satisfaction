<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Person::with('company');  

        if ($request->has('search')  && !empty($request->search)) {
            $query->where('nombre_completo', 'like', '%' . $request->search . '%')
                ->orWhere('correo', 'like', '%' . $request->search . '%')
                ->orWhere('area', 'like', '%' . $request->search . '%')
                ->orWhere('categoria', 'like', '%' . $request->search . '%')
                ->orWhereHas('company', function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->has('sortBy') && !empty($request->sortBy) && $request->has('sortOrder')) {
            $sortBy = $request->sortBy;
            $sortOrder = $request->sortOrder;

            if (in_array($sortBy, ['nivel_de_satisfaccion', 'categoria'])) {
                $query->orderBy($sortBy, $sortOrder);
            } else {
                $query->join('companies', 'people.company_id', '=', 'companies.id')
                    ->orderBy($sortBy, $sortOrder);
            }
        }

        return response()->json($query->paginate(5));

    }

    public function show($id)
    {
        $person = Person::with('company')->findOrFail($id);
        return response()->json($person);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'correo' => 'required|email|unique:people,correo',
            'area' => 'required|string|max:255',
            'categoria' => 'required|in:Empleado,Directivo,Contratista',
            'company_id' => 'required|exists:companies,id', 
            'nivel_de_satisfaccion' => 'required|integer|between:0,100',
        ]);

        $person = Person::create($validatedData);
        return response()->json($person, 201);
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $validatedData = $request->validate([
            'nombre_completo' => 'sometimes|required|string|max:255',
            'fecha' => 'sometimes|required|date',
            'correo' => 'sometimes|required|email|unique:people,correo,' . $person->id,
            'area' => 'sometimes|required|string|max:255',
            'categoria' => 'sometimes|required|in:Empleado,Directivo,Contratista',
            'company_id' => 'sometimes|required|exists:companies,id', // Validar que el company_id existe en la tabla companies
            'nivel_de_satisfaccion' => 'sometimes|required|integer|between:0,100',
        ]);

        $person->update($validatedData);
        return response()->json($person);
    }

    public function destroy($id)
    {
        Person::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = Person::with('company');

        if ($request->has('nombre_completo')) {
            $query->where('nombre_completo', 'like', '%' . $request->nombre_completo . '%');
        }

        if ($request->has('empresa')) {
            $query->whereHas('company', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->empresa . '%');
            });
        }

        if ($request->has('categoria')) {
            $query->where('categoria', 'like', '%' . $request->categoria . '%');
        }

        return response()->json($query->get());
    }

    public function toggleFavorite($id)
    {
        $person = Person::findOrFail($id);
        $person->is_favorite = !$person->is_favorite;
        $person->save();

        return response()->json($person);
    }
    public function favoriteList(Request $request)
{
    $query = Person::with('company')->where('is_favorite', true);  

    
    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('nombre_completo', 'like', '%' . $searchTerm . '%')
              ->orWhere('categoria', 'like', '%' . $searchTerm . '%')
              ->orWhereHas('company', function($q) use ($searchTerm) {
                  $q->where('name', 'like', '%' . $searchTerm . '%');
              });
        });
    }
    $favorites = $query->get();
    return response()->json($favorites);
}
}
