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
                        <div class="x_title">
                            <h2>Personel Detayları</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-2 col-sm-2 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="{{asset("assets/images/user_96.png")}}" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-university user-profile-icon"></i> {{$employee->company->company_name}}
                                    </li>

                                    <li>
                                        <i class="fa fa-phone user-profile-icon"></i> {{$employee->employee_phone}}
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> {{$employee->employee_email}}
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="{{$employee->company->company_website}}" target="_blank">{{$employee->company->company_website}}</a>
                                    </li>
                                </ul>

                                <a href="{{ route('employee.edit', ['employee_id' => $employee->id]) }}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Düzenle</a>
                                <br />



                            </div>

                            <div class="col-md-10 col-sm-10 col-xs-12">

                                <div class="profile_title">
                                    <div class="col-md-6">
                                        <h2>{{$employee->employee_first_name}} {{$employee->employee_last_name}}</h2>
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
