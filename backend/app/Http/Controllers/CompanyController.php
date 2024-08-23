<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        return response()->json(Company::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|url',
        ]);

        $company = Company::create($validatedData);
        return response()->json($company, 201);
    }

    public function update(Request $request, $id)
    {
        dump("llamado"); 
        $company = Company::findOrFail($id);
        dump($company); 
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'logo_url' => 'sometimes|required|url',
        ]);
        dump($validatedData); 
        $company->update($validatedData);
        return response()->json([
            'message' => 'Compañía actualizada con éxito',
            'company' => $company
        ], 200);
    }

    public function destroy($id)
    {
        Company::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Compañía eliminada con éxito',
            'company_id' => $id
        ], 200);
    }
}
