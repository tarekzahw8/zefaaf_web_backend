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

    <div class="form-group m-form__group row {{ $errors->has('mobile') ? 'has-danger' : ''}}">
        <label for="mobile" class="col-3 col-form-label"> رقم الموبايل  </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="mobile" class="form-control m-input"
                    placeholder="رقم الموبايل" value="{{ (isset($row) && $row['mobile'])? $row['mobile']: old('mobile') }}">
            {!! $errors->first('mobile', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('userName') ? 'has-danger' : ''}}">
        <label for="userName" class="col-3 col-form-label"> إسم المستخدم  </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="userName" class="form-control m-input"
                    placeholder="إسم المستخدم" value="{{ (isset($row) && $row['userName'])? $row['userName']: old('userName') }}">
            {!! $errors->first('userName', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	
	<div class="form-group m-form__group row {{ $errors->has('detectedCountry') ? 'has-danger' : ''}}">
        <label for="detectedCountry" class="col-3 col-form-label"> الدولة الحقيقية   </label>
        <div class="col-9">
            <input type="text" disabled class="form-control m-input"
                    placeholder="الدولة الحقيقية" value="{{ (isset($row) && $row['detectedCountry'])? $row['detectedCountry']: old('detectedCountry') }}">
            {!! $errors->first('detectedCountry', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('name') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> الإسم   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="name" class="form-control m-input"
                    placeholder="الإسم" value="{{ (isset($row) && $row['name'])? $row['name']: old('name') }}">
            {!! $errors->first('name', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    <div class="form-group m-form__group row {{ $errors->has('email') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> الإيميل   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="email" class="form-control m-input"
                    placeholder="الإيميل" value="{{ (isset($row) && $row['email'])? $row['email']: old('email') }}">
            {!! $errors->first('email', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('password') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> كلمة المرور   </label>
        <div class="col-9">
            <input type="password" {{ isset($show)?$show:"" }} name="password" class="form-control m-input">
            {!! $errors->first('password', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('gender') ? 'has-danger' : ''}}">
        <label for="prayer" class="col-3 col-form-label">النوع</label>
         <div class="col-9">
        <select name="gender" {{ isset($show)?$show:"" }} class="form-control m-input">
                <option value="0" {{ (isset($row) && $row['gender'] == 0) ? "selected" : "" }} >ذكر</option>
                <option value="1" {{ (isset($row) && $row['gender'] == 1) ? "selected" : "" }} >أنثى</option>
        </select>
            {!! $errors->first('prayer', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    {{-- <div class="form-group m-form__group row {{ $errors->has('mobileType') ? 'has-danger' : ''}}">
        <label for="prayer" class="col-3 col-form-label">نوع جهاز العضو</label>
         <div class="col-9">
        <select {{ isset($show)?$show:"" }} class="form-control m-input">
                <option value="0" {{ (isset($row) && $row['mobileType'] == 0) ? "selected" : "" }} >Android</option>
                <option value="1" {{ (isset($row) && $row['mobileType'] == 1) ? "selected" : "" }} >Iphone</option>
        </select>
            {!! $errors->first('mobileType', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div> --}}
    
    <div class="form-group m-form__group row {{ $errors->has('nationalityCountryId') ? 'has-danger' : ''}}">
        <label for="nationalityCountryId" class="col-3 col-form-label">الجنسية</label>
         <div class="col-9">
        <select name="nationalityCountryId" {{ isset($show)?$show:"" }} class="form-control m-input">
            <option value=""> اختر الجنسية  </option>
            @foreach($countries as $key=>$value)
                
                <option value="{{ $value['id'] }}" {{ (isset($row) && $row['nationalityCountryId'] == $value['id'])? "selected" : "" }} > {{ $value['nameAr'] }} </option>
            @endforeach 
        </select>
            {!! $errors->first('nationalityCountryId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    
    <div class="form-group m-form__group row {{ $errors->has('residentCountryId') ? 'has-danger' : ''}}">
        <label for="residentCountryId" class="col-3 col-form-label">مكان الإقامة</label>
         <div class="col-9">
        <select name="residentCountryId" id="residentCountryId" {{ isset($show)?$show:"" }} class="form-control m-input">
            <option value=""> اختر مكان الإقامة </option>
            @foreach($countries as $key=>$value)
                <option value="{{ $value['id'] }}" {{ (isset($row) && $row['residentCountryId'] == $value['id'])? "selected" : "" }} > {{ $value['nameAr'] }} </option>
            @endforeach 
        </select>
            {!! $errors->first('residentCountryId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    

    <div class="form-group m-form__group row {{ $errors->has('cityId') ? 'has-danger' : ''}}">
        <label for="cityId" class="col-3 col-form-label">المدينة </label>
        <div class="col-9">
            <span id="load-cities">
                <select name="cityId" {{ isset($show)?$show:"" }} class="form-control m-input">
                    <option value=""> اختر المدينة </option>
                    @if(isset($cities))
                        @foreach($cities as $key=>$value)
                        @if (isset($row) && $row['residentCountryId'] == $value['countryId'])
                            <option value="{{ $value['id'] }}" {{ (isset($row) && $row['cityId'] == $value['id'])? "selected" : "" }} > {{ $value['nameAr'] }} </option>
                        @endif
                            
                        @endforeach 
                    @endif 
                </select>
            </span>
            
        {!! $errors->first('cityId', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    <div class="form-group m-form__group row {{ $errors->has('mariageStatues') ? 'has-danger' : ''}}">
        <label for="mariageStatues" class="col-3 col-form-label">الحالة الإجتماعية </label>
         <div class="col-9">
        <select name="mariageStatues" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['marriageStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['mariageStatues'] == $item['id'])? "selected" : "" }}>{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('mariageStatues', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('mariageKind') ? 'has-danger' : ''}}">
        <label for="mariageKind" class="col-3 col-form-label">نوع الزواج </label>
         <div class="col-9">
        <select name="mariageKind" {{ isset($show)?$show:"" }} class="form-control m-input">
            <option value="" > اختر نوع الزواج </option>
            @foreach ($fixedData['mariageKind'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['mariageKind'] == $item['id'])? "selected" : "" }}>{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('mariageKind', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('kids') ? 'has-danger' : ''}}">
        <label for="kids" class="col-3 col-form-label"> عدد الأولاد </label>
         <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="kids" class="form-control m-input"
            placeholder="عدد الأولاد" value="{{ (isset($row) && $row['kids'])? $row['kids']: old('kids') }}">
            {!! $errors->first('kids', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('weight') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> الوزن   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="weight" class="form-control m-input"
                    placeholder="الوزن" value="{{ (isset($row) && $row['weight'])? $row['weight']: old('weight') }}">
            {!! $errors->first('weight', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    <div class="form-group m-form__group row {{ $errors->has('height') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> الطول   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="height" class="form-control m-input"
                    placeholder="الطول" value="{{ (isset($row) && $row['height'])? $row['height']: old('height') }}">
            {!! $errors->first('height', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	<div class="form-group m-form__group row {{ $errors->has('age') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> العمر   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="age" class="form-control m-input"
                    placeholder="العمر" value="{{ (isset($row) && $row['age'])? $row['age']: old('age') }}">
            {!! $errors->first('age', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('skinColor') ? 'has-danger' : ''}}">
        <label for="skinColor" class="col-3 col-form-label">لون البشرة </label>
         <div class="col-9">
        <select name="skinColor" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['color'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['skinColor'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        
        </select>
            {!! $errors->first('skinColor', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    <div class="form-group m-form__group row {{ $errors->has('helath') ? 'has-danger' : ''}}">
        <label for="helath" class="col-3 col-form-label">الحالة الصحية </label>
         <div class="col-9">
        <select name="helath" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['medicalStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['helath'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('helath', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    {{-- <div class="form-group m-form__group row {{ $errors->has('religiosity') ? 'has-danger' : ''}}">
        <label for="helath" class="col-3 col-form-label">مستوى التدين </label>
         <div class="col-9">
        <select name="religiosity" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['relegionStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['religiosity'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('religiosity', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div> --}}
    <div class="form-group m-form__group row {{ $errors->has('prayer') ? 'has-danger' : ''}}">
        <label for="prayer" class="col-3 col-form-label">إلتزام الصلاة</label>
         <div class="col-9">
        <select name="prayer" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['prayStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['prayer'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('prayer', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	<div class="form-group m-form__group row {{ $errors->has('veil') ? 'has-danger' : ''}}">
        <label for="prayer" class="col-3 col-form-label"> الحجاب</label>
         <div class="col-9">
        <select name="veil" {{ isset($show)?$show:"" }} class="form-control m-input">
           <option value="">الحجاب</option>
                                      @foreach ($fixedData['veil'] as $key=>$item)
                                        <option value="{{ $item['id'] }}" {{ (isset($row) && $row['veil'] == $item['id'])? "selected" : "" }}>{{ $item['title'] }}</option>    
                                      @endforeach
        </select>
            {!! $errors->first('veil', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
	
	
    <div class="form-group m-form__group row {{ $errors->has('smoking') ? 'has-danger' : ''}}">
        <label for="smoking" class="col-3 col-form-label">حالة التدخين</label>
         <div class="col-9">
        <select name="smoking" {{ isset($show)?$show:"" }} class="form-control m-input">
            <option value="0" {{ (isset($row) && $row['smoking'] == 0)? "selected" : "" }} >لا</option>  
            <option value="1" {{ (isset($row) && $row['smoking'] == 1)? "selected" : "" }} >نعم</option>  
            {{-- @foreach ($fixedData['smokingStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['smoking'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach --}}
        </select>
            {!! $errors->first('smoking', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="form-group m-form__group row {{ $errors->has('education') ? 'has-danger' : ''}}">
        <label for="education" class="col-3 col-form-label">المؤهل التعليمي</label>
         <div class="col-9">
        <select name="education" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['study'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['education'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('education', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="form-group m-form__group row {{ $errors->has('financial') ? 'has-danger' : ''}}">
        <label for="financial" class="col-3 col-form-label">الوضع المادي</label>
         <div class="col-9">
        <select name="financial" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['moneyStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['financial'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('financial', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('job') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> الوظيفة   </label>
        <div class="col-9">
            <input type="text" {{ isset($show)?$show:"" }} name="job" class="form-control m-input"
                    placeholder="الوظيفة" value="{{ (isset($row) && $row['job'])? $row['job']: old('job') }}">
            {!! $errors->first('job', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('workField') ? 'has-danger' : ''}}">
        <label for="workField" class="col-3 col-form-label">مجال العمل</label>
         <div class="col-9">
        <select name="workField" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['job'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['workField'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('workField', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="form-group m-form__group row {{ $errors->has('income') ? 'has-danger' : ''}}">
        <label for="income" class="col-3 col-form-label">مستوى الدخل الشهري</label>
         <div class="col-9">
        <select name="income" {{ isset($show)?$show:"" }} class="form-control m-input">
            @foreach ($fixedData['financeStatus'] as $key=>$item)
                <option value="{{ $item['id'] }}" {{ (isset($row) && $row['income'] == $item['id'])? "selected" : "" }} >{{ $item['title'] }}</option>    
            @endforeach
        </select>
            {!! $errors->first('income', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>


    <div class="form-group m-form__group row {{ $errors->has('aboutOther') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> مواصفات الشريك  </label>
        <div class="col-9">
            <textarea {{ isset($show)?$show:"" }} name="aboutOther" class="form-control m-input" rows="10" placeholder="مواصفات الشريك " >{{ (isset($row) && $row['aboutOther'])? $row['aboutOther']: old('aboutOther') }}</textarea>
            {!! $errors->first('aboutOther', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    
    <div class="form-group m-form__group row {{ $errors->has('aboutMe') ? 'has-danger' : ''}}">
        <label for="name" class="col-3 col-form-label"> عن العضو </label>
        <div class="col-9">
            <textarea {{ isset($show)?$show:"" }} name="aboutMe" class="form-control m-input" rows="10" placeholder="عن العضو  " >{{ (isset($row) && $row['aboutMe'])? $row['aboutMe']: old('aboutMe') }}</textarea>
            {!! $errors->first('aboutMe', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>



    <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}">
        <label for="active" class="col-3 col-form-label">{{ __('admin.status') }}</label>
         <div class="col-9">
        <select name="active" {{ isset($show)?$show:"" }} class="form-control m-input">
        <option value="1" {{ (isset($row) && $row['active'] == 1)? "selected" : "" }}> فعال</option>
        <option value="0" {{ (isset($row) && $row['active'] == 0)? "selected" : "" }}> غير فعال</option>
        </select>
            {!! $errors->first('active', '<span class="form-control-feedback">:message</span>') !!}
        </div>
    </div>
    

  


    <div class="form-group m-form__group row {{ $errors->has('file') ? 'has-danger' : ''}}">
            <label for="example-text-input" class="col-3 col-form-label">{{ __('admin.image') }}</label>
                @if(!isset($show))
                <div class="col-9">
                <input class="custom-file-input2" type="file" name="file" value="Upload" id="imgInp" />
				<input name="img_deleted" id="img_deleted" value="0" type="hidden"/>
                {!! $errors->first('image', '<span class="form-control-feedback">:message</span>') !!}
                </div>
                @endif
                    
        </div>
            @if(isset($row['profileImage']) !='')
                <img src="{{Config::get('app.image_url')}}/{{ $row['profileImage'] }}" id="image_file" width="100" height="100" style="cursor: pointer;">
            @else
                <img src="" id="image_file" width="100" height="100" style="display:none;"  style="cursor: pointer;">
            @endif
			@if(isset($row['profileImage']) !='')
				<a href="javascript:;" class="btn btn-danger" id="delete-image"> حذف الصورة </a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: unset;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		@if(isset($row['profileImage']) !='')
        <img src="{{Config::get('app.image_url')}}/{{ $row['profileImage'] }}" width="100%" height="100%">
		@else
            <img src="" width="100%" height="100%">
        @endif
      </div>
     
    </div>
  </div>
</div>


@push('script')
    <script>
        $("#residentCountryId").change(function(){
            let country_id = this.value;
            $.get( "{{url('/admin/user/cities')}}", { country_id: country_id } )
            .done(function( data ) {
                $("#load-cities").html(data);
            });
        });
		$("#image_file").click(function(){
			$('#exampleModal').modal('show');
		});
		
		
		$("#delete-image").click(function(){
			$('#image_file').attr('src','');
			$('#image_file').hide();
			$('#img_deleted').val(1);
		});
		
    </script>
@endpush