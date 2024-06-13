


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

                <div class="form-group m-form__group row {{ $errors->has('catId') ? 'has-danger' : ''}}">
                    <label for="catId" class="col-1 col-form-label">التصنيف</label>
                    <div class="col-9">
                        <select name="catId" {{ isset($show)?$show:"" }} class="form-control m-input">
                            @foreach ($cats as $key=>$item)
                                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['catId'] == $item['id'])? "selected" : "" }}> {{ $item['title'] }}</option> 
                            @endforeach
                            
                        </select>
                    {!! $errors->first('catId', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            
                <div class="form-group m-form__group row {{ $errors->has('title') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label"> العنوان  </label>
                    <div class="col-9">
                        <input type="text" {{ isset($show)?$show:"" }} name="title" class="form-control m-input"
                                placeholder="العنوان" value="{{ (isset($row) && $row['title'])? $row['title']: old('title') }}">
                        {!! $errors->first('title', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            
                <div class="form-group m-form__group row {{ $errors->has('post') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label"> التفاصيل  </label>
                    <div class="col-9">
                        <textarea {{ isset($show)?$show:"" }} id="kt-ckeditor-5" name="post" class="form-control m-input" rows="10" placeholder="التفاصيل" >{{ (isset($row) && $row['post'])? $row['post']: old('post') }}</textarea>
                        {!! $errors->first('post', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            
            
                        <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}">
                            <label for="active" class="col-1 col-form-label">{{ __('admin.status') }}</label>
                             <div class="col-9">
                            <select name="active" {{ isset($show)?$show:"" }} class="form-control m-input">
                            <option value="1" {{ (isset($row) && $row['active'] == 1)? "selected" : "" }}> فعال</option>
                            <option value="0" {{ (isset($row) && $row['active'] == 0)? "selected" : "" }}> غير فعال</option>
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
                        @if(isset($row['featureImage']) !='')
                            <img src="{{Config::get('app.image_url')}}/{{ $row['featureImage'] }}" id="image_file" width="100" height="100" >
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
                            <a type="reset" href="{{url("admin/$route")}}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            