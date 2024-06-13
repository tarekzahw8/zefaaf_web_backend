

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

    <div class="form-group m-form__group row {{ $errors->has('title') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> {{ __('admin.title') }} </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="title" class="form-control m-input"
                    placeholder="{{ __('admin.title') }}" value="{{ (isset($row) && $row['title'])? $row['title']: old('title') }}">
            {!! $errors->first('title', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('validFor') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> {{ __('admin.duration') }}{{ __('admin.in months') }} </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="validFor" class="form-control m-input"
                    placeholder="{{ __('admin.duration') }} {{ __('admin.in months') }}" value="{{ (isset($row) && $row['validFor'])? $row['validFor']: old('validFor') }}">
            {!! $errors->first('validFor', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('usdValue') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> {{ __('admin.cost') }}  </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="usdValue" class="form-control m-input"
                    placeholder="{{ __('admin.cost') }} بالدولار" value="{{ (isset($row) && $row['usdValue'])? $row['usdValue']: old('usdValue') }}">
            {!! $errors->first('usdValue', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	
	<div class="form-group m-form__group row {{ $errors->has('countryId') ? 'has-danger' : ''}}">
        <label for="countryId" class="col-2 col-form-label">الدولة</label>
        <div class="col-9">
            <select name="countryId" {{ isset($show)?$show:"" }} class="form-control m-input">
				<option value="0" {{ (isset($row) && $row['countryId'] < 1 )? "selected" : "" }}> الكل </option>
                @foreach ($countries as $key=>$item)
                    <option value="{{ $item['id'] }}" {{ (isset($row) && $row['countryId'] == $item['id'])? "selected" : "" }} > {{ $item['nameAr'] }} </option> 
                @endforeach
                
            </select>
        {!! $errors->first('countryId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	
	<div class="form-group m-form__group row {{ $errors->has('discounted') ? 'has-danger' : ''}}">
        <label for="discounted" class="col-2 col-form-label">سعر الباقة</label>
         <div class="col-9">
        <select name="discounted" {{ isset($show)?$show:"" }} class="form-control m-input">
		<option value="0" {{ (isset($row) && $row['discounted'] !=1)? "selected" : "" }}> افتراضي</option>
        <option value="1" {{ (isset($row) && $row['discounted'] == 1)? "selected" : "" }}> مخفض </option>
        
        </select>
            {!! $errors->first('discounted', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	
	<!--<div class="form-group m-form__group row {{ $errors->has('platinPackage') ? 'has-danger' : ''}}">
        <label for="platinPackage" class="col-2 col-form-label">باقة بلاتينيه</label>
         <div class="col-9">
        <select name="platinPackage" {{ isset($show)?$show:"" }} class="form-control m-input">
		<option value="0" {{ (isset($row) && $row['platinPackage'] !=1)? "selected" : "" }}> لا</option>
        <option value="1" {{ (isset($row) && $row['platinPackage'] == 1)? "selected" : "" }}> نعم </option>
        
        </select>
            {!! $errors->first('platinPackage', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>-->
	
	<div class="form-group m-form__group row {{ $errors->has('packageLevel') ? 'has-danger' : ''}}">
        <label for="packageLevel" class="col-2 col-form-label">مستوي الباقة</label>
         <div class="col-9">
        <select name="packageLevel" {{ isset($show)?$show:"" }} class="form-control m-input">
		<option value="0" {{ (isset($row) && $row['packageLevel'] < 1)? "selected" : "" }}> مجاني</option>
        <option value="1" {{ (isset($row) && $row['packageLevel'] == 1)? "selected" : "" }}> ترحيبية </option>
        <option value="2" {{ (isset($row) && $row['packageLevel'] == 2)? "selected" : "" }}> فضية </option>
        <option value="3" {{ (isset($row) && $row['packageLevel'] == 3)? "selected" : "" }}> ذهبية </option>
        <option value="4" {{ (isset($row) && $row['packageLevel'] == 4)? "selected" : "" }}> بلاتينية </option>
        <option value="5" {{ (isset($row) && $row['packageLevel'] == 5)? "selected" : "" }}> الماسية  </option>
        
        </select>
            {!! $errors->first('packageLevel', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	
	 <div class="form-group m-form__group row {{ $errors->has('usdValue') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> كود الستور  </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="iapId" class="form-control m-input"
                    placeholder=" كود الستور  " value="{{ (isset($row) && $row['iapId'])? $row['iapId']: old('iapId') }}">
            {!! $errors->first('iapId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>



    <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}">
        <label for="active" class="col-2 col-form-label">{{ __('admin.status') }}</label>
         <div class="col-9">
        <select name="active" {{ isset($show)?$show:"" }} class="form-control m-input">
        <option value="1" {{ (isset($row) && $row['active'] == 1)? "selected" : "" }}> مفعل</option>
        <option value="0" {{ (isset($row) && $row['active'] == 0)? "selected" : "" }}> غير مفعل</option>
        </select>
            {!! $errors->first('active', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    
    <div class="form-group m-form__group row {{ $errors->has('file') ? 'has-danger' : ''}}">
        <label for="example-text-input" class="col-1 col-form-label">{{ __('admin.image') }}</label>
            @if(!isset($show))
            <div class="col-9">
            <input class="custom-file-input2" type="file" name="file" value="Upload" id="imgInp" />
            {!! $errors->first('file', '<span class="form-control-feedback">:message</span>') !!}
            </div>
            @endif
                
    </div>
        @if(isset($row['image']) !='')
            <img src="{{Config::get('app.image_url')}}/{{ $row['image'] }}" id="image_file" width="100" height="100" >
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
