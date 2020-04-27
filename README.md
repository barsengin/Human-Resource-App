İNSAN KAYNAKLARI YÖNETİM UYGULAMASI
================

Hakkında
-----
Şirket ve çalışanlarının yönetimini sağlayan insan kaynakları uygulaması. 

#### Uygulama ekran görünümleri

![Firma Listeleme](images/companies.png)

![Firma Özet Formu](images/company_show.PNG)

![Personel Ekleme Formu](images/employee_create.PNG)

Ugulama geliştirilirken kullanılan teknolojiler:
---
______

```bash
PHP (7.4.3)
Laravel (7.6.2)
Bootstrap
PhpStorm (2019.3)
Mysql
```

Kurulumlar
-------

Composer 

### Composer

Composer kurulumu gerçekleştirilmelidir. Detaylı bilgi için (https://laravel.com/docs/7.x/installation)

```bash
composer install
```
#### Düzenlemeler
Ana dizinde bulunan `storage` ve `bootstrap/cache` klasörlerinin yazma izni kontrolü yapılmadır, yazma izni yoksa yazma izni verilmelidir.

```bash
php artisan key:generate
```
komutu ile uygulama anahtarı oluşturulmalıdır. Bu anahtar session ve diğer şifrelenmiş verilerin güvenliğinde kullanılacaktır.
Ana dizinde `.env` dosyası olup olmadığı kontrolü yapılmadır. Bu dosya composer ile kurulumda yada
```bash
php artisan key:generate
```
komutuyla otomatik olarak oluşmalıdır. Eğer yoksa `.env.example` dosyasının adı `.env` yapılıp ya da kopyalanıp, 
```bash
php artisan key:generate
```
komutu tekrar çalıştırılmalıdır.
Şu an terminalden 
```bash
php artisan serve
```
komutu çalıştırıldığında login sayfasına yönlendirilmiş olacağız.

#### Database Ayarları
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
Smtp Mail Gönderme, Şifre sıfırlama işlemleri için yine `.env` dosyasında laravel mail yapılandırması
```bash
MAIL_MAILER=smtp
MAIL_DRIVER=stmp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="mail_adresi"
MAIL_PASSWORD="mail_kullanıcı_adı"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="mail_adresi"
MAIL_FROM_NAME="${APP_NAME}"
```
doğrultusunda gerçekleştirilmelidir. Şifre sıfırlama için mail sağlayıcısı gerekmektedir. Örnek olarak gmail hesap bilgileri girilmiştir. Eğer farklı bir mail sunucusu kullanılacaksa ilgili sunucu bilgileri yukarıdaki gibi düzenlenmelidir

Projede yer alana migration dosyalarındaki veritabanı tablolarının oluşturulması için
```bash
php artisan migrate --seed
```
komutu kullanılır. Bu komut ile, migration kullanılarak oluşturulan tablolar veri tabanına dahil edilir. 
`--seed` ifadesi için lütfen Seeder Kullanımı bölümünü inceleyiniz.
```bash
php artisan migrate
```
komutu ise sadece tabloları oluşturur. Dolayısıyla sisteme erişim sağlayacak kullanıcı tanımlaması yapılmaz. Veri tabanındaki `user` tablosuna manuel olarak email ve şifre bilgileri girilerek login işlemi yapılabilir.

Login işlemi için kullanıcı bilgileri:
`Email: admim@dmin.com` 
`Şifre:password`

Veri tabanı bağlantıları tamamlandı.
```bash
php artisan serve
```
komutu ile  proje çalıştırıldığında `http://127.0.0.1:8000/login` login sayfasında yukarıdaki e-mail ve şifre bilgileri  ile uygulamaya erişim sağlanabilir.

![Giriş Ekranı](images/login.PNG)

Uygulama Detayları
-------

#### Model Yapısı
Model yapısı hakkında detaylı bilgi için (https://laravel.com/docs/eloquent) incelenmelidir
Uygulama genelinde `Company` ve `Employee` olmak üzere 2 model tanımlanmıştır.
Model oluşturmak için 
```bash
1-) php artisan make:model Models/Company
```
ya da
```bash
2-) php artisan make:model Models/Company -mcr
```
komutları ile `Models/` klasörü altında oluşturulur.Models klasörü yazılmayadabilir, düzenli görünüm için model dosyalarının toplu halde olması faydalı olabilir. 2. komut ile oluşturulacak modele ait controller(`app/Http/Controllers/CompanyController.php`) ve migration (`app\laravel\database\migrations\2020_04_25_234236_create_companies_table.php`) dosyaları da oluşturulmuş olur.

```bash
php artisan make:model Models/Employee -mcr
```
komutu ile `Employee` modeli ve modele ait controller(`app/Http/Controllers/EmployeeController.php`) ve migration (`app\laravel\database\migrations\2020_04_25_234236_create_employees_table.php`) dosyaları da oluşturulmuş olur.

`2020_04_25_234236_create_employees_table.php`
```bash
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments("id");
            $table->string('company_name');
            $table->string('company_address')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
```
`2020_04_25_234236_create_companies_table.php`
```bash
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments("id");
            $table->string('employee_first_name');
            $table->string('employee_last_name');
            $table->string('employee_email')->nullable();
            $table->string('employee_phone');
            $table->integer('company_id')->unsigned()->nullable();;
            $table->foreign('company_id')->nullable()->references('id')->on('companies');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
```

Her iki modele ait `migration` dosyaları yukarıdaki gibi düzenlenebilir. 

Company (Firma) ve Employee (Personel) modeline ait database tablolarının oluşturulması:
---
`2020_04_25_234236_create_companies_table.php` ve `2020_04_25_234236_create_employees_table.php` dosyalarındaki `up()`  fonksiyonunda tablo alanları ve özellikleri belirlenir. İsteğe göre değiştirilebilir.

```bash
php artisan migrate
```

komutu ile  veri tabanı tabloları oluşturulmuş olur. Migration dosyalarında herhangi bir değişiklik yaptıktan sonra
```bas
php artisan migrate:refresh
```
komutu ile değişiklikler tablolara kaydedilebilir

Örnek Company Model:

#### Controller

Controller hakkında detaylı bilgi için (https://laravel.com/docs/controllers)
model oluştururken ilgili controller da oluştuğu için default olarak index, create, update, edit, destroy, show, store fonksiyonları gelir. Olmaması durumunda manuel de eklenebilir. Aşağıda örnek olarak CompanyController gösterilmiştir. EmployeeController da benzer şekilde oluşmaktadır.

`CompanyController.php`
```bash
<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\createCompanyFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(createCompanyFormRequest $request)
    {
        //Eğer dosya seçilmiş ise yükleneceği alan Storage  nesnesi ile blirleniyor. (Storage nesnesi için config/filesystems.php sayfası 58.satırdan itibaren incelenmelidir)
        if($request->company_logo_file) {
            $request['company_logo']  = Storage::disk("uploads")->putFile("logo", $request->company_logo_file);
        }

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
    public function update($company_id, createCompanyFormRequest $request)
    {
        //firma id ve gelen form verilerinin doğruluğu kontrol edilip güncelleme işlemi tamamlanır
        $company = Company::find($company_id);
        $company->fill($request->all());

       if($company->save())
            return redirect()->route('company.show', ['company_id'=>$company_id])
                ->with( 'info', 'Firma bilgileri güncellendi.');
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

        $info['succes'] =  $company->company_name.' id numaralı firma başarılı bir şekilde silindi.';
        $info['error'] =  $company->company_name.' id numaralı firma silinemedi.';

        if($company->delete())
            return redirect()->route('company.index')->with('info', $info['succes']);

        return redirect()->route('company.index')->with('info', info['error']);
    }
}
```

#### Migration
Migration hakkında detaylı bilgi için (https://laravel.com/docs/migrations) kontrol edilmelidir.

#### Blade
Blade hakkında detaylı bilgi için (https://laravel.com/docs/blade) kontrol edilmelidir.

#### Form Request
Formlarda kullanılan telefon numarası vb. alanların doğruluğunun kontrolü için kullanılabilmektedir. Uygulamamız içeriisnde firma ve personel ekleme ve düzenleme işlemleri için form kullanılmaktadır. Form alanlarını kontrolünü sağlamak amacıyla  Form Request yapısı kullanılabilir. Detaylı bilgi için (https://laravel.com/docs/validation) kontrol edilmelidir. Yeni frima oluşturma ve düzenleme formları için
```bash
php artisan make:request createCompanyFormRequest
```
komutu ile  `createCompanyFormRequest` tanumlanır. Aynı işlem EmployeController için de gerçekleştirilebilir. 

`createCompanyFormRequest.php`

![Firma Ekleme Formu](images/company_create.PNG)

```bash
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

class createCompanyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Firma ekleme ve güncelleme işlemleri için kullanılacak formlardaki alanlar için kurallar belirleniyor
     *
     * @return array
     */
    public function rules()
    {
        $rules['company_name'] = ['required'];
        $rules['company_logo_file'] = ['image','dimensions:min_height=100, min_width=100'];
        $rules['company_phone'] = ['min:9', 'max:11'];
        return $rules;
    }
    /**
     * Firma ekleme ve güncelleme işlemlerinde uyarı mesajları için her alanın adı değiştiriliyor
     * Örneğin company_name alanı giril mediği zaman: rules() fonksiyonu ile zorunlu olduğu belirtilen company_name alanı için eğer messages()fonksiyonumuz tanımlı değilse, Firma Adı bilgisi zorunludur şeklinde bir uyarı gelir
     */
    public function attributes()
    {
        return [
            'company_name' => "Firma Adı",
            'company_phone' => "Firma Telefonu",
            'company_logo' => "Logo"
        ];
    }
    /**
     * rules() fonksiyonundaki her bir kurala göre özel mesaj eklemek için kullanılır
     * Örneğin company_logo alanı .pdf formatında dosya yüklenmeye çalışıldığı zaman  52.satırdaki özel uyarıyı göstermektedir.
     * BU fonksiyon yazılmadığı zaman laravel'in default uyarı mesajları verilmektedir.
     */
    public function messages()
    {
        return [
            'company_logo.image'=>'Firma Logosu .png .jpg .jpeg uzentılı dosya olmalıdır',
            'company_name.required'=>'Firma Adı zorunludur',
            'company_phone.min'=>'Firma Telefonu 10 haneli olmalıdır',
            'company_phone.max'=>'Firma Telefonu 10 haneli olmalıdır'
        ];
    }
}
```
`create.blade.php`
```bash
@extends("layouts.layout")

@section("contents")
    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Firma Ekleme</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!--@if (count($errors) > 0 )
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif-->
                                    {{ Form::open(array('route' => 'company.store', "class" => 'form-horizontal form-label-left', 'method' => 'post', 'files' => true)) }}
                                    @csrf

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name">Firma Adı <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                            {{ Form::text($name = 'company_name', $value = "", $attributes = ['id' => 'company_name', 'class' => 'form-control has-feedback-left']) }}
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        @error('company_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_phone">Telefon Numarası <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group ">
                                            {{ Form::text($name = 'company_phone', $value = "", $attributes = ['id' => 'company_phone', 'class' => 'form-control has-feedback-left']) }}
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        @error('company_phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_email">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                            {{ Form::email($name = 'company_email', $value = "", $attributes = ['id' => 'company_email', 'class' => 'form-control has-feedback-left']) }}
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_address">Firma Adresi <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            {{ Form::textarea($name = 'company_address', $value = "", $attributes = ['id' => 'company_address', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_website">Web Adresi <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            {{ Form::text($name = 'company_website', $value = "", $attributes = ['id' => 'company_website', 'class' => 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_website">Firma Logosu <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="file-field">
                                                <a class="btn-floating peach-gradient mt-0 float-left">
                                                    {{ Form::file('company_logo_file') }}
                                                </a>
                                            </div>
                                            @error('company_logo_file')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
                                            {{ Form::submit('Ekle', ['class' => 'btn btn-success btn-block']) }}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
@endsection()

@section("customCss")
@endsection()

@section("customJs")
    <link href="{{asset("assets/js/validator.js")}}" rel="stylesheet">
@endsection()
```
yukarıda  firma ekleme form `create.blade.php` dosyası ve  form alanlarının kontrolünün sağlandığı `createCompanyFormRequest.php` dosyası örneği incelebilir.

#### Seeder Kullanımı
Uygulama ilk açıldığında  default olarak login işlemi yapabilecek kullanıcı tanımlaması yapmak amacıyla kullanılmaktadır.
Seed hakkında detaylı bilgi için (https://laravel.com/docs/seeding) kontrol edilmelidir.
```bash
php artisan make:seeder UserSeeder
php artisan db:seed
```
komutları ile app\laravel\databaseUserSeeder.php oluşturulur ve ardından aşağıdaki gibi düzenlemeler gerçekleştirilebilir.
```bash
<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt("password");

        $user->save();
    }
}
```
```bash
php artisan migrate:refresh --seed
```
komutu ile veritabanında `users` tablosunda, `run()` fonksiyonundaki bilgiler doğrultusunda bir kullanıcı oluşturulmuş olur.

#### Route Kullanımı
Route hakkında detaylı bilgi için (https://laravel.com/docs/routing) kontrol edilmelidir. 
`web.php`
```bash
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' =>false]);

Route::get("/login", "Auth\LoginController@showLoginForm")->name("login");
Route::post("/login", "Auth\LoginController@login");
Route::get("/logout", "Auth\LoginController@logout")->name("logout");

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'CompanyController@index')->name('index');
    Route::get('/', 'CompanyController@index')->name('index');
    
    Route::get("/company", "CompanyController@index")->name('company.index');
    Route::get("/company/deleted", "CompanyController@deleted_company")->name('company.deleted');
    Route::get("/company/list", "CompanyController@index");
    Route::get("/company/show/{company_id}", "CompanyController@show")->name('company.show');
    Route::get("/company/create", "CompanyController@create")->name('company.create');
    Route::post("/company/create", "CompanyController@store")->name('company.store');
    Route::get("/company/edit/{company_id}", "CompanyController@edit")->name('company.edit');
    Route::post("/company/update/{company_id}", "CompanyController@update")->name('company.update');
    Route::get("/company/destroy/{company_id}", "CompanyController@destroy")->name('company.destroy');
    
    Route::get("/employee/list", "EmployeeController@list");
    Route::get("/employee/show/{employee_id}", "EmployeeController@show")->name('employee.show');
    Route::get("/employee", "EmployeeController@index")->name('employee.index');
    Route::get("/employee/deleted", "EmployeeController@deleted_employee")->name('employee.deleted');
    Route::get("/employee/create", "EmployeeController@create")->name('employee.create');
    Route::post("/employee/create", "EmployeeController@store")->name('employee.store');
    Route::get("/employee/edit/{employee_id}", "EmployeeController@edit")->name('employee.edit');
    Route::post("/employee/update/{employee_id}", "EmployeeController@update")->name('employee.update');
    Route::get("/employee/destroy/{employee_id}", "EmployeeController@destroy")->name('employee.destroy');
});
```

#### Authentication Kullanımı
Laravel'in kimlik doğrulama sisteminin aktif hale getirilmesi ve kullanıma hazır hale getirilmesi için kullanılabilir. 
Authentication hakkında detaylı bilgi için (https://laravel.com/docs/routing) kontrol edilmelidir.
Doha sonra `web.php` dosyasında 
```bash
Auth::routes(['register' =>false]);
```
komutu ile register metodu iptal edilir. Yani siteme yeni kayıt oluşturma işlemleri engellenmiş olur.
Ardından uygulamaya erişim kısıtlaması kapsamında kullanıcı girişi zorunluluğu için `web.php` sayfasına 
```bash
Route::group(['middleware' => ['auth']], function() {
```

#### Storage Kullanımı
Yeni firma eklerken dosya yükleme işlemleri için kullanılmaktadır.
Detaylı bilgi için `(https://laravel.com/docs/filesystem) kontrol edilmelidir. 

```bash
php artisan storage:link
```
ardından `filesystem.php` dosyası aşağıdaki gibi düzenlenmelidir. 
```bash
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'uploads' => [
            'driver' => 'local',
            'root' => public_path('storage\app\public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
    ],
```
ardından `CompanyController` da firma oluştururken aşağıdaki gibi `uploads` ile belirtilen dosya yoluna ilgili dosya kaydedilir ve veritabanındaki logo alanına oluşturduğumuz `Storage` nesnesi kullanılarak bu dosya yolu kaydedilir.
```bash
    public function store(createCompanyFormRequest $request)
    {
        //Eğer dosya seçilmiş ise yükleneceği alan Storage  nesnesi ile blirleniyor. (Storage nesnesi için config/filesystems.php sayfası 58.satırdan itibaren incelenmelidir)
        if($request->company_logo_file) {
            $request['company_logo']  = Storage::disk("uploads")->putFile("logo", $request->company_logo_file);
        }

        // FormRequest kurallarına uygun ise artık veritabanına kayıt işlemlerini gerçekleştirebiliriz
        $company = Company::create($request->all());

        //Bilgiler başarı ile kaydedildiyse(firma profil sayfasına yönlendirelim)
        if($company)
            return redirect()->route('company.show',['company_id'=>$company->id])
                ->with( 'info', 'Yeni firma oluşturuldu.');

        return redirect()->route('company.create')->compact(["success"=>"Firma Eklenemedi"]);
    }
```
