

        <div class="m-portlet__body">
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


    <div class="form-group m-form__group row {{ $errors->has('countryId') ? 'has-danger' : ''}}">
        <label for="countryId" class="col-2 col-form-label">الدولة</label>
        <div class="col-9">
            <select name="countryId" {{ isset($show)?$show:"" }} class="form-control m-input">
                @foreach ($countries as $key=>$item)
                    <option value="{{ $item['id'] }}" {{ (isset($row) && $row['countryId'] == $item['id'])? "selected" : "" }} {{ (isset(request()->country_id) && request()->country_id==$item['id'])? 'selected':'' }} > {{ $item['nameAr'] }} </option> 
                @endforeach
                
            </select>
        {!! $errors->first('countryId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('nameAr') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> المدينة </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="nameAr" class="form-control m-input"
                    placeholder="المدينة " value="{{ (isset($row) && $row['nameAr'])? $row['nameAr']: old('nameAr') }}">
            {!! $errors->first('nameAr', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    

    <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> الحالة </label>
        <div class="col-9">
            <select name="active"  class="form-control m-input">
                    <option value="1" {{ isset($row) && $row['active']==1? "selected" : "" }} >  فعال </option>
                    <option value="0" {{ isset($row) && $row['active']==0? "selected" : "" }}> غير فعال </option>
            </select>
            {!! $errors->first('validFor', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>





</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-9">
                @if(!isset($show))
                <button type="submit" class="btn btn-brand">{{ __('admin.Submit') }}</button>
                @endif
                <a type="reset" href="{{url('/admin/'.$route)}}?country_id={{ (isset(request()->country_id))? request()->country_id:'' }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
