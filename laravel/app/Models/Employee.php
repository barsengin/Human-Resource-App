<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //Tablo adı ve eklenebilecek alanlar belirlenir
    protected $table = "employees";
    protected $fillable = ["employee_first_name","employee_last_name","employee_email","employee_phone","company_id","created_username","updated_username","deleted_username"];

    // deleted_at alanı aktif edilir. Laravel silme işlemi için deleted_at alanına ilgilkil tarihi ekler böylelikle silme işlemi gerçekleştirilmiş olur.(Tablodan silme işlemi yapılmaz sadece pasife alınmış olur)
    use SoftDeletes;

    //Company tablosu ile ilişki tanımlaması yapılıyor: company.id = employee.company_id
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id')->withTrashed();
    }

}
