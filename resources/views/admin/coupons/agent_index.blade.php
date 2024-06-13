@extends('admin.layouts.index_layout' , ['title' => __("admin.$route") ,'route' => $route])
@section('content')



<div class="row">
    <form class="m-form" action="{{url('/agent_dashboard/dashboard')}}" method="get" id="search_form" style="width: 98%">
        <div class="form-group m-form__group row ">
            {{-- <label for="q" class="col-1 col-form-label">  </label> --}}
           
            <div class="col-4">
                <select name="status" class="form-control m-input">
                    {{-- <option value="">حالة الكوبونات</option> --}}
                    <option value="3" {{ isset(request()->status) && request()->status==3 ? "selected" :"" }} >الكل</option>
                    <option value="1" {{ isset(request()->status) && request()->userGender==1 ? "selected" :"" }} >الجديد</option>
                    <option value="2" {{ isset(request()->status) && request()->status==2 ? "selected" :"" }} >المباع</option>
                </select>
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
</div>
<br>
@if(isset($collection))
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
                    {{-- <div class="m-portlet__head-tools">
                        @if(Session::get('admin')['type'] ==1 || $filtered_Write)
                        <a href="{{url('/admin/'.$route.'/create')}}" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{ __('admin.add') }}</span>
                            </span>
                        </a>
                        @endif

                    </div> --}}
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
                                    <th><b>كود  </b></th>
                                    <th><b>تاريخ التخصيص </b></th>
                                    <th><b>تاريخ البيع</b></th>
                                    <th><b>اسم العميل  </b></th>
                                    <th><b>اسم الباقة  </b></th>
                                    {{-- <th><b>اسم الوكيل</b></th> --}}
                                    <th><b>{{ __('admin.control') }}</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @include("admin.$view.agent_loop")
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
    @if(isset($collection))
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




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تخصيص</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/agent_dashboard/counpon/assign')}}" method="post">
            {{ csrf_field() }}
          <div class="form-group">
            <input type="hidden" id="couponId" name="copoundId"> 
            <input type="hidden" id="packageId" name="packageId"> 
            <label for="recipient-name" class="col-form-label">بحث برقم الهاتف</label>
            <input type="text" class="form-control" id="userName">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">الاعضاء:</label>
            <span id="load-users">
                <select name="userId" class="form-control m-input">
                </select>
            </span>
          </div>
          <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-primary">تخصيص</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


@push('script')
    <script>

        $('._add_user_coupons').on('click',function(){
    	    var id = $(this).attr('data-id');
    	    var package_id = $(this).attr('data-package_id');
            $("#couponId").val(id);
            $("#packageId").val(package_id);
            $('#exampleModal').modal('toggle');
        });    
    </script>
    <script>
        $("#userName").on('input', function() {
            let search = this.value;
            let length = this.value.length;
            if(length >= 6)
            {
                $.get( "{{url('/agent_dashboard/counpon/search/user')}}", { search: search,type:'notification' } )
                .done(function( data ) {
                    $("#load-users").html(data);
                });
            }
        });
    </script>
@endpush


@endsection