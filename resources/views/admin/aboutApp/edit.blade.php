@extends('admin.layouts.index_layout',['title' => __('admin.aboutApp') ])

@section('content')

@if( session('status') )
<div class="m-alert m-alert--icon m-alert--air alert alert-success alert-dismissible fade show" role="alert">
    {{-- <div class="m-alert__icon">
        <i class="la la-warning"></i>
    </div> --}}
    <div class="m-alert__text">
        <strong>{{ session('status') }}</strong>
    </div>
    <div class="m-alert__close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
</div>
@endif
@if( session('error') )
            <div class="m-alert m-alert--icon m-alert--air alert alert-danger alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                    <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                    <strong>{{ session('error') }}!</strong>
                </div>
                <div class="m-alert__close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
            @endif

<!--begin::Portlet-->
<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-name">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                   {{ __('admin.edit') }} 
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form class="m-form" action="{{url('/admin/'.$route)}}/{{ $row['id'] }}" method="post" enctype="multipart/form-data">
       
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="page_id" value="{{ $page_id }}" />
        <div class="m-portlet__body">

        @if($errors->any())
            <div class="m-alert m-alert--icon alert alert-danger" role="alert" id="m_form_1_msg">
                <div class="m-alert__icon">
                    <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                    {{ __('admin.fix_errors') }}
                </div>
                <div class="m-alert__close">
                    <button type="button" class="close" data-close="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        @endif

            
            
            @if ($page_id == 1)
                <div class="form-group m-form__group row {{ $errors->has('aboutUs') ? 'has-danger' : ''}}">
                    <label for="example-text-input" class="col-2 col-form-label">رسالتنا</label>
                    <div class="col-9">
                        <textarea class="form-control m-input" id="kt-ckeditor-5" placeholder="{{ __('admin.desc') }}" name="aboutUs" >{{ $row['aboutUs'] }}</textarea>
                        {!! $errors->first('aboutUs', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            @elseif ($page_id == 2)
                <div class="form-group m-form__group row {{ $errors->has('privacy') ? 'has-danger' : ''}}">
                    <label for="example-text-input" class="col-2 col-form-label">سياسة الخصوصية</label>
                    <div class="col-9">
                        <textarea class="form-control m-input" id="kt-ckeditor-5" placeholder="{{ __('admin.desc') }}" name="privacy" >{{ $row['privacy'] }}</textarea>
                        {!! $errors->first('privacy', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            @elseif ($page_id == 3)
                <div class="form-group m-form__group row {{ $errors->has('registerCondetions') ? 'has-danger' : ''}}">
                    <label for="example-text-input" class="col-2 col-form-label">الشروط والأحكام</label>
                    <div class="col-9">
                        <textarea class="form-control m-input" id="kt-ckeditor-5" placeholder="{{ __('admin.desc') }}" name="registerCondetions" >{{ $row['registerCondetions'] }}</textarea>
                        {!! $errors->first('registerCondetions', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            @elseif ($page_id == 4)
                <div class="form-group m-form__group row {{ $errors->has('registerLicense') ? 'has-danger' : ''}}">
                    <label for="example-text-input" class="col-2 col-form-label">قسم التسجيل</label>
                    <div class="col-9">
                        <textarea class="form-control m-input" id="kt-ckeditor-5" placeholder="{{ __('admin.desc') }}" name="registerLicense" >{{ $row['registerLicense'] }}</textarea>
                        {!! $errors->first('registerLicense', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            @endif

            

            


            
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <button type="submit" class="btn btn-brand">{{ __('admin.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->

@endsection