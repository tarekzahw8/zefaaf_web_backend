@extends('admin.layouts.index_layout' , ['title' => "صور الأعضاء" ,'route' => $route])
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
                                صور الأعضاء
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        @if(Session::get('admin')['type'] ==1 || $filtered_Write)
                        {{-- <a href="{{url('/admin/'.$route.'/create')}}" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{ __('admin.add') }}</span>
                            </span>
                        </a> --}}
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
                                    <th><b>إسم العضو</b></th>
                                    <th><b>النوع</b></th>
                                    <th><b> تاريخ رفع الصورة</b></th>                                    
                                    <th><b>الصورة</b></th>                                    
                                    <th><b> دولة الإقامة</b></th>                                    
                                    <th><b>{{ __('admin.control') }}</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @include("admin.user_images.loop")
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
                    <a class="page-link" href="{{ url('/admin/image/users').'?'.http_build_query(array_merge(request()->all(),['page' => $prev_page])) }}" rel="prev" aria-label="« Previous">‹</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>  
                </li> 
            @endif
            
                
            @if ($next_page)
            <li class="page-item">
                {{-- <a class="page-link" href="{{url('/admin/'.$route)}}?page={{ $next_page }}" rel="next" aria-label="Next »">›</a> --}}
                <a class="page-link" href="{{ url('/admin/image/users').'?'.http_build_query(array_merge(request()->all(),['page' => $next_page])) }}" rel="next" aria-label="Next »">›</a>
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
    <a href="{{url('/admin/image/users')}}" class="btn btn-danger m-btn m-btn--icon m-btn--wide">
        <span>
            <i class="la la-warning"></i>
            <span>{{ __('admin.cancel_search') }}</span>
        </span>
    </a>
</div>
@endif



@push('script')
<script>

$('#accept_image').on('click', function(e) 
{ 
    e.preventDefault();
    swal({   
            title: 'هل أنت متأكد من الموافقة ؟',
		  confirmButtonText:  'نعم',
		  cancelButtonText:  'لا',
		  showCancelButton: true,
		  showCloseButton: true,
          target: document.getElementById('rtl-container')
        }).then((result) => {
		  if (result.value) {
            var href = $(this).attr('href');
            window.location.href = href;
          }
        });

});

$('#refuse_image').on('click', function(e) 
{ 
    e.preventDefault();
    swal({   
            title: 'هل أنت متأكد من الرفض ؟',
		  confirmButtonText:  'نعم',
		  cancelButtonText:  'لا',
		  showCancelButton: true,
		  showCloseButton: true,
          target: document.getElementById('rtl-container')
        }).then((result) => {
		  if (result.value) {
            var href = $(this).attr('href');
            window.location.href = href;
          }
        });

});
</script>
@endpush



@endsection