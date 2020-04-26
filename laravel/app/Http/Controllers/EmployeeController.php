<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\createEmployeeFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     */
    public function deleted_employee ()
    {
        $employees["data"] = Employee::onlyTrashed()->get();
        $employees['deleted'] = "1";

        return view("employee.list", compact("employees"));
    }

    /**
     * Show the form for creating a new resource.
     * Personel oluşturma form sayfasına(employee/create.blade.php) yönlendirme yapılıyor
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Firma listesi isme göre A-Z'ye sıralanarak form sayfasına gönderiliyor.
        $companies = Company::orderBy('company_name','asc')->pluck('company_name', 'id');

        return view('employee.create', compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     * Personel oluşturma formundan gelen personel nesnesi oluşturuluyor
     * use App\Http\Requests\createEmployeeFormRequest namespace'deki form Request  sınıfları kullanılıyor(createEmployeeFormRequest)
     *
     * @return \Illuminate\Http\Response
     */
    public function store(createEmployeeFormRequest $request)
    {
        $request['created_username'] = Auth::user()->name;
        $employee = Employee::create($request->all());

        if($employee)

            return redirect()->route('employee.show', ['employee_id'=>$employee->id])
                ->with('info', 'Yeni Personel Eklendi.');
    }

    /**
     * Display the specified resource.
     * İlgili personelin profil sayfasına yönlendirelim($employee_id değişkeni zorunludur)
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        $employee = Employee::find($employee_id);
        if($employee)
            return view('employee.show', ['employee'=>$employee]);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     * Personel düzenleme form sayfasına(employee/update.blade.php) yönlendirme yapılır.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function edit($employee_id)
    {
        $employee = Employee::find($employee_id);

        //Firma seçimi için aktif firma listesi getiriliyor ve diziye aktarılıyor.
        $companies = Company::orderBy('company_name','asc')->pluck('company_name', 'id');

        if($employee)
            return view('employee.update', [
                        'employee'=>$employee,
                        'companies'=>$companies
                        ]);
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     * Personel düzenleme sayfasından(employee/update.blade.php) gelen form verilerine göre firma bilgfileri güncellenir
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function update($employee_id, createEmployeeFormRequest $request)
    {
        $employee = Employee::find($employee_id);

        if($employee){
            $request['updated_username'] = Auth::user()->name;
            $employee->fill($request->all());

            if($employee->save())
                return redirect()->route('employee.show', ['employee_id'=>$employee->id])
                    ->with( 'info', 'Personel bilgileri güncellendi.');
        }else
            abort(404);

    }

    /**
     * Remove the specified resource from storage.
     * Personel silme işlemi gerçekleştiriliyor
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        $employee = Employee::find($employee_id);

        if ($employee) {

            $employee['deleted_username'] = Auth::user()->name;
            $employee->fill($employee->toArray());
            $employee->save();

            $info['success'] =  $employee->id.' id numaralı '.$employee->employe_first_name.' '.$employee->employe_last_name.'  başarılı bir şekilde silindi.';
            $info['error'] =  $employee->id.' id numaralı '.$employee->employe_first_name.' '.$employee->employe_last_name.' silinemedi.';
            if($employee->delete())
                return redirect()->route('employee.index')->with('info', info['success']);

            return redirect()->route('employee.index')->with('info', info['error']);
        } else
            abort(404);
    }
}
