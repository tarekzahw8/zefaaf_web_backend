

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
        <label for="countryId" class="col-1 col-form-label">الدولة</label>
        <div class="col-9">
        <select name="countryId" {{ isset($show)?$show:"" }} class="form-control m-input">
            <option value=""> اختر الدولة  </option>
            @foreach($countries as $key=>$value)
                
                <option value="{{ $value['id'] }}" {{ (isset($row) && $row['countryId'] == $value['id'])? "selected" : "" }} > {{ $value['nameAr'] }} </option>
            @endforeach 
        </select>
            {!! $errors->first('countryId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('name') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> {{ __('admin.name') }} </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="name" class="form-control m-input"
                    placeholder="{{ __('admin.name') }}" value="{{ (isset($row) && $row['name'])? $row['name']: old('name') }}">
            {!! $errors->first('name', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('mobile') ? 'has-danger' : ''}}">
        <label for="mobile" class="col-1 col-form-label"> رقم الموبايل  </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="mobile" class="form-control m-input"
                    placeholder="رقم الموبايل" value="{{ (isset($row) && $row['mobile'])? $row['mobile']: old('mobile') }}">
            {!! $errors->first('mobile', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('email') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> الإيميل   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="email" class="form-control m-input"
                    placeholder="الإيميل" value="{{ (isset($row) && $row['email'])? $row['email']: old('email') }}">
            {!! $errors->first('email', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('whats') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> الواتس   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="whats" class="form-control m-input"
                    placeholder="الواتس" value="{{ (isset($row) && $row['whats'])? $row['whats']: old('whats') }}">
            {!! $errors->first('whats', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('password') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> كلمة المرور   </label>
        <div class="col-9">
            <input type="password" {{ isset($show)?$show:"" }} name="password" class="form-control m-input">
            {!! $errors->first('password', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('password_confirmation') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> تأكيد كلمة المرور   </label>
        <div class="col-9">
            <input type="password" {{ isset($show)?$show:"" }} name="password_confirmation" class="form-control m-input">
            {!! $errors->first('password_confirmation', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('paypalAccount') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> حساب باي بال   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="paypalAccount" class="form-control m-input"
                    placeholder="حساب باي بال" value="{{ (isset($row) && $row['paypalAccount'])? $row['paypalAccount']: old('paypalAccount') }}">
            {!! $errors->first('paypalAccount', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    


    <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}">
        <label for="name" class="col-1 col-form-label"> الحالة </label>
        <div class="col-9">
            <select name="active"  class="form-control m-input">
                    <option value="1" {{ isset($row) && $row['active']==1? "selected" : "" }} >  فعال </option>
                    <option value="0" {{ isset($row) && $row['active']==0? "selected" : "" }}> غير فعال </option>
            </select>
            {!! $errors->first('validFor', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('file') ? 'has-danger' : ''}}">
        <label for="example-text-input" class="col-1 col-form-label">{{ __('admin.image') }}</label>
            @if(!isset($show))
            <div class="col-9">
            <input class="custom-file-input2" type="file" name="file" value="Upload" id="imgInp" />
            {!! $errors->first('image', '<span class="form-control-feedback">:message</span>') !!}
            </div>
            @endif
                
    </div>
        @if(isset($row['nationalId']) !='')
            <img src="{{Config::get('app.image_url')}}/{{ $row['nationalId'] }}" id="image_file" width="100" height="100" >
        @else
            <img src="" id="image_file" width="100" height="100" style="display:none;">
        @endif





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
                <a type="reset" href="{{url('/admin/'.$route)}}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
