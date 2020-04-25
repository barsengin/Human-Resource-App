<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\createEmployeeFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $employees["data"] = Employee::get();
        $employees['deleted'] = "0";

        return view("employee.list", compact("employees"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('company_name','asc')->pluck('company_name', 'id');

        return view('employee.create', compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(createEmployeeFormRequest $request)
    {
        $employee = Employee::create($request->all());
        if($employee)
            return redirect()->route('employee.show', ['employee_id'=>$employee->id])
                ->with( 'info', 'Personel bilgileri güncellendi.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        $employee = Employee::find($employee_id);
        return view('employee.show', ['employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function edit($employee_id)
    {
        $employee = Employee::find($employee_id);
        $companies = Company::orderBy('company_name','asc')->pluck('company_name', 'id');

        return view('employee.update', [
            'employee'=>$employee,
            'companies'=>$companies
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function update($employee_id, createEmployeeFormRequest $request)
    {
        $employee = Employee::find($employee_id);
        $employee->fill($request->all());
        if($employee->save())
            return redirect()->route('employee.show', ['employee_id'=>$employee->id])
                ->with( 'info', 'Personel bilgileri güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        $employee = Employee::find($employee_id)->delete();

        if($employee)
            return redirect()->route('employee.index')
                ->with('success','Personel Silindi');

        return redirect()->route('employee.index')
            ->with('success','Hata Oluştu!!');
    }

    public function deleted_employee ()
    {
        $employees["data"] = Employee::onlyTrashed()->get();
        $employees['deleted'] = "1";

        return view("employee.list", compact("employees"));
    }
}
