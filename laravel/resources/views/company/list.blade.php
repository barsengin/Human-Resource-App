@extends("layouts.layout")

@section("contents")
    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                @if(!$companies['deleted']) Aktif Firma Listesi
                                @else Silinen Firma Listesi
                                @endif
                            </h2>
                            <a href="{{ route('company.create') }}" class=" navbar-right panel_toolbox btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Yeni Firma Ekle</a>
                            <div class="clearfix"></div>
                        </div>
                        @if ($message = Session::get('info'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Firma</th>
                                    <th>Firma Adresi</th>
                                    <th>Firma Telefonu</th>
                                    <th>Firma Logo</th>
                                    <th>Web Sayfası</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Oluşturan Kişi</th>

                                    @if($companies["deleted"])
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
                                @if($companies["deleted"])
                                    @foreach($companies['data'] as $company )
                                        <tr>
                                            <td>{{$company->company_name}}</td>
                                            <td>{{$company->company_address}}</td>
                                            <td>{{$company->company_phone}}</td>
                                            <td>@if($company->company_logo != null || $company->company_logo != '')<img src="{{asset('storage/app/public').'/'.$company->company_logo}}" width="20" height="20">@endif</td>
                                            <td>{{$company->company_website}}</td>
                                            <td>{{$company->created_at}}</td>
                                            <td>{{$company->created_username}}</td>
                                            <td>{{$company->deleted_at}}</td>
                                            <td>{{$company->deleted_username}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($companies['data'] as $company )
                                        <tr>
                                            <td>{{$company->company_name}}</td>
                                            <td>{{$company->company_address}}</td>
                                            <td>{{$company->company_phone}}</td>
                                            <td>@if($company->company_logo != null || $company->company_logo!= '')<img src="{{asset('storage/app/public').'/'.$company->company_logo}}" width="20" height="20">@endif</td>
                                            <td>{{$company->company_website}}</td>
                                            <td>{{$company->created_at}}</td>
                                            <td>{{$company->created_username}}</td>
                                            <td>{{$company->updated_at}}</td>
                                            <td>{{$company->updated_username}}</td>
                                           <!-- <td>{{ count($company->employee)}}</td>-->
                                            <td>
                                                <a href="{{ route('company.show', ['company_id' => $company->id]) }}" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> Detay</a>
                                                <a href="{{ route('company.edit', ['company_id' => $company->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-eyedropper"></i> Güncelle
                                                </a>
                                                <a href="{{ route('company.destroy', ['company_id' => $company->id]) }}" onclick="return confirm('İlgili firma silinecek. Devam etmek istiyor musunuz?')" class="btn btn-sm btn-danger delete-confirm">
                                                    <i class="fa fa-trash"></i> Sil
                                                </a>
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
