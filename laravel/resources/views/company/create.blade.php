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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_phone">Telefon Numarası
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_email">Email
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                        {{ Form::email($name = 'company_email', $value = "", $attributes = ['id' => 'company_email', 'class' => 'form-control has-feedback-left']) }}
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_address">Firma Adresi
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        {{ Form::textarea($name = 'company_address', $value = "", $attributes = ['id' => 'company_address', 'class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_website">Web Adresi
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        {{ Form::text($name = 'company_website', $value = "", $attributes = ['id' => 'company_website', 'class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_website">Firma Logosu
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
