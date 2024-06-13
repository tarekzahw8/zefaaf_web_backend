

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




    
    <div class="form-group m-form__group row {{ $errors->has('package_id') ? 'has-danger' : ''}}">
                <label for="role_id" class="col-2 col-form-label">{{ __('admin.package_id') }}</label>
                 <div class="col-9">
                <select name="package_id" {{ isset($show)?$show:"" }} class="form-control m-input">
                <option value="" > {{ __('admin.package') }}</option>
                @if($packages)    
                @foreach($packages as $item)
                <option value="{{$item->id}}" {{ (isset($row) && $row->package_id == $item->id)? "selected" : "" }}> {{$item->title}}</option>
                @endforeach
                @endif
                </select>
                    {!! $errors->first('is_free', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>


    <div class="form-group m-form__group row {{ $errors->has('title_ar') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> {{ __('admin.title') }} {{ __('admin.in arabic') }} </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="title_ar" class="form-control m-input"
                    placeholder="{{ __('admin.title') }} {{ __('admin.in arabic') }}" value="{{ (isset($row) && $row->title_ar)? $row->title_ar: old('title_ar') }}">
            {!! $errors->first('title_ar', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('title_en') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> {{ __('admin.title') }}  {{ __('admin.in english') }}</label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="title_en" class="form-control m-input en_text"
                    placeholder="{{ __('admin.title') }} {{ __('admin.in english') }}" value="{{ (isset($row) && $row->title_en)? $row->title_en: old('title_en') }}">
            {!! $errors->first('title_en', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>



    <div class="form-group m-form__group row {{ $errors->has('desc_ar') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label">{{ __('admin.desc') }} {{ __('admin.in arabic') }}</label>
                <div class="col-9">
                    <textarea class="form-control m-input" {{ isset($show)?$show:"" }} placeholder="{{ __('admin.desc') }} {{ __('admin.in arabic') }}" name="desc_ar" >{{ (isset($row) && $row->desc_ar)? $row->desc_ar: old('desc_ar') }}</textarea>
                    {!! $errors->first('desc_ar', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>

            <div class="form-group m-form__group row {{ $errors->has('desc_en') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label">{{ __('admin.desc') }}  {{ __('admin.in english') }}</label>
                <div class="col-9">
                    <textarea class="form-control m-input en_text" {{ isset($show)?$show:"" }} placeholder="{{ __('admin.desc') }} {{ __('admin.in english') }}" name="desc_en" >{{ (isset($row) && $row->desc_en)? $row->desc_en: old('desc_en') }}</textarea>
                    {!! $errors->first('desc_en', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>



    <div class="form-group m-form__group row {{ $errors->has('type') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> {{ __('admin.type') }} </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="type" class="form-control m-input"
                    placeholder="{{ __('admin.type') }}" value="{{ (isset($row) && $row->type)? $row->type: old('type') }}">
            {!! $errors->first('type', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('image') ? 'has-danger' : ''}}">
            <label for="example-text-input" class="col-1 col-form-label">{{ __('admin.image') }}</label>
                @if(!isset($show))
                <div class="col-9">
                <input class="custom-file-input2" type="file" name="file" value="Upload" id="imgInp" />
                {!! $errors->first('image', '<span class="form-control-feedback">:message</span>') !!}
                </div>
                @endif
                    
        </div>
            @if(isset($row->image) !='')
                <img src="{{ $row->image }}" id="image_file" width="100" height="100" >
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
                <a type="reset" href="{{url(app()->getLocale().'/admin/'.$route)}}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
