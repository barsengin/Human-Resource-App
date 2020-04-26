<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    //Tablo adı ve eklenebilecek alanlar belirlenir
    protected  $table = "companies";
    protected $fillable = ["company_name","company_address","company_phone","company_email","company_logo","company_website","created_username","updated_username","deleted_username"];

    // deleted_at alanı aktif edilir. Laravel silme işlemi için deleted_at alanına ilgilkil tarihi ekler böylelikle silme işlemi gerçekleştirilmiş olur.(Tablodan silme işlemi yapılmaz sadece pasife alınmış olur)
    use SoftDeletes;

    //employee tablosu ile ilişki tanımlaması yapılıyor : company.id = employee.company_id
    public function employee()
    {
        return $this->hasMany(Employee::class,'company_id','id');
    }

}
