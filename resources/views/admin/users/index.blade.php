@extends('admin.layouts.index_layout' , ['title' => __("admin.$route") ,'route' => $route])
@section('content')


@php
$moduleId = 10;
$moduleRead = 1;
$moduleWrite = 1;
$moduleDelete = 1;
$filtered_Read = array_filter(Session::get('privlages'), function($val) use($moduleId, $moduleRead){
              return ($val['moduleId']==$moduleId and $val['moduleRead']==$moduleRead);
         });
$filtered_Write = array_filter(Session::get('privlages'), function($val) use($moduleId, $moduleWrite){
              return ($val['moduleId']==$moduleId and $val['moduleWrite']==$moduleWrite);
         });         
$filtered_Delete = array_filter(Session::get('privlages'), function($val) use($moduleId, $moduleDelete){
              return ($val['moduleId']==$moduleId and $val['moduleDelete']==$moduleDelete);
         });         
@endphp

<div class="row">
    <form class="m-form" action="{{url('/admin/'.$route)}}" method="get" id="search_form" style="width: 98%">
        <div class="form-group m-form__group row ">
            {{-- <label for="q" class="col-1 col-form-label">  </label> --}}
            <div class="col-4" style="padding-bottom: 10px">
                <select name="active" class="form-control m-input" >
                    <option value="">حالة العضو</option>
                    <option value="3" {{ isset(request()->active) && request()->active==3 ? "selected" :"" }}  >حذف حسابه</option>
                    <option value="1" {{ isset(request()->active) && request()->active==1 ? "selected" :"" }} >مفعل</option>
                    <option value="2" {{ isset(request()->active) && request()->active==2 ? "selected" :"" }} >محظور</option>
                    <option value="0" {{ isset(request()->active) && request()->active==0 ? "selected" :"" }} >موقوف</option>
                </select>
            </div>

            <div class="col-4">
                <select name="userGender" class="form-control m-input">
                    <option value="">النوع</option>
                    <option value="0" {{ isset(request()->userGender) && request()->userGender==0 ? "selected" :"" }} >ذكر</option>
                    <option value="1" {{ isset(request()->userGender) && request()->userGender==1 ? "selected" :"" }} >أنثى</option>
                </select>
            </div>

            <div class="col-4">
                <select name="residentCountryId" id="residentCountryId" class="form-control m-input">
                    <option value="">دولة الاقامة</option>
                    @foreach($countries as $key=>$value)
                        <option value="{{ $value['id'] }}"
                        {{ isset(request()->residentCountryId) && request()->residentCountryId== $value['id'] ? "selected" :"" }}
                        > {{ $value['nameAr'] }} </option>
                    @endforeach
                </select>
            </div>
           
            <div class="col-4">
                <select name="nationalityCountryId" class="form-control m-input">
                    <option value="">الجنسية</option>
                    @foreach($countries as $key=>$value)
                        <option value="{{ $value['id'] }}"
                        {{ isset(request()->nationalityCountryId) && request()->nationalityCountryId==$value['id'] ? "selected" :"" }}
                        > {{ $value['nameAr'] }} </option>
                    @endforeach
                </select>
            </div>
			
            <div class="col-4" >
                <select name="ageTo" class="form-control m-input" placeholder="العمر">
                    <option value="">العمر</option>

                    @for ($i = 13; $i <= 90; $i++)
                        <option value="{{ $i }}" {{ (isset(request()->ageTo) && request()->ageTo == $i) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                
            </div>
			
			<div class="col-4">
                <select name="mariageKind" class="form-control m-input">
                    <option value="">نوع الزواج</option>
					@foreach ($fixedData['mariageKind'] as $key=>$item)
						<option value="{{ $item['id'] }}"  {{ isset(request()->mariageKind) && request()->mariageKind== $item['id'] ? "selected" :"" }} >{{ $item['title'] }}</option>    
					@endforeach
                       
                </select>
            </div>
			
			<div class="col-4" style="  margin-top: 10px; ">
                <select name="mariageStatues" class="form-control m-input">
                    <option value="">الحالة الاجتماعية</option>
					@foreach ($fixedData['marriageStatus'] as $key=>$item)
						<option value="{{ $item['id'] }}"  {{ isset(request()->mariageStatues) && request()->mariageStatues== $item['id'] ? "selected" :"" }} >{{ $item['title'] }}</option>    
					@endforeach
                       
                </select>
            </div>
			
			<div class="col-4" style="  margin-top: 10px; ">
                <select name="packageId" class="form-control m-input">
                    <option value="">نوع الباقة </option>
					@foreach ($user_packages as $key=>$item)
                    <option value="{{ $item['id'] }}"  {{ isset(request()->packageId) && request()->packageId== $item['id'] ? "selected" :"" }} >{{ $item['title'] }}</option>    
					@endforeach
                    {{--<option value="11"  {{ isset(request()->packageId) && request()->packageId== 11 ? "selected" :"" }} >مدفوع</option>    --}}

                </select>
            </div>
			
			<div class="col-4" style="margin-top:10px;">
               
					<span id="load-cities">
						<select name="cityId" class="form-control m-input">
							<option value=""> اختر المدينة </option>
							@if(isset($cities))
								@foreach($cities as $key=>$value)
									@if (isset(request()->residentCountryId) && request()->residentCountryId == $value['countryId'])
										<option value="{{ $value['id'] }}" {{ (isset(request()->cityId) && request()->cityId == $value['id'])? "selected" : "" }} > {{ $value['nameAr'] }} </option>
									@endif
									
								@endforeach 
							@endif 
						</select>
				</span>
                       
            </div>

            <div class="col-4" style="margin-top:10px;">
                <input type="text" name="q" class="form-control m-input" 
                placeholder="{{ __('admin.search_word') }}" value="{{ isset(request()->q)?request()->q : '' }}">
            </div>

            
            <div class="col-2" style="margin-top:10px;">
                <a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" id="confirm_search">
                    <span>
                        <i class="la la-search"></i>
                        <span>{{ __('admin.search') }}</span>
                    </span>
                </a>
            </div>
        </div>
    </form>
</div>
<br>

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
                                {{ __("admin.$route") }}  
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        @if(Session::get('admin')['type'] ==1 || $filtered_Write)
                        <a href="{{url('/admin/'.$route.'/create')}}" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{ __('admin.add') }}</span>
                            </span>
                        </a>
                        @endif

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
                                    <th><b>إسم المستخدم</b></th>
                                    <th><b>النوع</b></th>
                                    <th style="padding: 10px 20px; "><b> العمر</b></th>                                    
                                    <th><b> الجنسية</b></th>  
                                    <th><b> دولة الإقامة</b></th>                                    
                                    <th><b>الدولة الحقيقية</b></th>                                    
                                    <th><b>الجهاز </b></th>                                    
                                    <th colspan="3">تاريخ التسجيل / اخر ظهور </th>     
                                    @if(Session::get('admin')['type'] ==1 || array_search(12, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)                               
                                    <th><b>إرسال اشعار</b></th>
                                    @endif
                                    <th><b> الحالة / حظر العضو </b></th>
                                    <th><b> الباقة / اشتراك</b></th>
                                    <th><b>قوائم الأعضاء</b></th>
                                    <th><b>المحادثات / الرسائل</b></th>
                                    {{-- <th><b>الباقة</b></th> --}}
                                    {{-- <th><b>نوع جهاز العضو</b></th> --}}
                                    {{-- <th colspan="3">آخر ظهور</th> --}}
                                    {{-- <th><b></b></th> --}}
                                    {{-- <th><b>قوائم الأعضاء</b></th> --}}
                                    {{-- <th><b>المحادثات</b></th> --}}
                                    @if(Session::get('admin')['type'] ==1 || array_search(15, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                    {{-- <th><b>الرسائل</b></th> --}}
                                    @endif
                                   
                                    @if(Session::get('admin')['type'] ==1 || array_search(12, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                    {{-- <th><b>إرسال إشعار</b></th> --}}
                                    @endif
                                    @if(Session::get('admin')['type'] ==1 || array_search(11, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                    {{-- <th><b>إشتراك فى باقة</b></th> --}}
                                    @endif
                                    {{-- <th><b>{{ __('admin.height') }}</b></th> --}}
                                    <th><b>{{ __('admin.control') }}</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @include("admin.$view.loop")
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!--end::Section-->
            @if($collection)
            {{-- <div> 
                <span>
                    <span>{{ __('admin.showing') }}</span>
                    {{($collection->currentpage()-1)*$collection->perpage()+1}} 
                    <span>{{ __('admin.to') }}</span> 
                    {{$collection->currentpage()*$collection->perpage()}}
                </span> 
                <span>{{ __('admin.from') }}</span>
                <span class="badge badge-info">{{ $collection->total() }}</span>
                <span>{{ __('admin.items') }}</span>
            </div> --}}
            @endif

        </div>


    </div>
    <!--end::Portlet-->
</div>
</div>

<div class="container">
    <div class="text-center">
    @if($collection)
    @if ($next_page || $page > 0)
            <ul class="pagination" role="navigation">
            @if ($page > 0)
                <li class="page-item">
                    {{-- <a class="page-link" href="{{url('/admin/'.$route)}}?page={{ $prev_page }}" rel="prev" aria-label="« Previous">‹</a> --}}
                    <a class="page-link" href="{{ url('/admin/'.$route).'?'.http_build_query(array_merge(request()->all(),['page' => $prev_page])) }}" rel="prev" aria-label="« Previous">‹</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>  
                </li> 
            @endif
            
                
            @if ($next_page)
            <li class="page-item">
                {{-- <a class="page-link" href="{{url('/admin/'.$route)}}?page={{ $next_page }}" rel="next" aria-label="Next »">›</a> --}}
                <a class="page-link" href="{{ url('/admin/'.$route).'?'.http_build_query(array_merge(request()->all(),['page' => $next_page])) }}" rel="next" aria-label="Next »">›</a>
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



@push('script')
    <script>
        $("#residentCountryId").change(function(){
            let country_id = this.value;
            $.get( "{{url('/admin/user/cities')}}", { country_id: country_id } )
            .done(function( data ) {
                $("#load-cities").html(data);
            });
        });
		
    </script>
@endpush