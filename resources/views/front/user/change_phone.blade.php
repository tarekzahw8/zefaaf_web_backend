@extends('front.layouts.app')
@section('content')
 <!-- Start register form-->
            <div class="register-form p-5 min-height-footer">
               <div class="container">
               <h3 class="sub-title">تغيير  رقم الهاتف</h3>

                  <div class="forgot-form register-input">
                    <form id="MainForm1">
                      <div class="d-flex justify-content-between">
                        <div class="form-group tel-input">
                            <input type="tel" class="form-control" name="mobile" placeholder="رقم الموبايل">
                        </div>
                        <div class="form-group select-country">
                          <select class="form-control" name="mobileCode">
                            @foreach($countries as $key=>$value)
                            <option value="{{ $value['phoneCode'] }}"> {{ $value['phoneCode'] }} </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <select class="form-control" name="country">
                            @foreach($countries as $key=>$value)
                            <option value="{{ $value['phoneCode'] }}"> {{ $value['nameAr'] }} </option>
                            @endforeach
                        </select>
                      </div>
                      <button type="button" class="btn btn-primary main-btn register-btn">التالي</button>
                    </form>
                  </div>

                  <!-- activation code -->
                  <div class="activation-form text-center">
                    <h5><img src="{{url('/')}}/front/imgs/settings.png" alt="secure">كود التحقق</h5>
                    <p class="my-md-4 my-3">لقد ارسلنا رسالة نصية الي <span id="phoneNo">111****</span> تشمل ع لي رمز <span class="mt-2 d-block">ادخل رمز التحقيق</span> <span id="verify_code"></span></p>
                    
                    <form class="d-flex justify-content-center" id="verifySms">
                      <div class="form-group">
                        <input type="text" class="form-control" name="code1">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="code2">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="code3">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="code4">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="code5">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="code6">
                      </div>
                    </form>
                    <button class="btn btn-link btn-block" id="ResendBtn">اعاده ارسال الكود مره اخري</button>
                    <button class="btn btn-primary main-btn activation-btn">تم</button>
                  </div>
                
                  
               </div>
            </div> 
           
@endsection		


@push('script')
<script>
    $('.register-btn').click(function(){
        let mobile = $("input[name=mobile]").val();
        let country = $('select[name="country"] option:selected').val();
        let mobileCode = $('select[name="country"] option:selected').val();
        if(!mobile){
          toastr.error("رقم الهاتف مطلوب");
          return false;
        }
        if(!mobileCode){
          toastr.error("كود الدولة مطلوب");
          return false;
        }
        if(!country){
          toastr.error("الدولة مطلوبة");
          return false;
        }
        let phoneNo = mobile.substr(mobile.length - 3);
        $("#phoneNo").text(phoneNo+"*****");
        $.ajax({
          type:'POST',
          url:base_url+"/send/sms/change/phone",
          data:{mobile:mobile, mobileCode:mobileCode},
          success:function(data){
            if(data.success){
                var code = "{{ Session::get('change_phone_code') }}";
                $("#verify_code").text(" الرمز هو  "+code);
                $('.register-input').hide();
                $('.register-form .activation-form').show();
            }
            else
            {
              toastr.error(data.message);
            }
          }
        });

        
    });

    $('.activation-btn').click(function(){
        let code = "{{ Session::get('change_phone_code') }}";
        var formData = $("#verifySms").serializeArray();
        var verified_code = '';
        for(var i=0;i<formData.length;i++){
            verified_code+=formData[i].value;
        }
        if(verified_code == code){
            let mobile = $("input[name=mobile]").val();
            $.ajax({
                type:'POST',
                url:base_url+"/user/change/phone",
                data:{mobile:mobile},
                    success:function(data){
                        if(data.success){
                            toastr.success(data.msg);
                            window.setTimeout(function() {
                                window.location.href = base_url;
                            }, 5000);
                        }
                        else
                        {
                            toastr.error(data.msg);   
                        }
                    }
                });
        }
        else
        {
            toastr.error("كود التفعيل غير صحيح");
        }
        
    });

</script>
@endpush