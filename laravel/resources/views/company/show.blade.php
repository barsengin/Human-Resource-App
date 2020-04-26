@extends("layouts.layout")

@section("contents")
     <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        @if ($message = Session::get('info'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="x_title ">
                            <h2>Firma Detayları</h2>
                            <nav class="navbar-right">
                                <a href="{{ route('company.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Firma Listesi</a>
                                <a href="{{ route('company.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Yeni Firma Ekle</a>
                            </nav>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-2 col-sm-2 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        @if($company->company_logo)
                                            <img class="img-responsive avatar-view" src="{{asset('storage/app/public').'/'.$company->company_logo}}" >
                                        @else
                                            <img class="img-responsive avatar-view" src="{{asset("assets/images/logo_128.png")}}" alt="Logo" title="">
                                        @endif

                                    </div>
                                </div>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$company->company_name}}
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> {{$company->company_email}}
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="{{$company->company_website}}" target="_blank">{{$company->company_website}}</a>
                                    </li>
                                </ul>

                                <a href="{{ route('company.edit', ['company_id' => $company->id]) }}" class="btn btn-warning btn-block"><i class="fa fa-edit m-right-xs"></i>Düzenle</a>
                                <a href="{{ route('company.destroy', ['company_id' => $company->id]) }}" onclick="return confirm('İlgili firma silinecek. Devam etmek istiyor musunuz?')" class="btn btn-sm btn-danger btn-block delete-confirm">
                                    <i class="fa fa-trash"></i> Sil
                                </a>
                                <br />

                            </div>

                            <div class="col-md-10 col-sm-10 col-xs-12">

                                <div class="profile_title">
                                    <div class="col-md-6">
                                        <h2>{{$company->company_name}}</h2>
                                    </div>
                                </div>
                                <!-- start of user-activity-graph -->
                                <!-- end of user-activity-graph -->
                                <div class="" role="main">
                                    <!-- top tiles -->
                                    <div class="row tile_count">
                                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                            <span class="count_top"><i class="fa fa-user"></i> Aktif Personel Sayısı</span>
                                            <div class="count green">{{$company->employee->count()}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     </div>

@endsection()

@section("customCss")
@endsection()

@section("customJs")
@endsection()
