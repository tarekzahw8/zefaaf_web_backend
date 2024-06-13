@extends('admin.layouts.index_layout' , ['title' => __("admin.$route") ,'route' => $route])
@section('content')

<section class="content">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
        
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="get" action="{{url('admin/paymentsReport')}}" target="_blank">
    
      <!-- SELECT2 EXAMPLE -->
          <div class="row">
          
            <div class="col-md-6">
              
              <div class="form-group {{ $errors->has('from') ? 'has-danger' : ''}}">
                <label> التاريخ من</label>
                <input  type="date" name="from" class="form-control select2" style="width: 100%;" value="{{ (request()->from)?request()->from:old('from') }}">
              </div>  
              
            </div>
            <!-- /.col -->


            <!-- /.col -->
            <div class="col-md-6">
               
               <div class="form-group {{ $errors->has('to') ? 'has-danger' : ''}}">
               <label>التاريخ الى </label>
               <input name="to" type="date" class="form-control select2"  style="width: 100%;" value="{{ (request()->to)?request()->to:old('to') }}">
               </div>
           </div>


           <div class="col-md-6">
              
            <div class="form-group {{ $errors->has('nationalityCountryId') ? 'has-danger' : ''}}">
                <label>الدولة</label>
                <select name="nationalityCountryId" id="nationalityCountryId" class="form-control select2" style="width: 100%;" >
                    <option value="" selected> اختر الدولة </option>
                    @foreach($countries as $key=>$value)
                        <option value="{{ $value['id'] }}" 
                        {{ (request()->nationalityCountryId && $value['id'] ==  request()->nationalityCountryId)? "selected":"" }}
                        > {{ $value['nameAr'] }} </option>
                    @endforeach 
                    
                </select>
            </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-6">
          
            <div class="form-group {{ $errors->has('packageId') ? 'has-danger' : ''}}">
                <label>الباقة</label>
                <select name="packageId" id="packageId" class="form-control select2" style="width: 100%;" >
                    <option value="" selected>  اختر الباقة </option>
                    <option value="0" {{ (request()->packageId && 0 ==  request()->packageId)? "selected":"" }} > مجانى </option>
                    <option value="1" {{ (request()->packageId && 1 ==  request()->packageId)? "selected":"" }} > مدفوع </option>
                    
                </select>
            </div>
          <!-- /.form-group -->
        </div>
        
        <div class="col-md-6">
          
            <div class="form-group {{ $errors->has('userGender') ? 'has-danger' : ''}}">
                <label>النوع</label>
                <select name="userGender" id="userGender" class="form-control select2" style="width: 100%;" >
                    <option value="" selected> اختر النوع </option>
                    <option value="0" {{ (request()->userGender && 0 ==  request()->userGender)? "selected":"" }} > ذكر </option>
                    <option value="1" {{ (request()->userGender && 1 ==  request()->userGender)? "selected":"" }} > أنثى </option>

                    
                </select>
            </div>
          <!-- /.form-group -->
        </div>

             
            

             <div class="col-md-6">


                <div class="form-group">
                    <label></label>
                    <button type="submit" class="btn btn-primary"  style="width: 50%;" value="Add"> بحث</button>
                </div>
             </div>
            
            
    </form>
</section>
<br>

@if($collection)
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-progress">

                    <!-- here can place a progress bar-->
                </div>
                <div class="m-portlet__head-wrapper">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-avatar"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                تقارير المدفوعات
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        {{-- <a href="{{url('/admin/'.$route.'/create')}}" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{ __('admin.add') }}</span>
                            </span>
                        </a> --}}

                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="color: red !important;"><b>اسم العضو</b></th>
                                    <th style="color: red !important;"><b>رقم الهاتف</b></th>
                                    <th style="color: red !important;"><b>النوع</b></th>
                                    <th style="color: red !important;"><b>الباقة </b></th>
                                    <th style="color: red !important;"><b>الدولة </b></th>
                                    <th style="color: red !important;"><b>تاريخ الإشتراك</b></th>
                                    <th style="color: red !important;"><b>قيمة الإشتراك</b></th>
                                    <th style="color: red !important;"><b>مرجع الإشتراك</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @include("admin.$view.loop_payment")
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!--end::Section-->
        </div>


    </div>
    <!--end::Portlet-->
</div>
</div>
@endif

<div class="container">
    <div class="text-center">
    @if($collection)
       @if ($next_page)
            <ul class="pagination" role="navigation">
            @if ($page > 0)
                <li class="page-item">
                    <a class="page-link" href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['page' => $prev_page])) }}" rel="prev" aria-label="« Previous">‹</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>  
                </li> 
            @endif
            
                
            @if ($next_page)
            <li class="page-item">
                <a class="page-link" href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['page' => $next_page])) }}" rel="next" aria-label="Next »">›</a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                <span class="page-link" aria-hidden="true">›</span>   
            </li> 
            @endif
        </ul>
      @endif
    @endif
   </div>
</div>
<br>
@if(isset($query ) or isset($message))
<div>
    <a href="{{url('/admin/'.$route)}}" class="btn btn-danger m-btn m-btn--icon m-btn--wide">
        <span>
            <i class="la la-warning"></i>
            <span>{{ __('admin.cancel_search') }}</span>
        </span>
    </a>
</div>
@endif







@endsection