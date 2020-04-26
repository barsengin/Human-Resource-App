@extends("layouts.layout")

@section("contents")
    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                @if(!$employees['deleted']) Aktif Personel Listesi
                                @else Silinen Personel Listesi
                                @endif
                            </h2>
                            <a href="{{ route('employee.create') }}" class=" navbar-right panel_toolbox btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Yeni Personel Ekle</a>
                            <div class="clearfix"></div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="x_content">
                            <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Personel</th>
                                    <th>Telefon</th>
                                    <th>Email</th>
                                    <th>Firma</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Oluşturan Kişi</th>

                                    @if($employees["deleted"])
                                        <th>Silinme Tarihi</th>
                                        <th>Silen Kişi</th>
                                    @else
                                        <th>Güncellenme Tarihi</th>
                                        <th>Güncelleyen Kişi</th>
                                        <th>İşlem</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @if($employees["deleted"])
                                    @foreach($employees['data'] as $employee )
                                        <tr>
                                            <td>{{$employee->employee_first_name}} {{$employee->employee_last_name}}</td>
                                            <td>{{$employee->employee_phone}}</td>
                                            <td>{{$employee->employee_email}}</td>
                                            <td>{{$employee->company->company_name}}</td>
                                            <td>{{$employee->created_at}}</td>
                                            <td>{{$employee->created_username}}</td>
                                            <td>{{$employee->deleted_at}}</td>
                                            <td>{{$employee->deleted_username}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($employees['data'] as $employee )
                                        <tr>
                                            <td>{{$employee->employee_first_name}} {{$employee->employee_last_name}}</td>
                                            <td>{{$employee->employee_phone}}</td>
                                            <td>{{$employee->employee_email}}</td>
                                            <td>{{$employee->company->company_name}}</td>
                                            <td>{{$employee->created_at}}</td>
                                            <td>{{$employee->created_username}}</td>
                                            <td>{{$employee->updated_at}}</td>
                                            <td>{{$employee->updated_username}}</td>
                                            <td>
                                                <a href="{{ route('employee.show', ['employee_id' => $employee->id]) }}" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> Detay</a>
                                                <a href="{{ route('employee.edit', ['employee_id' => $employee->id]) }}" class="btn btn-sm btn-warning"> <i class="fa fa-eyedropper"></i> Güncelle</a>
                                                <a href="{{ route('employee.destroy', ['employee_id' => $employee->id]) }}" onclick="return confirm('İlgili personel silinecek. Devam etmek istiyor musunuz?')" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> Sil</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /page content -->
@endsection()

@section("CustomCss")
    <link href="{{asset("assets/css/datatable/dataTables.bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/datatable/fixedHeader.bootstrap.css")}}" rel="stylesheet">
@endsection

@section("CustomJs")
    <script src="{{asset("assets/js/datatable/jquery.dataTables.js")}}"> </script>
    <script src="{{asset("assets/js/datatable/dataTables.bootstrap.js")}}"> </script>
    <script src="{{asset("assets/js/datatable/dataTables.fixedHeader.js")}}"> </script>
@endsection()
