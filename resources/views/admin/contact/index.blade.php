@extends('admin.layouts.index_layout' , ['title' => __('admin.contact_us') ,'route' => 'contacts'])

@section('content')

<div class="row">
    <form class="m-form" action="{{url('admin/contact/search')}}" method="get" id="search_form">
        <div class="form-group m-form__group row ">
            <label for="q" class="col-1 col-form-label"></label>
            <div class="col-6">
                <input type="text" name="q" class="form-control m-input"
                placeholder="{{ __('admin.search_word') }}">
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
                                <i class="la la-envelope"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                {{ __('admin.contact_us') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">


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
                                    <th><b>{{ __('admin.message') }}</b></th>
                                    <th><b>نوع الرسالة</b></th>
                                    <th><b>{{ __('admin.name') }}</b></th>
                                    <th><b>{{ __('admin.email') }}</b></th>
                                    <th><b>{{ __('admin.sent_at') }}</b></th>
                                    <th><b>{{ __('admin.control') }}</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($list)
                                @foreach ($list as $row)
                                <tr>
                                    <th scope="row">{{ $row->message }}</th>
                                    <th scope="row">{{ ($row->types)? $row->types->title : "" }}</th>
                                    <th scope="row">{{ $row->name }}</th>
                                    <th scope="row">{{ $row->email }}</th>
                                    <th scope="row">{{ $row->created_at }}</th>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            @canView
                                            <a type="button"
                                            href="{{url('admin/contacts')}}/{{ $row->id }}"
                                            class="m-btn m-btn m-btn--square btn btn-secondary">
                                            <i class="fa fa-eye m--font-info"></i>
                                        </a>
                                        @endCan
                                        @canEdit
                                        <a type="button"
                                            href="{{url('admin/contacts')}}/{{ $row->id }}/edit"
                                            class="m-btn m-btn m-btn--square btn btn-secondary">
                                            <i class="fa fa-edit m--font-info"></i>
                                        </a>
                                        @endCan
                                        @canDelete
                                        <a type="button"  data-id = "{{ $row->id }}"
                                            class="m-btn m-btn m-btn--square btn btn-secondary _remove">
                                            <i class="flaticon-delete-1 m--font-danger"></i>
                                        </a>
                                        @endCan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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
       @if($list)
       {{ $list->links() }}
       @endif
   </div>
</div>
<br>

@if(isset($query ) or isset($message))
<div>
    <a href="{{url('admin/contacts')}}" class="btn btn-danger m-btn m-btn--icon m-btn--wide">
        <span>
            <i class="la la-warning"></i>
            <span>{{ __('admin.cancel_search') }}</span>
        </span>
    </a>
</div>
@endif







@endsection
