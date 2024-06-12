<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::first(); // Assuming you want to fetch the first company
        return response()->json($company); // Return the company data as JSON
    }

    
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $company = Company::first(); // Assuming there's only one company record to update
        if ($company) {
            $company->update($data);
        } else {
            $company = Company::create($data);
        }

        return response()->json($company);
    }
}
