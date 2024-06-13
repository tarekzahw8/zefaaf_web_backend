

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


    <div class="form-group m-form__group row {{ $errors->has('type') ? 'has-danger' : ''}}">
        <label for="type" class="col-2 col-form-label">التصنيف</label>
        <div class="col-9">
            <select {{ !isset($create) ? "disabled" : ""  }}  name="reasonId"  class="form-control m-input">
                @foreach ($reasons as $key=>$item)
                    <option value="{{ $key }}" {{ (isset($row) && $row['reasonId'] == $key)? "selected" : "" }}> {{ $item }}</option> 
                @endforeach
                
            </select>
        {!! $errors->first('type', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('userName') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> العضو </label>
        <div class="col-9">
            <input type="text" disabled class="form-control m-input"
                    placeholder="العضو" value="{{ (isset($user) && $user['userName'])? $user['userName']: old('userName') }} {{ (isset(request()->user_name))? request()->user_name:'' }} ">
            {!! $errors->first('userName', '<span class="form-control-feedback">:message</span>') !!}
            <input type="hidden" name="userId" value="{{ (isset($user) && $user['id'])? $user['id']: old('id') }} {{ (isset(request()->userId))? request()->userId:'' }} " />
        </div>
    </div>
    @if (isset($row)&&$row['reasonId'] ==1)
        <div class="form-group m-form__group row {{ $errors->has('userName') ? 'has-danger' : ''}}">
            <label for="name" class="col-2 col-form-label"> العضو المشكو فى حقه </label>
            <div class="col-9">
                <input type="text" disabled class="form-control m-input"
                        placeholder="العضو" value="{{ (isset($otherUser) && $otherUser['userName'])? $otherUser['userName']: old('userName') }}">
                {!! $errors->first('userName', '<span class="form-control-feedback">:message</span>') !!}
            </div>
        </div>
    @endif
    
    @if(isset(request()->userId))
    <input type="hidden" name="userId" value="{{ request()->userId }}" />    
    @endif
   
    <div class="form-group m-form__group row {{ $errors->has('title') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> العنوان </label>
        <div class="col-9">
            <input type="text" name="title" {{ !isset($create) ? "disabled" : ""  }}  class="form-control m-input"
                    placeholder="العنوان" value="{{ (isset($row) && $row['title'])? $row['title']: old('title') }}">
            {!! $errors->first('title', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    <div class="form-group m-form__group row {{ $errors->has('post') ? 'has-danger' : ''}}">
        <label for="name" class="col-2 col-form-label"> محتوى الرسالة  </label>
        <div class="col-9">
            <textarea {{ !isset($create) ? "disabled" : ""  }}  class="form-control m-input" rows="10" placeholder="محتوى الرسالة" >{!! (isset($row) && $row['message'])? $row['message']: old('message') !!}</textarea>
            {!! $errors->first('post', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    @if(isset($row)&&$row['image'])
        <div class="form-group m-form__group row ">
            <label for="name" class="col-2 col-form-label"> الصورة  </label>
            <div class="col-9">
                    <img src="{{Config::get('app.image_url')}}/{{ isset($row)&&$row['image']?$row['image']:"" }}" style="width:100%">
					<a target="_blank" href="{{Config::get('app.image_url')}}/{{ isset($row)&&$row['image']?$row['image']:"" }}" download><img src="{{asset('public/download.png')}}" width="30px" style="margin-top:10px"></a>
            </div>
        </div>
    @endif
            <div class="form-group m-form__group row {{ $errors->has('reply') ? 'has-danger' : ''}}">
                <label for="name" class="col-2 col-form-label"> الرد  </label>
                <div class="col-9">
                    <textarea name="reply"  {{ (isset($row) && $row['owner'] ==1)?"disabled" : "" }} class="form-control m-input" rows="10" placeholder="الرد" >{{ (isset($row) && isset($row['reply']))? $row['reply']: old('reply') }}</textarea>
                    {!! $errors->first('reply', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
    @if(isset($create))
        <input type="hidden" name="owner" value="1" />    
    @endif
	
	
	
    <div class="form-group m-form__group row {{ $errors->has('file') ? 'has-danger' : ''}}">
        <label for="example-text-input" class="col-1 col-form-label">{{ __('admin.image') }}</label>
            @if(!isset($show))
            <div class="col-9">
            <input class="custom-file-input2" type="file" name="file" value="Upload" id="imgInp" />
            {!! $errors->first('file', '<span class="form-control-feedback">:message</span>') !!}
            </div>
            @endif
                
    </div>
        @if(isset($row['adminImage']) !='')
            <img src="{{Config::get('app.image_url')}}/{{ $row['adminImage'] }}" id="image_file" width="100" height="100" >
        @else
            <img src="" id="image_file" width="100" height="100" style="display:none;">
        @endif
		
		
		<a href="javascript:;" class="btn btn-danger" id="delete-image"> حذف الصورة </a>




</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-9">
                @if(!isset($show))
                    @if((isset($row) && $row['owner'] !=1) || !isset($row))
                        <button type="submit" class="btn btn-brand">{{ __('admin.Submit') }}</button>
                    @endif
                @endif
                <a type="reset" href="{{url('/admin/'.$route)}}{{ (isset($user) && $user["id"])? "?userId=".$user["id"]:"" }}{{ (isset($user) && $user["userName"])? "&user_name=".$user["userName"]:"" }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
       
		$("#delete-image").click(function(){
			$('#image_file').attr('src','');
			$('#image_file').hide();
			$('#img_deleted').val(1);
		});
		
	


</script>
		
    </script>
@endpush