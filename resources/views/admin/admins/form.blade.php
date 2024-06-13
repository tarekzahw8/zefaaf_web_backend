@push('style')
    <style>
 

input[type=checkbox] {
  vertical-align: middle !important;
}

.tree {
  /* margin: 2% auto; */
  /* width: 80%; */
}
ul
{
    list-style: none;
}
.tree ul {
  display: none;
  margin: 4px auto;
  margin-left: 6px;
  border-left: 1px dashed #dfdfdf;
}


.tree li {
  padding: 12px 18px;
  cursor: pointer;
  vertical-align: middle;
  background: #fff;
}

.tree li:first-child {
  border-radius: 3px 3px 0 0;
}

.tree li:last-child {
  border-radius: 0 0 3px 3px;
}

.tree .active,
.active li {
  background: #efefef;
}

.tree label {
  cursor: pointer;
}

.tree input[type=checkbox] {
  margin: -2px 6px 0 0px;
}

.has > label {
  color: #000;
}

.tree .total {
  color: #e13300;
}
    </style>
@endpush


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
                    <label for="name" class="col-1 col-form-label"> الاسم  </label>
                    <div class="col-9">
                        <input type="text" {{ isset($show)?$show:"" }} name="name" class="form-control m-input"
                                placeholder="الاسم" value="{{ (isset($row) && $row['name'])? $row['name']: old('name') }}">
                        {!! $errors->first('name', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group m-form__group row {{ $errors->has('email') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label"> البريد الالكترونى  </label>
                    <div class="col-9">
                        <input type="text" {{ isset($show)?$show:"" }} name="email" class="form-control m-input"
                                placeholder="البريد الالكترونى" value="{{ (isset($row) && $row['email'])? $row['email']: old('email') }}">
                        {!! $errors->first('email', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group m-form__group row {{ $errors->has('password') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label"> كلمة المرور  </label>
                    <div class="col-9">
                        <input type="password" {{ isset($show)?$show:"" }} name="password" class="form-control m-input" placeholder="كلمة المرور" >
                        {!! $errors->first('password', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            
            
                        <div class="form-group m-form__group row {{ $errors->has('type') ? 'has-danger' : ''}}">
                            <label for="type" class="col-1 col-form-label">نوع الصلاحيات</label>
                             <div class="col-9">
                            <select name="type" id="priv_type" {{ isset($show)?$show:"" }} class="form-control m-input">
                            <option value=""> اختر النوع </option>
                            <option value="1" {{ (isset($row) && $row['type'] == 1)? "selected" : "" }}> ادمن عام</option>
                            <option value="0" {{ (isset($row) && $row['type'] == 0)? "selected" : "" }}>  ادمن بصلاحيات</option>
                            </select>
                                {!! $errors->first('type', '<span class="form-control-feedback">:message</span>') !!}
                            </div>
                        </div>

                        <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}" >
                            <label for="active" class="col-1 col-form-label">{{ __('admin.status') }}</label>
                             <div class="col-9">
                            <select name="active" {{ isset($show)?$show:"" }} class="form-control m-input">
                            <option value="1" {{ (isset($row) && $row['active'] == 1)? "selected" : "" }}> فعال</option>
                            <option value="0" {{ (isset($row) && $row['active'] == 0)? "selected" : "" }}> غير فعال</option>
                            </select>
                                {!! $errors->first('active', '<span class="form-control-feedback">:message</span>') !!}
                            </div>
                        </div>

                        <div class="form-group m-form__group row " id="priv_div" style="{{ (isset($row) && $row['type'] == 1)?'display: none' : 'display: block' }}">
                            <label for="active" class="col-1 col-form-label">الصلاحيات</label>
                                <div class="col-9">
                                               
                                    <ul class="tree">
                                        @foreach ($privilege as $key=>$value)
                                        @php
                                            $mouleIdChecked = false;
                                            $moduleWriteChecked = false;
                                            $moduleReadChecked = false;
                                            $moduleDeleteChecked = false;
                                            if(isset($admin_privlages))
                                            {
                                              
                                              $priv_key = array_search($key, array_column($admin_privlages, 'moduleId'));
                                              //dd($admin_privlages,$key,$priv_key);
                                              if ($priv_key !== FALSE)
                                              {
                                                
                                                  $mouleIdChecked = true;
                                                  $PriveRow = $admin_privlages[$priv_key];
                                                  $moduleWriteChecked = $PriveRow['moduleWrite']?true:false;
                                                  $moduleReadChecked = $PriveRow['moduleRead']?true:false;
                                                  $moduleDeleteChecked = $PriveRow['moduleDelete']?true:false;
                                              }
                                            }
                                            //dd(10);
                                        @endphp
                                             <li class="has">
                                                <input type="checkbox" name="moduleId[]"  value="{{$key}}"
                                                {{ $mouleIdChecked? "checked":"" }}>
                                                <label>{{ $value }} <span class="total">(
                                                    @if ($key==6||$key==12||$key==16 || $key==17)
                                                        1
                                                    @elseif($key==11)
                                                      2
                                                    @else
                                                        3
                                                    @endif)</span></label>
                                                <ul>
                                                        @if ($key !=16 && $key==17)
                                                            <li class="">
                                                                <input type="checkbox" name="moduleWrite[{{$key}}]" value="1" {{ $moduleWriteChecked? "checked":"" }}>
                                                                <label>
                                                                    اضافة/تعديل 
                                                                </label>
                                                            </li>
                                                        @endif
                                                        @if ($key !=6 && $key != 12)
                                                                <li class="">
                                                                    <input type="checkbox" name="moduleRead[{{$key}}]" value="1" {{ $moduleReadChecked? "checked":"" }}>
                                                                    <label>عرض </label>
                                                                </li>
                                                            @if ($key !=16 && $key !=11 && $key !=17)
                                                                <li class="">
                                                                    <input type="checkbox" name="moduleDelete[{{$key}}]" value="1" {{ $moduleDeleteChecked? "checked":"" }}>
                                                                    <label>حذف </label>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    
                                                </ul>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
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
                            <a type="reset" href="{{url("admin/$route")}}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            

@push('script')
<script>
$(document).on('click', '.tree label', function(e) {
  $(this).next('ul').fadeToggle();
  e.stopPropagation();
});

$(document).on('change', '.tree input[type=checkbox]', function(e) {
  $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
  $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
  e.stopPropagation();
});

$(document).on('click', 'button', function(e) {
  switch ($(this).text()) {
    case 'Collepsed':
      $('.tree ul').fadeOut();
      break;
    case 'Expanded':
      $('.tree ul').fadeIn();
      break;
    case 'Checked All':
      $(".tree input[type='checkbox']").prop('checked', true);
      break;
    case 'Unchek All':
      $(".tree input[type='checkbox']").prop('checked', false);
      break;
    default:
  }
});

$("#priv_type").change(function () { 
  if(this.value==1)
  {
    $("#priv_div").hide();
  }
  else
  {
    $("#priv_div").show();
  }
})
</script>
@endpush            