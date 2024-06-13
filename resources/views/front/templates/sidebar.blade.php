

@if(isset($main_header))
<div id="sidebarCollapse" class="toggle-btn">
              <i class="fas fa-bars"></i>
            </div>

            <a href="#" class="logo-btn">
              <img src="{{url('/')}}/front/imgs/logo.png" alt="logo">
            </a>

            <div class="banner">
              <img class="banner-img" src="{{url('/')}}/front/imgs/groom.png" alt="groom">
              <h1>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
               ابحث عن شريك حياتك بأخلاق إسلامية
              </h1>

              <form class="form-inline user-data" method="post" action="{{ url('/members/search') }}">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="term" placeholder="الإسم">
                </div>

                <div class="form-group">
                  <select class="form-control" name="nationalityCountryId">
                    <option value="">الجنسية</option>
                            @foreach($countries as $key=>$value)
                              <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                            @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <select class="form-control" name="residentCountryId">
                    <option value="">مكان الإقامة</option>
                            @foreach($countries as $key=>$value)
                              <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                            @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <select class="form-control" name="mariageStatues">
                    <option>الحالة الإجتماعية</option>
                    <option value="0">أعزب</option>
                    <option value="1">متزوج</option>
                    <option value="2">مطلق</option>
                    <option value="3">ارمل</option>

                  </select>
                </div>

                <button class="btn btn-primary" type="submit">بحث</button>
              </form>
            </div>
@else
<nav class="navbar page-header fixed-top justify-content-between">
              <a class="navbar-brand p-0">
                <img src="{{url('/')}}/front/imgs/01.png" alt="logo">
              </a>
              <form class="form-inline" action="{{ url('/members/search') }}" method="post">
                @csrf
                <div class="search-input input-group">
                  <input type="text" class="form-control" placeholder="بحث ..." name="term" aria-describedby="search">
                  <div class="input-group-append">
                    <span class="input-group-text" id="search"><i class="fas fa-search"></i></span>
                  </div>
                </div>
              </form>
              <div id="sidebarCollapse" class="toggle-btn">
                <i class="fas fa-bars"></i>
              </div>
            </nav>

@endif
