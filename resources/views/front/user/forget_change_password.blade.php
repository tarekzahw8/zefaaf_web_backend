@extends('front.layouts.app')
@section('content')
<style>
.forgot-form
{
	display:none;
}
</style>


            <!-- Start forgot password form -->
			<div class="forgot-form1 p-5 min-height-footer">
               <div class="container">
					<!--<h3 style="text-align:center">نسيت كلمة المرور-->
					<!-- <br />-->
					<!--</h3>-->
					   <div class="imgTitCover">
                    <img src="{{url('/')}}/front/imgs/changePass.png" alt="lockImg">
                  </div>
                  	<h3 style="text-align:center">ادخل رقم الموبايل
					 <br />
					</h3>
                  <!-- <h5><img src="imgs/secure.png" alt="secure">تغير كلمة المرور</h5> -->
					<form id="MainForm1">
                    <div class="d-flex justify-content-center">
                        <div class="form-group tel-input" style="display: inherit;">
					
                            <input tyle="width:250px" type="tel" class="form-control" id="forget_mobile_no" name="forget_mobile_no" placeholder="رقم الموبايل">
                           	<select class="form-control" id="forget_country_code_no" name="forget_country_code_no" style="width:130px;margin-right: 10px;">
                            @foreach($countries as $key=>$value)
                            <option value="{{ $value['phoneCode'] }}" >{{ $value['nameAr'] }} {{ $value['phoneCode'] }}  </option>
                            @endforeach
                          </select>
                        </div>
                        
                      </div>
						<div id="recaptcha-container"></div>
						 <div class="d-flex justify-content-center mb-5">

						<button type="button" class="btn btn-primary main-btn register-btn" id="register-btn">إرسال</button>
						</div>
					</form>
						
               </div>
            </div>

			
            <div class="forgot-form p-5 min-height-footer">
               <div class="container">
                   {{-- <h3 class="sub-title"><img src="{{url('/')}}/front/imgs/secure.png" alt="secure">تغيير كلمة المرور</h3> --}}
                  <!-- <h5><img src="imgs/secure.png" alt="secure">تغير كلمة المرور</h5> -->
                  <div class="imgTitCover">
                    <img src="{{url('/')}}/front/imgs/changePass.png" alt="lockImg">
                  </div>
                  <form action="{{ url('user/forget/change/password') }}" method="post" id="change_password_form">
                    @csrf
                    <div class="form-group">
                      <label>كود كلمة المرور</label>
                      <input type="text" name="tempPassword" id="tempPassword" class="form-control" placeholder="كود كلمة المرور">
                    </div>
                    
                    <div class="form-group">
                      <label>أدخل كلمة سر جديدة</label>
                      <input type="password" name="password" class="form-control" placeholder="أدخل كلمة سر جديدة">
                      <span style="color:red"> كلمة المرور يجب ان تكون من 8 الى 12 حرف </span>
                    </div>
                    <div class="form-group">
                      <label>إعادة إدخال كلمة السر</label>
                      <input type="password" name="confirmation_password" class="form-control" placeholder="إعادة إدخال كلمة السر">
                    </div>

                    <button class="btn btn-primary main-btn forget_btn" type="submit">تأكيد</button>
                  </form>
               </div>
            </div>
            <!-- End forgot password form -->

@endsection		

@push('script')
<script>
window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "invisible",
        }
      );
$('.register-btn').click(function(){
		let mobile = $("input[name=forget_mobile_no]").val();
        // let country = $('select[name="country"] option:selected').val();
        let mobileCode = $('select[name="forget_country_code_no"] option:selected').val();
        if(!mobile){
          toastr.error("رقم الهاتف مطلوب");
          return false;
        }
        if(!mobileCode){
          toastr.error("كود الدولة مطلوب");
          return false;
        }
		submitPhoneNumberAuth();
	
});	
function submitPhoneNumberAuth() {
        let mobile = $("input[name=forget_mobile_no]").val();
        // let country = $('select[name="country"] option:selected').val();
        let mobileCode = $('select[name="forget_country_code_no"] option:selected').val();
        var phoneNumber = mobileCode + mobile;
		console.log(phoneNumber);
        var appVerifier = window.recaptchaVerifier;
        firebase
          .auth()
          .signInWithPhoneNumber(phoneNumber, appVerifier)
          .then(function(confirmationResult) {
            begin();
            window.confirmationResult = confirmationResult;
			$(".forgot-form1").hide();
			$(".forgot-form").show();
          })
          .catch(function(error) {
            begin();
            console.log(error);
			console.log(phoneNumber);
			toastr.error("رقم الهاتف غير صحيح");
          });
      }  
$(".forget_btn").click(function(){
	event.preventDefault();
	let verified_code =$("input[name=tempPassword]").val();
	var codeConfirm=verified_code;
	confirmationResult
          .confirm(codeConfirm)
          .then(function(result) {
			$('#change_password_form').submit();
          })
          .catch(function(error) {
            toastr.error("كود التفعيل غير صحيح");
          });
});	
function begin() 
{
	timing = 60;
}
</script>
@endpush  