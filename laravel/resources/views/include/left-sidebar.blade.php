<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset("assets/images/logo_app.svg")}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Hoş Geldiniz..</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('company.index')}}"><i class="fa fa-home"></i> Ana Sayfa</a></li>
                    <li><a><i class="fa fa-building"></i> Firma İşlemleri <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('company.create')}}">Yeni Firma Ekle</a></li>
                            <li><a href="{{ route('company.index')}}">Firmalar</a></li>
                            <li><a href="{{ route('company.deleted')}}">Silinen Firmalar</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-group"></i> Personel İşlemleri <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('employee.create')}}">Yeni Personel Ekle</a></li>
                            <li><a href="{{ route('employee.index')}}">Personeller</a></li>
                            <li><a href="{{ route('employee.deleted')}}">Silinen Personeller</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <!-- /menu footer buttons -->
    </div>
</div>
