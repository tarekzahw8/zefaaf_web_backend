@extends('admin.layouts.index_layout',['title' => __('admin.roles') ])

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

<!--begin::Portlet-->
<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-name">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                   {{ __('admin.add') }} | الصلاحية
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form class="m-form" action="{{url('admin/roles')}}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
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

            <div class="form-group m-form__group row {{ $errors->has('name') ? 'has-danger' : ''}}">
                <label for="name" class="col-1 col-form-label"> الصلاحية   </label>
                <div class="col-9">
                    <input type="text" name="name" class="form-control m-input"
                            placeholder="الصلاحية" value="{{ old('name') }}">
                    {!! $errors->first('name', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>


            <div class="m-form__group form-group {{ $errors->has('modules') ? 'has-danger' : ''}}">
			    <label for="name" class="col-1 col-form-label"> الاقسام   </label>
				    <div class="m-checkbox-inline">
                         @foreach($modules as $row)
                         <label class="m-checkbox">
                            <input type="checkbox" value="{{ $row->id }}" name="modules[]">  {{ $row->name_ar }}
                            <span></span>
                        </label>
                        @endforeach

                    </div>
                    {!! $errors->first('modules', '<span class="form-control-feedback">اختر الاقسام</span>') !!}
			</div>












        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <button type="submit" class="btn btn-brand">{{ __('admin.save') }}</button>
                        <a type="reset" href="{{url('admin/roles')}}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->


@endsection
