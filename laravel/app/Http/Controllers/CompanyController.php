<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\createCompanyFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Aktif tüm firmalar listesine(company/list.blade.php) yönledirme yapılıyor.
     *
     */
    public function index(){
        //Aynı blade.php dosyasında hem silinenler hem de aktif firmalar listelebneceği için company nesnesine deleted özelliği eklendi.
        //company['deleted'] = 1 ise silenen firmalar listelenecek
        $companies['data'] = Company::get();
        $companies["deleted"] = "0";

        return view('company.list',compact('companies'));
    }

    /**
     * Silinen tüm firmalar listesine(company/list.blade.php) yönledirme yapılıyor.
     * onlyTrashed() methodu silinen yani deleted_at alanı dolu olan kayıtları listeler.
     *
     */
    public function deleted_company(){

        $companies['data'] = Company::onlyTrashed()->get();
        $companies['deleted'] = "1";

        return view('company.list',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     * Firma oluşturma form sayfasına(company/create.blade.php) yönlendirme yapılıyor
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     * Firma oluşturma formundan gelen firma nesnesi oluşturuluyor
     * use App\Http\Requests\createCompanyFormRequest namespace'deki form Request  sınıfları kullanılıyor(createCompanyFormRequest)
     *
     * @return \Illuminate\Http\Response
     */
    public function store(createCompanyFormRequest $request)
    {
        //Eğer dosya seçilmiş ise yükleneceği alan Storage  nesnesi ile blirleniyor. (Storage nesnesi için config/filesystems.php sayfası 58.satırdan itibaren incelenmelidir)
        if($request->company_logo_file) {
            $request['company_logo']  = Storage::disk("uploads")->putFile("logo", $request->company_logo_file);
        }

        $request['created_username'] = Auth::user()->name;
        // FormRequest kurallarına uygun ise artık veritabanına kayıt işlemlerini gerçekleştirebiliriz
        $company = Company::create($request->all());

        //Bilgiler başarı ile kaydedildiyse(firma profil sayfasına yönlendirelim)
        if($company)
            return redirect()->route('company.show',['company_id'=>$company->id])
                ->with( 'info', 'Yeni firma oluşturuldu.');

        return redirect()->route('company.create')->compact(["success"=>"Firma Eklenemedi"]);
    }

    /**
     * Display the specified resource.
     * İlgili firmanın profil sayfasına yönlendirelim(company_id değişkeni zorunludur)
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function show($company_id)
    {
        //Aktif kayıtlar arsında firmayı aratalım varsa profil(/company/show.blade.php) sayfasına yönlendirelim (company_id değişkeni zorunludur)
        $company = Company::find($company_id);

        if($company)
            return view('company.show', ['company'=>$company]);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     * Firma id'si(company_id) mevcut  ise; firma düzenlenme(company/edit.blade.php) sayfasına yönlendirme yapalım.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id)
    {
        $company = Company::find($company_id);

        if($company)
            return view('company.edit', ['company'=>$company]);
        else
            abort(404);
    }
    /**
     * Update the specified resource in storage.
     *Form düzenleme sayfasından(company/edit.blade.php) gelen form verilerine göre firma bilgileri güncellenir
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function update($company_id, Request $request)
    {
        //firma id ve gelen form verilerinin doğruluğu kontrol edilip güncelleme işlemi tamamlanır
        $company = Company::find($company_id);
        if($company) {

            if ($request->company_logo_file) {
                $request['company_logo'] = Storage::disk("uploads")->putFile("logo", $request->company_logo_file);
            }
            $request['updated_username'] = Auth::user()->name;
            $company->fill($request->all());

            if ($company->save())
                return redirect()->route('company.show', ['company_id' => $company_id])
                    ->with('info', 'Firma bilgileri güncellendi.');
        }  else
            abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *İlgili firmayı silme işlemi için kullanılır
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id)
    {

        $company = Company::find($company_id);

        if ($company) {

            $company['deleted_username'] = Auth::user()->name;

            $company->fill($company->toArray());
            $company->save();

            $info['success'] =  $company->id.' id numaralı '.$company->company_name.'  başarılı bir şekilde silindi.';
            $info['error'] =  $company->id.' id numaralı '.$company->company_name.' silinemedi.';

            if($company->delete())
                return redirect()->route('company.index')->with('info', $info['success']);

            return redirect()->route('company.index')->with('info', info['error']);
        }  else
            abort(404);
    }
}
