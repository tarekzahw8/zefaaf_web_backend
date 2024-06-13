@extends('admin.layouts.index_layout' , ['title' => __("admin.$route") ,'route' => $route])
@section('content')

@php
$moduleId = 13;
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

{{-- <div class="row">
    <form class="m-form" action="{{url('/admin/'.$route)}}" method="get" id="search_form">
        <div class="form-group m-form__group row ">
            <label for="q" class="col-1 col-form-label"></label>
            <div class="col-4">
                <select name="field" class="form-control m-input">
                    <option value="title">{{ __('admin.title') }}</option>
                </select>
            </div>

            <div class="col-4">
                <input type="text" name="q" class="form-control m-input" 
                placeholder="{{ __('admin.search_word') }}" value="{{ isset(request()->q)?request()->q : '' }}">
            </div>
            <div class="col-2">
                <a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" id="confirm_search">
                    <span>
                        <i class="la la-search"></i>
                        <span>{{ __('admin.search') }}</span>
                    </span>
                </a>
            </div>
        </div>
    </form>
</div> --}}
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

                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th><b>{{ __('admin.name') }}</b></th>
                                    <th><b>رقم الموبايل </b></th>
                                    <th><b>الإيميل</b></th>
                                    <th><b>الدولة</b></th>
                                    <th><b>العمولة</b></th>
                                    <th><b>الحالة  </b></th>
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