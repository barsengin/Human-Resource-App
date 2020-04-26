@extends("layouts.layout")

@section("contents")
    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Personel Düzenleme</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (count($errors) > 0 )
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif
                                {{ Form::open(array('route' => array('employee.update', $employee->id), "class" => 'form-horizontal form-label-left', 'method' => 'post')) }}
                                @csrf

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_first_name">Adı <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        {{ Form::text($name = 'employee_first_name', $value = $employee->employee_first_name, $attributes = ['id' => 'employee_first_name', 'class' => 'form-control has-feedback-left']) }}
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    @error('employee_first_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_last_name">Soyadı <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        {{ Form::text($name = 'employee_last_name', $value = $employee->employee_last_name, $attributes = ['id' => 'employee_last_name', 'class' => 'form-control has-feedback-left']) }}
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    @error('employee_last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_phone">Telefon Numarası <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        {{ Form::text($name = 'employee_phone', $value = $employee->employee_phone, $attributes = ['id' => 'employee_phone', 'class' => 'form-control has-feedback-left']) }}
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    @error('employee_phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_email">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        {{ Form::email($name = 'employee_email', $value = $employee->employee_email, $attributes = ['id' => 'employee_email', 'class' => 'form-control has-feedback-left']) }}
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Firma </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        {{ Form::select('company_id', $companies, $employee->company_id, ['class' => 'form-control', 'placeholder'=>'Firma Seçiniz']) }}
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-3  col-sm-6 col-xs-12 col-md-offset-3">
                                        {{ Form::submit('Güncelle', ['class' => 'btn btn-success btn-block']) }}
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
