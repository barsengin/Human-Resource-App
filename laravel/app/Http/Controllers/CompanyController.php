<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\createCompanyFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index(){

        $companies["data"] = Company::get();
        $companies['deleted'] = "0";

        return view('company.list',compact('companies'));
    }

    public function deleted_company(){

        $companies['data'] = Company::onlyTrashed()->get();
        $companies['deleted'] = "1";

        return view('company.list',compact('companies'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(createCompanyFormRequest $request)
    {
        if($request->company_logo_file) {
            $request['company_logo']  = Storage::disk("uploads")->putFile("logo", $request->company_logo_file);
        }
        $company = Company::create($request->all());
        if($company)
            return redirect()->route('company.show',['company_id'=>$company->id])
                ->with( 'info', 'Yeni firma oluşturuldu.');

        return redirect()->route('company.create')->compact(["success"=>"Firma Eklenemedi"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function show($company_id)
    {
        $company = Company::find($company_id);
        return view('company.show', ['company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id)
    {
        $company = Company::find($company_id);
        return view('company.edit', ['company'=>$company]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function update($company_id, createCompanyFormRequest $request)
    {
        $company = Company::find($company_id);
        $company->fill($request->all());
       if($company->save())
            return redirect()->route('company.show', ['company_id'=>$company_id])
                ->with( 'info', 'Firma bilgileri güncellendi.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id)
    {
        $company = Company::find($company_id)->delete();
        if($company)
            return redirect()->route('company.index');

        return redirect()->route('company.index')->with('success','Hata Oluştu!!');
    }
}
