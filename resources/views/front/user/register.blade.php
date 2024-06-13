@extends('front.layouts.app')
@section('content')
 <!-- Start register form-->
            <div class="register-form p-5" style="min-height: 425px;">
               <div class="container">
                  <h3 class="sub-title">تسجيل حساب جديد
                    <span>بيانات الحساب الشخصية</span>
                  </h3>

                  <div class="forgot-form register-input">
                    <form id="MainForm1">
                      <div class="d-flex justify-content-between">
                        <div class="form-group tel-input">
                            <input type="tel" class="form-control" id="reg_mobile" name="mobile" placeholder="رقم الموبايل">

                        </div>
                        <div class="form-group select-country">
                          <select class="form-control" name="mobileCode">
                            @foreach($countries as $key=>$value)
                            <option value="{{ $value['phoneCode'] }}" >{{ $value['nameAr'] }} {{ $value['phoneCode'] }}  </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <select class="form-control" name="country">
                            @foreach($countries as $key=>$value)
                            <option value="{{ $value['phoneCode'] }}"> {{ $value['nameAr'] }} </option>
                            @endforeach
                        </select>
                      </div> -->
                      <div id="recaptcha-container"></div>
                      <button type="button" class="btn btn-primary main-btn register-btn" id="register-btn" disabled>التالي </button>
                    </form>
                  </div>

                  <!-- activation code -->
                  <div class="activation-form text-center">
                    {{-- <h5><img src="{{url('/')}}/front/imgs/settings.png" alt="secure">كود التحقق</h5> --}}
                    <div class="imgTitCover">
                      <img src="{{url('/')}}/front/imgs/verify.png" alt="verify">
                    </div>
                    <p class="my-md-4 my-3">تم إرسال كود التحقق إلى الهاتف  <span id="phoneNo">111****</span> <span class="mt-2 d-block">أدخل رمز التحقق</span> <span id="verify_code"></span></p>

                    <form class="d-flex justify-content-center" id="verifySms">
                      <div class="form-group">
                        <input type="text" class="form-control confirm-code" data-point="1" maxlength="1" name="code1">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control confirm-code" data-point="2" maxlength="1" name="code2">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control confirm-code" data-point="3" maxlength="1" name="code3">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control confirm-code" data-point="4" maxlength="1" name="code4">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control confirm-code" data-point="5" maxlength="1" name="code5">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control confirm-code" data-point="6" maxlength="1" name="code6">
                      </div>
                    </form>
                    <button class="btn btn-link btn-block" id="ResendBtnRegister">إعادة إرسال الكود مرة أخرى
                      <span id="timer_text"> بعد <span id="timing"></span> </span>
                    </button>

                    <button class="btn btn-primary main-btn activation-btn" id="ConfirmCode" disabled>تم</button>
                  </div>

                  <div class="register-steps">
                    <div id="stepwizard">
                        <ul class="nav stepper mb-5">
                            <li class="nav-item"><a href="#step1" class="nav-link"><span>1</span></a></li>
                            <li class="nav-item"><a href="#step2" class="nav-link"><span>2</span></a></li>
                            <li class="nav-item"><a href="#step3" class="nav-link"><span>3</span></a></li>
                            <li class="nav-item"><a href="#step4" class="nav-link"><span>4</span></a></li>
                            <li class="nav-item"><a href="#step5" class="nav-link"><span>5</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="step1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                              <h3>شروط التسجيل</h3>
                              <p>
                                {!! $settings['registerLicense'] !!}
                              </p>
                              <div class="form-check mt-2">
                                <input type="checkbox" name="accept" value="1" class="form-check-input" id="accept">
                                <label class="form-check-label" for="accept">موافق وأقسم على ما سبق</label>
                              </div>
                              <div class="d-flex select-option my-4">
                                <span> برجاء إختيار نوع التسجيل  </span>
                              </div>

                              <div class="d-flex select-option my-4">
                                <span>أبحث عن زوجة - أنا ذكر</span>
                                <span style="margin-right: 45px;">أبحث عن زوج - أنا أنثى</span>
                              </div>
                              <div class="d-flex select-option my-4">
                                <img src="{{url('/')}}/front/imgs/mr.png" alt="mr" class="select-type" data-gender="0">
                                <img src="{{url('/')}}/front/imgs/mrs.png" alt="mrs" class="select-type" data-gender="1">
                              </div>
                            </div>

                            <div id="step2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                              <form class="main-form" id="MainForm2">
                                <input type="hidden" name="gender" id="reg_gender" value="" />
                                <div class="mb-5">
                                    <h3>بيانات الحساب</h3>
                                    <span class="note" style="color:red">إسمك الذي سيظهر على الموقع ولا يمكن تغييره</span>
                                    <div class="form-group">
                                      {{-- <span style="color:red">  إسم المستخدم يجب ان يكون من 8 الى 12 حروف ويجب ان يكون حروف عربي وانجليزي وارقام فقط اي علامات اخري تعطي خطا </span> --}}
                                      <div style="display: inline-flex;width: 100%;">
                                        <input type="text" name="userName" id="userName" class="form-control" placeholder="إسم المستخدم">
                                        <span id="success-icon" style="display: none">
                                          <img src="{{ url('/front/imgs/success.png') }}" style="width: 30px;height: 30px;">
                                        </span>
                                        <span id="failed-icon" style="display: none">
                                          <img src="{{ url('/front/imgs/failed.png') }}" style="width: 30px;height: 30px;">
                                        </span>

                                      </div>
                                        <input type="hidden" name="checkUser" id="checkUser" value="0"/>
                                    </div>
                                    <div class="form-group">
                                        <span style="color:red"> من 8 إلى 12 حرف </span>
                                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirmation_password" class="form-control" placeholder="تأكيد كلمة المرور">
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <h3>البيانات الشخصية</h3>
                                    <div class="form-group">
                                      <select class="form-control" name="nationalityCountryId">
                                        <option>اختيار الجنسية</option>
                                        @foreach($countries as $key=>$value)
                                          <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="residentCountryId" id="residentCountryId">
                                            <option>مكان الإقامة</option>
                                            @foreach($countries as $key=>$value)
                                              <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <span id="selected_city">
                                        <select class="form-control" name="cityId">
                                            <option>المدينة </option>
                                        </select>
                                        </span>
                                    </div>
                                    {{--<div class="form-group">
										<span style="color:red">إسمك الحقيقي لن يظهر للمستخدمين</span>
                                      <input type="text" name="name" class="form-control" placeholder="الإسم بالكامل">
									</div>--}}
                                  {{-- <div class="form-group">
                                    <span style="color:red"> يجب كتابة البريد الإلكتروني بشكل صحيح </span>
                                      <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني">
                                  </div> --}}
                                </div>
                              </form>
                            </div>

                            <div id="step3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                              <form class="main-form" id="MainForm3">
                                <div class="mb-5">
                                  <h3>الحالة الإجتماعية</h3>
                                  <div class="form-group">
                                    <input name="age" type="number" class="form-control max-length-input2" placeholder="العمر" maxlength="2">
                                  </div>

                                  <div class="form-group">
                                    <select class="form-control" name="mariageStatues" id="marriageStatus">
                                      <option value="">الحالة الإجتماعية</option>
                                      {{-- @foreach ($fixedData['marriageStatus'] as $key=>$item)
                                        <option value="{{ $item['id'] }}" data-gender="{{ $item['gender'] }}">{{ $item['title'] }}</option>
                                      @endforeach --}}
                                      {{-- <option value="0">أعزب</option>
                                      <option value="1">متزوج</option>
                                      <option value="2">مطلق</option>
                                      <option value="3">أرمل</option> --}}
                                    </select>
                                  </div>
                                  <span id="check-marriageStatusMale" style="display: none">
                                    <div class="form-group">
                                      <select class="form-control" name="mariageKind">
                                        <option value="">نوع الزواج</option>
                                        @foreach ($fixedData['mariageKind'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                        @endforeach
                                        {{-- <option value="0">أعزب</option>
                                        <option value="1">متزوج</option>
                                        <option value="2">مطلق</option>
                                        <option value="3">أرمل</option> --}}
                                      </select>
                                    </div>
                                  </span>
                                  <span id="check-marriageStatus" style="display: none">


                                    <div class="form-group">
                                        <input type="number" name="kids" class="form-control max-length-input2" placeholder="عدد الاطفال" >
                                    </div>
                                  </span>

                                </div>

                                <div class="mb-2">
                                  <h3>المواصفات الجسدية</h3>
                                  <div class="row">
                                      <div class="col-sm-6 form-group">
										<select class="form-control" name="weight">
                                        <option value=""> الوزن </option>
                                        @for($i=40;$i<=200;$i++)
											<option value="{{ $i }}"> {{ $i }} ك ج</option>
										@endfor
										</select>
                                        <!--<input type="number" name="weight" class="form-control max-length-input" placeholder="الوزن" maxlength="3">-->
                                      </div>
                                      <div class="col-sm-6 form-group">
										<select class="form-control" name="height">
                                        <option value=""> الطول </option>
                                        @for($i=110;$i<=250;$i++)
											<option value="{{ $i }}"> {{ $i }} سم</option>
										@endfor
										</select>
                                        <!--<input type="number" name="height" class="form-control max-length-input" placeholder="الطول" maxlength="3">-->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {{-- <input type="text" name="skinColor" class="form-control" placeholder="لون البشرة"> --}}
                                      <select class="form-control" name="skinColor">
                                        <option value="">لون البشرة</option>
                                        @foreach ($fixedData['color'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      {{-- <input type="text" name="helath" class="form-control" placeholder="الحالة الصحية"> --}}
                                      <select class="form-control" name="helath">
                                        <option value="">الحالة الصحية</option>
                                        @foreach ($fixedData['medicalStatus'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  {{-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="بنية الجسم">
                                </div> --}}
                                </div>
                              </form>
                            </div>

                            <div id="step4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                              <form class="main-form" id="MainForm4">
                                <div class="mb-5">
                                  <h3>الصلاة</h3>
                                  {{-- <div class="form-group"> --}}
                                    {{-- <input type="number" name="religiosity" class="form-control" placeholder="مستوى التدين"> --}}
                                    {{-- <select class="form-control" name="religiosity">
                                      <option value="">مستوى التدين </option>
                                      @foreach ($fixedData['relegionStatus'] as $key=>$item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                      @endforeach
                                    </select> --}}
                                  {{-- </div> --}}

                                  <div class="form-group">
                                    <select class="form-control" name="prayer">
                                      <option value=""> الصلاة</option>
                                      @foreach ($fixedData['prayStatus'] as $key=>$item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                   <div class="form-group" id="veil" style="display: none">
                                    <select class="form-control" name="veil">
                                      <option value="">الحجاب</option>
                                      @foreach ($fixedData['veil'] as $key=>$item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="form-group">
                                      <label> التدخين</label>
                                      <div class="smoking">
                                        <div class="custom-control custom-radio custom-control-inline">
                                          {{-- <input type="radio" value="{{ ($fixedData['smokingStatus'] && $fixedData['smokingStatus'][0])?$fixedData['smokingStatus'][0]['id']:''  }}" id="customRadioInline1" name="smoking" class="custom-control-input"> --}}
                                          <input type="radio" value="0" id="customRadioInline1" name="smoking" class="custom-control-input">
                                          <label class="custom-control-label" for="customRadioInline1">لا</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                          {{-- <input type="radio" value="{{ ($fixedData['smokingStatus'] && $fixedData['smokingStatus'][1])?$fixedData['smokingStatus'][1]['id']:''  }}" id="customRadioInline2" name="smoking" class="custom-control-input"> --}}
                                          <input type="radio" value="1" id="customRadioInline2" name="smoking" class="custom-control-input">
                                          <label class="custom-control-label" for="customRadioInline2">نعم</label>
                                        </div>
                                      </div>
                                  </div>
                                </div>

                                <div class="mb-2">
                                  <h3>الدراسة والعمل</h3>
                                  <div class="form-group">
                                      <select class="form-control" name="education">
                                        <option value="">المؤهل التعليمي</option>
                                        @foreach ($fixedData['study'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                        @endforeach
                                      </select>
                                  </div>

                                  <div class="form-group">
                                    <select class="form-control" name="financial">
                                      <option value="">الوضع المادي</option>
                                        @foreach ($fixedData['moneyStatus'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <select class="form-control" name="workField">
                                      <option value="">مجال العمل</option>
                                      @foreach ($fixedData['job'] as $key=>$item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <input type="text" class="form-control" name="job" placeholder="الوظيفة" maxlength="10">
                                  </div>

                                  <div class="form-group">
                                    <select class="form-control" name="income">
                                      <option value="">مستوى الدخل الشهري</option>
                                      @foreach ($fixedData['financeStatus'] as $key=>$item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </form>
                            </div>

                            <div id="step5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                              <form class="main-form" id="MainForm5">
                                <div class="mb-5">
									<span style="color:red">يجب إدخال ما بين 10 إلى 50 حرف</span>
                                  <h3>إكتب مواصفات شريك حياتك هنا باختصار</h3>
                                  <div class="form-group">
                                    <textarea name="aboutOther" id="aboutOther" class="form-control" rows="7" placeholder="يرجى اختيار كلمات تليق بأخلاقك كمسلم ويمنع كتابة أي رموز أو علامات تكون في الوصف"></textarea>
                                  </div>
                                </div>

                                <div class="mb-2">
									<span style="color:red">يجب إدخال ما بين 10 إلى 200 حرف</span>
                                  <h3> تحدث عن نفسك باختصار</h3>
                                  <div class="form-group">
                                    <textarea name="aboutMe" id="aboutMe" class="form-control" rows="7" placeholder="يرجى اختيار كلمات تليق بأخلاقك كمسلم ويمنع كتابة أي رموز أو علامات تكون في الوصف"></textarea>
                                  </div>
                                </div>

								<div class="mb-2">
                                  <h3> كود المندوب</h3>
                                  <div class="form-group">
                                    <input type="text" name="telesalesCode" class="form-control" placeholder=" أدخل كود المندوب الترويجي للحصول على الخصم">
                                  </div>
                                </div>
                              </form>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block main-btn" id="SubmitMainForm" style="width:20%;margin-top: 5px;height: 45px;display:none"> تسجيل </button>
                    </div>
                  </div>
               </div>
            </div>

@endsection


@push('script')
<script>
      $("#ResendBtnRegister").click(function(){
        submitPhoneNumberAuth();
      });
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "invisible",
        }
      );
    $('.register-btn').click(function(){
        let mobile = $("input[name=mobile]").val();
        // let country = $('select[name="country"] option:selected').val();
        let mobileCode = $('select[name="mobileCode"] option:selected').val();

        if(!mobile){
          toastr.error("رقم الهاتف مطلوب");
          return false;
        }
        if(!mobileCode){
          toastr.error("كود الدولة مطلوب");
          return false;
        }
        // if(!country){
        //   toastr.error("الدولة مطلوبة");
        //   return false;
        // }
        $.LoadingOverlay("show");
        let phoneNo = mobile.substr(mobile.length - 3);
        $("#phoneNo").text(phoneNo+"*****");
        var number = '+2' + mobile;
        $.ajax({
          type:'POST',
          url:base_url+"/send/sms",
          data:{mobile:mobile, mobileCode:mobileCode},
          success:function(data){
            $.LoadingOverlay("hide");
            if(data.success){
                // $('.register-input').hide();
                // $('.register-steps').show();
                var code = "{{ Session::get('verify_code') }}";
                submitPhoneNumberAuth();
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

    $('#ConfirmCode').click(function(){
        let code = "{{ Session::get('verify_code') }}";
        var formData = $("#verifySms").serializeArray();
        var verified_code = '';
        for(var i=0;i<formData.length;i++){
            verified_code+=formData[i].value;
        }
        var codeConfirm=verified_code.split("").reverse().join("");
        confirmationResult
          .confirm(codeConfirm)
          .then(function(result) {
            $('.register-form .activation-form').hide();
            $('.register-steps').show();
          })
          .catch(function(error) {
            toastr.error("كود التفعيل غير صحيح");
          });
    });

    $("#SubmitMainForm").click(function(){
        var formData1 = $("#MainForm1").serializeArray();
        var formData2 = $("#MainForm2").serializeArray();
        var formData3 = $("#MainForm3").serializeArray();
        var formData4 = $("#MainForm4").serializeArray();
        var formData5 = $("#MainForm5").serializeArray();
        var obj = {};
        for(var i=0;i<formData1.length;i++){
            var name =formData1[i].name;
            var value =formData1[i].value;
            obj[name] = value;
        }
        for(var i=0;i<formData2.length;i++){
            var name =formData2[i].name;
            var value =formData2[i].value;
            obj[name] = value;
        }
        for(var i=0;i<formData3.length;i++){
            var name =formData3[i].name;
            var value =formData3[i].value;
            obj[name] = value;
        }
        for(var i=0;i<formData4.length;i++){
            var name =formData4[i].name;
            var value =formData4[i].value;
            obj[name] = value;
        }
        for(var i=0;i<formData5.length;i++){
            var name =formData5[i].name;
            var value =formData5[i].value;
            obj[name] = value;
        }
        var accept = $("#accept").val();

        // if (!$('#accept').is(":checked"))
        // {
        //   toastr.error("الموافقة على الشروط والاحكام مطلوبة");
        //   return false;
        // }
        if($("#checkUser").val() == 1)
        {
          toastr.error("إسم المستخدم مسجل من قبل");
          return false;
        }
        $('#SubmitMainForm').prop('disabled', true);
        $.LoadingOverlay("show");
        $.ajax({
          type:'POST',
          url:base_url+"/register",
          data:obj,
          success:function(data){
            $.LoadingOverlay("hide");
            if(data.success){
                toastr.success("تم تسجيل البيانات بنجاح");
                window.location.href = base_url;
                // window.setTimeout(function() {

                // }, 5000);
            }
            else
            {
                toastr.error(data.msg);
                $('#SubmitMainForm').prop('disabled', false);
            }
          }
        });

    });


    $('#userName').keyup(function(){
      var userName = $("#userName").val();

        $.ajax({
          type:'POST',
          url:base_url+"/check/username",
          data:{userName:userName},
          success:function(data){
            if(!data.success){
              $("#success-icon").hide();
              $("#failed-icon").show();
              //toastr.error(data.message);
              $("#checkUser").val(1);
            }
            else{
              $("#failed-icon").hide();
              $("#success-icon").show();
              $("#checkUser").val(0);
            }

          }
        });

    });

    $('#residentCountryId').change(function(){
      var country_id = $('select[name="residentCountryId"] option:selected').val();
      $.ajax({
          type:'POST',
          url:base_url+"/get/cities",
          data:{country_id:country_id},
          success:function(data){
            $("#selected_city").html(data);
          }
        });
    });


      function submitPhoneNumberAuth() {
        let mobile = $("input[name=mobile]").val();
        // let country = $('select[name="country"] option:selected').val();
        let mobileCode = $('select[name="mobileCode"] option:selected').val();
        var phoneNumber = mobileCode + mobile;
        var appVerifier = window.recaptchaVerifier;
        firebase
          .auth()
          .signInWithPhoneNumber(phoneNumber, appVerifier)
          .then(function(confirmationResult) {
            begin();
            window.confirmationResult = confirmationResult;
          })
          .catch(function(error) {
            begin();
            console.log(error);
          });
      }



      var timing;
      var myTimer;

      function begin() {
          timing = 60;
          $('#timing').html(timing);
          //$('#ResendBtn').attr("disabled", true);
          $('#ResendBtnRegister').prop('disabled', true);
          myTimer = setInterval(function() {
            --timing;
            $('#timing').html(timing);
            if (timing === 0) {
              $("#timer_text").text("");
              clearInterval(myTimer);
              $('#ResendBtnRegister').prop('disabled', false);

              //$('#ResendBtn').removeAttr("disabled");
            }
          }, 1000);
      }

      $(".confirm-code").keyup(function () {
          var point = $(this).data('point');
          point= point -1;
          if (this.value.length == 1)
          {
            $('input[name="code'+point+'"]').focus();
          }
          if(point == 0)
          {
            var formData = $("#verifySms").serializeArray();
            var verified_code = [];
            for(var i=0;i<formData.length;i++){
                if(formData[i].value)
                {
                  verified_code.push(formData[i].value);
                }

            }
            if(verified_code.length ==6)
            {
              $('#ConfirmCode').prop('disabled', false);
              $('#ConfirmCode').trigger('click');
            }

            //
          }
          else
          {
            $('#ConfirmCode').prop('disabled', true);
          }
      });

      $(".max-length-input").on("propertychange input", function() {
          if (this.value.length > 3) {
            this.value = this.value.substring(0, 3);
          }
      });
      $(".max-length-input2").on("propertychange input", function() {
          if (this.value.length > 2) {
            this.value = this.value.substring(0, 2);
          }
      });

      // $("#reg_mobile").on("propertychange input", function() {
      //   var charCode = (e.which) ? e.which : e.keyCode;
      //   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      //     return false;
      //   }
      // });
      $('#reg_mobile').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
      });
      $('.confirm-code').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
      });

      $("#marriageStatus").change(function () {
        if(this.value == 1 || this.value==129) {
          $("#check-marriageStatus").hide();
        }
        else {
          $("#check-marriageStatus").show();
        }

        if(this.value == 1)
        {
          $("#check-marriageStatusMale").hide();
        }
        else
        {
          $("#check-marriageStatusMale").show();
        }
      });


      $("#reg_mobile").on("propertychange input", function() {
          if (this.value.length >=8 && this.value.length <= 11)
          {
            $('#register-btn').prop('disabled', false);
          }
          else
          {
            $('#register-btn').prop('disabled', true);
          }
      });
      // var input = document.querySelector("#reg_mobile");
      // mobile_number = window.intlTelInput(input, {
      //   initialCountry: "auto",
      //   geoIpLookup: function(callback) {
      //     $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      //       var countryCode = (resp && resp.country) ? resp.country : "us";
      //       callback(countryCode);
      //     });
      //   },
      //   utilsScript: "https://intl-tel-input.com/node_modules/intl-tel-input/build/js/utils.js?1613236686837" // just for formatting/placeholders etc
      // });
      // input.addEventListener("countrychange", function() {
      //   $("#mobileCode").val("+"+mobile_number.getSelectedCountryData().dialCode);
      // });



</script>
@endpush
