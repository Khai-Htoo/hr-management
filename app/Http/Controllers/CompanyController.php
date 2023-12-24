<?php

namespace App\Http\Controllers;

use App\Models\CompanyData;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function show(string $id)
    {
        $company = CompanyData::where('id', $id)->first();
        return view('admin.company.index', compact('company'));
    }


    public function edit(string $id)
    {
        $company = CompanyData::where('id', $id)->first();
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'company_name' => 'required',
            'company_email' => 'required',
            'company_phone' => 'required',
            'company_address' => 'required',
            'contact_person' => 'required',
            'office_start_time' => 'required',
            'office_end_time' => 'required',
            'break_start_time' => 'required',
            'break_end_time' => 'required',
        ]);
        CompanyData::where('id', $id)->update($request->only('company_name',
            'company_email',
            'company_phone',
            'company_address',
            'contact_person',
            'office_start_time',
            'office_end_time',
            'break_start_time',
            'break_end_time', ));

            return back()->with(['success'=>'Company Setting Updated']);
    }

}
