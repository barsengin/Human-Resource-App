<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //
    protected $table = "employees";
    protected $fillable = ["employee_first_name","employee_last_name","employee_email","employee_phone","company_id"];
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id')->withTrashed();
    }

}
