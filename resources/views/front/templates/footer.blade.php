 <!-- Start footer -->
            <div class="footer py-4 px-5">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <!--<div class="members d-flex">-->
                    <div>
					@if($settings['displayLiveUsers'] > 0)

					  <p>
                      عدد الرجال :
                      {{ $footerStatistic['male'] }}
                      </p>
                      <p>
                      عدد السيدات :
                      {{ $footerStatistic['female'] }}
                      </p>
					  @endif
                      <!--<p>-->
                      <!--عدد السيدات-->
                      <!--{{ $footerStatistic['female'] }}-->
                      <!--</p>-->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                      <a href="{{ $settings['AndroidLink'] }}" class="mr-3"><img src="{{url('/')}}/front/imgs/googlePlay.png" alt="playstore"></a>
                      <a href="{{ $settings['IphoneLink'] }}"><img src="{{url('/')}}/front/imgs/appStore.png" alt="playstore"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="copyright text-center">
              <p class="m-0">جميع حقوق النشر محفوظة لمنصة زفاف {{date("Y")}}</p>
            </div>
            <!-- End footer -->
        </div>
    </div>
    @if(isset($main_header))
    <div class="store-app" id="android-ad" style="display: none">
      <span class="close-store-app"></span>
      <section >
            حمل تطبيق زفاف الآن لتجربة أفضل
            <a href="{{ $settings["AndroidLink"] }}">
              <img src="{{url('/')}}/front/imgs/googlePlay.png" alt="playstore" >
            </a>

      </section>
    </div>

    <div class="store-app" id="iphone-ad" style="display: none">
      <span class="close-store-app"></span>
      <section >
            حمل تطبيق زفاف الآن لتجربة أفضل

            <a href="{{ $settings["IphoneLink"] }}">
              <img src="{{url('/')}}/front/imgs/appStore.png" alt="playstore" >
            </a>
      </section>
    </div>
    @endif

    <div id="load-payment-script"></div>

    <script src="{{url('/')}}/front/js/jquery.smartWizard.min.js"></script>
    <script src="{{url('/')}}/front/js/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/front/js/wNumb.min.js"></script>
    <script src="{{url('/')}}/front/js/nouislider.min.js"></script>
    <script src="{{url('/')}}/front/js/wow.min.js"></script>
    <script src="{{url('/')}}/front/js/popper.min.js"></script>
    <script src="{{url('/')}}/front/js/bootstrap-rtl.min.js"></script>
    <script src="{{url('/')}}/front/js/javascript.js"></script>
    <script src='{{url('/')}}/cdn/toastr.min.js'></script>
	<!--<script type="text/javascript" src="js/core.customizer/front.customizer.min.js"></script>
    <script type="text/javascript" src="js/skin.customizer.min.js"></script>-->
    <script src="{{url('/')}}/cdn/sweetalert.min.js"></script>
    <script src="{{url('/')}}/cdn/select2.min.js"></script>

    {{-- firebase config --}}
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-functions.js"></script>
    {{-- firebase config --}}

    <script src="{{url('/')}}/cdn/sweetalert2.js"></script>
    <script src="{{url('/')}}/cdn/loadingoverlay.min.js"></script>
    <script src="{{url('/')}}/cdn/jquery.fancybox.min.js"></script>

    <script type="text/javascript" src="https://goSellJSLib.b-cdn.net/v1.6.0/js/gosell.js"></script>





	@include('front.templates.toastr')

  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.1/socket.io.min.js"></script> --}}
  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script> --}}
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.4/socket.io.js"></script>

    <script>

      var user_token = "";
      var user_name = "";
	  var status = "";
      var timestamp = "{{ Carbon\Carbon::now()->toDateString() }}";
      @if(Session::has('token'))
        user_token = "{{ Session::get('token') }}";
        user_name = "{{ strtolower(Session::get('user')['userName']) }}";
		status = "{{ strtolower(Session::get('user')['available']) }}";
      @endif
      if(user_token)
      {
        // var socket = io.connect('https://zefaaf-socket.herokuapp.com',{query: 'chatID='+user_name+'&token='+user_token+'&timestamp='+timestamp+'',enableLogging: true});
        var socket = io.connect('https://zefaaf-chat23.herokuapp.com/',{query: {chatID: user_name,token:user_token,timestamp:timestamp,status:status},enableLogging: true,transports: ["websocket"]});
        socket.on("connect", () => {
            console.log("Connected...");

          console.log(socket.id); // x8WIv7-mJelg7on_ALbx
        });


        socket.on("connect_error", (error) => {
            console.log("connect Error..."+error);
        });

        // socket.on("disconnect", (reason) => {
        //   console.log("Disconected..."+ reason);
        //   console.log(socket.id); // undefined
        // });

      }



    </script>

    <script>
        new WOW().init();
        var base_url = "{{ url('/') }}";
        var api_url = "{{ Config::get('app.api_url') }}";
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>

    <script>
      $(document).ready(function() {
        $(".fancybox").fancybox();
        @if(isset($main_header))
          customizeForDevice();
        @endif
      });
      function customizeForDevice(){
          var ua = navigator.userAgent;
          var checker = {
            iphone: ua.match(/(iPhone|iPod|iPad)/),
            blackberry: ua.match(/BlackBerry/),
            android: ua.match(/Android/)
          };
          if (checker.android){
            $("#android-ad").show();
          }
          else if (checker.iphone){
            $("#iphone-ad").show();
          }
      }

      $(".close-store-app").click(function(){
        $("#android-ad").hide();
        $("#iphone-ad").hide();
      });
    </script>

    <script>
		$('.delete-img-btn').click(function(){
          var image_remove_url = "{{url('/remove/user/img')}}";
          Swal.fire({
              text: "هل أنت متأكد من حذف صورتك؟",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText:  'تأكيد',
              target: document.getElementById('rtl-container'),
              cancelButtonText: 'إلغاء'
          }).then(function(isConfirm) {
            if (isConfirm.isConfirmed){
              window.location = image_remove_url;
            }
          });
        });
        $('.logout-btn').click(function(){
          var logout_url = "{{url('/logout')}}";
          Swal.fire({
              text: "هل أنت متأكد من تسجيل الخروج ؟",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText:  'تأكيد',
              target: document.getElementById('rtl-container'),
              cancelButtonText: 'إلغاء'
          }).then(function(isConfirm) {
            if (isConfirm.isConfirmed){
              window.location = logout_url;
            }
          });
        });
        $('#DeleteAccount').click(function(){
          var logout_url = "{{url('/delete/account')}}";
          Swal.fire({
              text: "هل انت متأكد من الغاء الحساب ؟",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText:  'تأكيد',
              target: document.getElementById('rtl-container'),
              cancelButtonText: 'الغاء'
          }).then(function(isConfirm) {
            if (isConfirm){
              window.location = logout_url;
            }
          });
        });
      $("#LoginBtn").on('click',function(){
        let login_mobile= $("#login_mobile").val();
       // let detectedCountry= $("#detectedCountry").val();
        let login_password= $("#login_password").val();
        if(!login_mobile){
          toastr.error("يجب إدخال إسم المستخدم وكلمة السر");
          return false;
        }
        // if(!detectedCountry){
        //   toastr.error("كود الدولة مطلوب");
        //   return false;
        // }
        if(!login_password){
          toastr.error("يجب إدخال إسم المستخدم وكلمة السر");
          return false;
        }
        $("#LoginForm").submit();
      });
      $(document).ready(function () {
          //navigator.geolocation.getCurrentPosition(onSuccess, onError);
          $('#stepwizard').smartWizard({
            lang: {
                next: 'التالي',
                previous: 'السابق'
            }
          });
          $('.js-example-basic-multiple-default').select2();
          $('.js-example-basic-multiple').select2({
              placeholder: function(){
                  $(this).data('placeholder');
              }
          });
      });


      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }

      $("#stepwizard").on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        if(currentStepIndex == 0) {
          if ($('#accept').is(":checked")) {
            return true;
          } else {
              toastr.error("الموافقة على الشروط والأحكام مطلوبة");
              return false;
          }
        }
        $form1 = true;
        $form2 = true;
        $form3 = true;
        if( $('#userName').val()=="" ||
            $("input[name=password]").val() == "" ||
            $("input[name=confirmation_password]").val() == "" ||
            $('select[name="nationalityCountryId"] option:selected').val() == "" ||
            $('select[name="residentCountryId"] option:selected').val() == "" ||
            $('select[name="cityId"] option:selected').val() == ""
        )
        {
          $form1 = false;
        }

        if(
            $('#age').val() == "" ||
            $('select[name="mariageStatues"] option:selected').val() == "" ||
            $('select[name="weight"] option:selected').val() == "" ||
            $('select[name="height"] option:selected').val() == "" ||
            $('select[name="skinColor"] option:selected').val() == "" ||
            $('select[name="helath"] option:selected').val() == ""
        )
        {
          $form2 = false;
        }

        if(
            $('select[name="prayer"] option:selected').val() == "" ||
            //!$('#smoking').is(':checked') ||
            $('select[name="education"] option:selected').val() == "" ||
            $('select[name="financial"] option:selected').val() == "" ||
            $('select[name="workField"] option:selected').val() == "" ||
            $('select[name="income"] option:selected').val() == ""
        )
        {
          $form3 = false;
        }



        if( stepDirection == "forward" && currentStepIndex == 1 && (  !$form1 )) {
          toastr.error("يرجي تعبئة جميع البيانات");
          return false;
        }
        else if( stepDirection == "forward" && currentStepIndex == 1 && $form1) {
          return true;
        }
        if(stepDirection == "forward" &&currentStepIndex == 2 && !$form2) {
          toastr.error("يرجي تعبئة جميع البيانات");
          return false;
        }
        else if( stepDirection == "forward" && currentStepIndex == 2 && $form2) {
          return true;
        }
        if(stepDirection == "forward" &&currentStepIndex == 3 && !$form3) {
          toastr.error("يرجي تعبئة جميع البيانات");
          return false;
        }
        else if( stepDirection == "forward" && currentStepIndex == 3 && $form3) {
          return true;
        }


        // $form1 =
        // if( stepDirection == "forward" && currentStepIndex == 1) {
        //   if($('#userName').val()==""){toastr.error("إسم المستخدم مطلوب");return false;}else return true;
        //   if($("input[name=password]").val()==""){toastr.error("كلمة المرور مطلوبة");return false;}else return true;
        //   if($("input[name=confirmation_password]").val()==""){toastr.error(" تأكيد كلمة المرور مطلوب");return false;}else return true;
        //   if($('select[name="nationalityCountryId"] option:selected').val()==""){toastr.error("الجنسية مطلوبة");return false;}else return true;
        //   if($('select[name="residentCountryId"] option:selected').val()==""){toastr.error("مكان الاقامة مطلوب");return false;}else return true;
        //   if($('select[name="cityId"] option:selected').val()==""){toastr.error(" المدينة مطلوبة ");return false;}else return true;
        //   if($("input[name=name]").val()==""){toastr.error("الاسم مطلوب");return false;}else return true;
        //   if($("input[name=email]").val()==""){toastr.error("الايميل مطلوب");return false;}else return true;
        // }

        // if(stepDirection == "forward" &&currentStepIndex == 2) {
        //   if(!$('#age').val()){toastr.error("العمر مطلوب");return false;}

        //   if(!$('select[name="mariageStatues"] option:selected').val()){toastr.error("الحالة الاجتماعية مطلوبة");return false;}

        //   if(!$('select[name="weight"] option:selected').val()){toastr.error("الوزن مطلوب");return false;}

        //   if(!$('select[name="height"] option:selected').val()){toastr.error(" الطول مطلوب ");return false;}

        //   if(!$('select[name="skinColor"] option:selected').val()){toastr.error(" لون البشرة مطلوب ");return false;}

        //   if(!$('select[name="helath"] option:selected').val()){toastr.error(" الحالة الصحية مطلوبة ");return false;}


        // }
        // if(stepDirection == "forward" &&currentStepIndex == 3) {

        //   if(!$('select[name="prayer"] option:selected').val()){toastr.error("الالتزام الدينى مطلوب");return false;}

        //   if(!$('#smoking').is(':checked')){toastr.error("التدخين مطلوب");return false;}

        //   if(!$('select[name="education"] option:selected').val()){toastr.error(" الموهل التعليمى مطلوب ");return false;}

        //   if(!$('select[name="financial"] option:selected').val()){toastr.error(" الوضع المالى مطلوب ");return false;}

        //   if(!$('select[name="workField"] option:selected').val()){toastr.error(" مجال العمل مطلوب ");return false;}

        //   if(!$('select[name="income"] option:selected').val()){toastr.error(" مستوى الدخل الشهرى مطلوبة ");return false;}


        // }

      });
      $("#stepwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
         if(stepPosition === 'first' || stepPosition === 'last') {
          $(".sw-btn-next").css('display','none');
        }
        else {
          $(".sw-btn-next").css('display','block');
        }
        if(stepPosition === 'last') $("#SubmitMainForm").css('display','block');
        else $("#SubmitMainForm").css('display','none');

      });

      $(".select-type").click(function () {
        let gender = $(this).attr("data-gender");//(this).data('gender');
		if(gender == 1)
		{
			$("#aboutOther").attr("placeholder", "يرجى اختيار كلمات تليق بزوجك المستقبلي");
			$("#aboutMe").attr("placeholder", "يرجى اختيار كلمات تليق بأخلاقك مسلمة");
		}
		else
		{
			$("#aboutOther").attr("placeholder", "يرجى اختيار كلمات تليق بزوجتك المستقبلية");
			$("#aboutMe").attr("placeholder", "يرجى اختيار كلمات تليق بأخلاقك كمسلم");
		}
        $("#reg_gender").val(gender);
        $('#stepwizard').smartWizard('next');
        $('#marriageStatus').empty();
        $('#marriageStatus').append($("<option></option>").attr("value", "").text("الحالة الإجتماعية"));
        @foreach ($fixedData['marriageStatus'] as $key=>$item)
        var status_gender = "{{ $item['gender'] }}";
        if(parseInt(status_gender) == parseInt(gender))
        {
          $('#marriageStatus').append($("<option></option>").attr("value", "{{ $item['id'] }}").text("{{ $item['title'] }}"));
        }

        @endforeach

        // $('#marriageStatus option').hide();
        // $('#marriageStatus option[data-gender="'+gender+'"]').show();
        if(gender == 1) $('#check-marriageStatusMale').show();
        if(gender ==1)
        {
          $("#veil").show();
        }
        else
        {
          $("#veil").hide();
        }
      })


    // $('.follow-btn').click(function(){
    //     let forget_mobile= $("#forget_mobile").val();
    //     let forget_country_code= $("#forget_country_code").val();
    //     if(!forget_mobile){
    //       toastr.error("رقم الهاتف مطلوب");
    //       return false;
    //     }
    //     if(!forget_country_code){
    //       toastr.error("كود الدولة مطلوب");
    //       return false;
    //     }
    //     $.ajax({
    //       type:'POST',
    //       url:base_url+"/check/forget/pass",
    //       data:{forget_mobile:forget_mobile,forget_country_code:forget_country_code},
    //       success:function(data){
    //         if(!data.success){
    //           toastr.error(data.message);
    //         }
    //         else{
    //           $("#ForgetphoneNo").text(forget_mobile+"*****");
    //           var code = "{{ Session::get('forget_verify_code') }}";
    //           $("#forget_verify_code").text(" الرمز هو  "+code);
    //           $('.forgot-password').hide();
    //           $('.activation-form1').show();
    //         }

    //       }
    //     });


    //   });


      $('.check-forget-code').click(function(){
        let code = "{{ Session::get('forget_verify_code') }}";
        var formData = $("#forgetverify").serializeArray();
        var verified_code = '';
        for(var i=0;i<formData.length;i++){
            verified_code+=formData[i].value;
        }
        if(verified_code == code){
            $('.activation-form1').hide();
            $('.forgot-password2').show();
        }
        else
        {
            toastr.error("كود التفعيل غير صحيح");
        }

      });
      $('#ForgetPassBtn').click(function(){
        let code = "{{ Session::get('forget_verify_code') }}";
        var formData = $("#forgetverify").serializeArray();
        var verified_code = '';
        for(var i=0;i<formData.length;i++){
            verified_code+=formData[i].value;
        }
        if(verified_code == code){
            $('.activation-form1').hide();
            $('.forgot-password2').show();
        }
        else
        {
            toastr.error("كود التفعيل غير صحيح");
        }

      });
	  $("#ChangeStatus").click(function (e) {
        e.preventDefault();
        let status = $(this).attr("data-status");
        $.get( base_url+"/user/change/status", { status: status})
          .done(function( data ) {
                if(data.success){
                  toastr.success(data.message);
                  if(status == 2)
                  {
                    //$(".status").css("color","red");
                    $(".status p").html(`<i class="fas fa-circle" style="color:red"></i>حالتك
                    غير متصل الآن  </p>`);
                    $("#ChangeStatus").attr('data-status', 1);
                  }
                  else
                  {
                    $(".status p").html(`<i class="fas fa-circle" style="color:green"></i>حالتك
                     متصل الآن  </p>`);
                    $(this).attr('data-status', 2);
                  }

                  //location.reload();
                }
                else{
                  toastr.error(data.message);
                }
          });
      });
      $("#ChangeStatusOLD").click(function(){
        Swal.fire({
          text: 'تغيير الحالة',
          input: 'radio',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText:  'حفظ',
          target: document.getElementById('rtl-container'),
          cancelButtonText: 'الغاء',
          customClass: {
            input: 'my-radio'
          },
          inputOptions: {
            '1': 'متاح',
            '2': 'مشغول'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            var id = $('input[name=swal2-radio]:checked').val();
            if(id){
              $.post( base_url+"/user/change/status", { status: id})
              .done(function( data ) {
                if(data.success){
                  toastr.success(data.message);
                  location.reload();
                }
                else{
                  toastr.error(data.message);
                }
              });
            }
          }
        })
      });



    </script>


      <script>
        $('#OpenImgUpload').click(function(){
          $('#imgupload').trigger('click');
        });
        $("#imgupload").change(function () {
          $("#uploadMyPhoto").submit();
        });
        function onSuccess (position) {
              $.post( base_url+"/user/detected/country", { lat: position.coords.latitude,"lng":position.coords.longitude})
              .done(function( data ) {});
        };

        function onError(error) {
            console.log('code: '    + error.code    + '\n' +
                  'message: ' + error.message + '\n');
        }


        function SendToken(token) {
          $.post( base_url+"/user/firebase/token", { token: token})
              .done(function( data ) {});
         }


         function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
              $('#image_file').show();
              $('#image_file').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
            }
          }

          $("#imgInp").change(function() {
            readURL(this);
          });

          $('.payment-script').click(function(){
            alert("here");
            var id = $(this).data('id');
            $.ajax({
                type:'get',
                url:base_url+"/packages/script/"+id,
                success:function(data){
                  $("#load-payment-script").html(data);
                }
              });
          });

      </script>



<script>
  function LoadPayment(data)
  {
     goSell.config({
      gateway: {
        publicKey:"pk_test_CiX4sZg3Jf5MBnuN2oaeSjUH",
        merchantId: null,
        language:"ar",
        contactInfo:true,
        supportedCurrencies:"all",
        supportedPaymentMethods: "all",
        saveCardOption:false,
        customerCards: true,
        notifications:"standard",
        callback: (response) => {
          console.log("callback", response);
        },
        onClose: () => {
          console.log("onclose hey");
        },
        onLoad:() => {
          console.log("onLoad");
          // $(".wrapper").css('opacity','0.4');
          goSell.openLightBox();
        },
        style: {
          base: {
            color: "red",
            lineHeight: "10px",
            fontFamily: "sans-serif",
            fontSmoothing: "antialiased",
            fontSize: "10px",
            "::placeholder": {
              color: "rgba(0, 0, 0, 0.26)",
              fontSize: "10px",
            },
          },
          invalid: {
            color: "red",
            iconColor: "#fa755a ",
          },
        },
      },
      customer: {
        first_name: "hala",
        middle_name: "",
        last_name: "",
        email: "test@test.com",
        phone: {
          country_code: "+965",
          number: "00000000",
        },
      },
      order:{
        amount: data.usdValue,
        currency:"USD",
        items:[{
        id:1,
        name:data.title,
        quantity: "1",
        amount_per_unit:data.usdValue,

        total_amount: data.usdValue
        }],
        shipping:null,
        taxes: null
     },
     transaction:{
     mode: "charge",
     charge:{
        saveCard: false,
        threeDSecure: true,
        description: data.title,
        reference:{
              transaction: "txn_0001",
              order: "ord_0001"
        },
        metadata:{
              "paymentToken":data.token
        },
        receipt:{
              email: false,
              sms: true
        },
        redirect: "{{ url('thankyou') }}",
        post: "https://zefaaf.net/api/v1/mobile/confirmPayment",
        }
     },
    });
  }
  function save(id){
    @if(!Session::has('token'))
    toastr.error("يجب تسجيل الدخول أولاً");
    @else
    $.LoadingOverlay("show");
     $.ajax({
               type:'get',
               url:base_url+"/packages/script/"+id,
               success:function(data){
                $.LoadingOverlay("hide");
                 if(data.success){
                   LoadPayment(data.data);
                 }
                 else
                 {
                  toastr.error("حدث خطأ برجاء المحاولة مرة اخرى");
                 }
               }
     });
    @endif

  }
</script>

{{-- firebase --}}

<script>

  // Initialize Firebase
  // TODO: Replace with your project's customized code snippet
  var config = {
      apiKey: "AIzaSyD56zbHmeSvg-KZro2rZwL0JlwJ6pz5a_4",
      authDomain: "zefaaf-16c8a.firebaseapp.com",
      databaseURL: 'https://zefaaf-16c8a.firebaseio.com',
      projectId: "zefaaf-16c8a",
      storageBucket: "zefaaf-16c8a.appspot.com",
      messagingSenderId: "483285088195",
      appId: "1:483285088195:web:56ba9cdae399032f106f76",
      measurementId: "G-FMGG4Q4QER"
  };
  firebase.initializeApp(config);

  const messaging = firebase.messaging();
  messaging
      .requestPermission()
      .then(function () {
          //MsgElem.innerHTML = "Notification permission granted."
          console.log("Notification permission granted.");

          // get the token in the form of promise
          return messaging.getToken()
      })
      .then(function(token) {
         console.log("token is : " + token);
      })
      .catch(function (err) {
          //ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
          console.log("Unable to get permission to notify.", err);
      });

  let enableForegroundNotification = true;
  // messaging.onMessage(function(payload) {
  //     //console.log("Message received. ", payload);
  //     // if(enableForegroundNotification) {
  //     //     const {title, ...options} = payload.data;
  //     //     navigator.serviceWorker.getRegistrations().then(registration => {
  //     //         registration[0].showNotification(title, options);
  //     //     });
  //     // }
  // });
  messaging.onMessage(function(payload) {
        console.log("Message received. ", payload);
        var privateData = jQuery.parseJSON(payload.data.privateData);
        if(payload && payload.data ){
        var msg_id = privateData.id;
            if(privateData.type== 0 || privateData.type== 1 || privateData.type==2 || privateData.type==3 || privateData.type==4 || privateData.type==5 ){
          Swal.fire({
            text: 'لديك اشعار جديد',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
              'عرض الاشعار',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              window.location = "{{url('/notifications')}}";
            }
          });
        }
            else if(privateData.type==8){
          Swal.fire({
            text: 'لديك رسالة جديدة',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
              'عرض الرسالة',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              var redirect_url = "{{url('/contact-us/message/details')}}/"+msg_id;
              window.location = redirect_url;
              // window.location = "{{url('/contact-us/message/details/168')}}";
            }
          });
        }
            else if(privateData.type==9){
          Swal.fire({
            text: 'لديك رسالة فى المحادثة جديدة',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
              'عرض الرسالة',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              var chatId = privateData.chatId;
              var redirect_url = "{{url('/chats/details')}}/"+chatId;
              window.location = redirect_url;
            }
          });
        }
        }
         notificationTitle = payload.data.title;
         notificationOptions = {
             body: payload.data.body,
             icon: payload.data.icon,
             image:  payload.data.image
         };
         var notification = new Notification(notificationTitle,notificationOptions);
      });

	  $(".invalid_marriage_btn").click(function(){
		  toastr.error("قم بترقية باقتك لا يمكنك نشر طلب زواجك إلا بعد الإشتراك في العضوية البلاتينية");
	  });

	  $('.delete-chat-messages').click(function(){
          var delete_url = "{{url('/hideAllChats')}}";
          Swal.fire({
              text: "هل انت متاكد ؟",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText:  'تأكيد',
			  icon: 'error',
              target: document.getElementById('rtl-container'),
              cancelButtonText: 'الغاء'
          }).then(function(result) {
            if (result.isConfirmed) {
				window.location = delete_url;
            }

          });
        });


		$('.delete-single-chat-messages').click(function(){
		 event.preventDefault();
		 let id = $(this).attr("data-id");
          var delete_url = "{{url('/hideChat')}}?chatId="+id;
          Swal.fire({
              text: " هل تود حقاً حذف محادثتك ؟",
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText:  'نعم',
			  icon: 'error',
              target: document.getElementById('rtl-container'),
              cancelButtonText: 'لا'
          }).then(function(result) {
            if (result.isConfirmed) {
				window.location = delete_url;
            }

          });
        });

		$(".has-no-permission").click(function(){
		  //toastr.error("يجب الترقية للإستفادة من الخدمة");
		  toastr.error("","يجب الترقية للإستفادة من الخدمة", {
                  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": true,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut",
                onHidden: function() {
                    window.location.href = "{{ url('/packages') }}";
                }
            });
		});

		$(".has-no-permission-image").click(function(){
		  //toastr.error("يجب الترقية للإستفادة من الخدمة");
		  toastr.error("","لرفع صورتك يجب الترقية للفضية", {
                  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": true,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut",
                onHidden: function() {
                    window.location.href = "{{ url('/packages') }}";
                }
            });
		});

		$(".has-no-permission-level1").click(function(){
		  //toastr.error("عفوا يجب ترقية الباقة. هذه الخدمة لأصحاب الباقة الفضية ");
		  toastr.error("","هذه الخدمة لأصحاب الباقة الفضية  ", {
                  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": true,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut",
                onHidden: function() {
                    window.location.href = "{{ url('/packages') }}";
                }
            });
		});
		$(".has-no-permission-level2").click(function(){
		  //toastr.error("عفوا يجب ترقية الباقة.هذه الخدمة لأصحاب الباقة البلاتينية ");
		  toastr.error("","هذه الخدمة لأصحاب الباقة البلاتينية ", {
                  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": true,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut",
                onHidden: function() {
                    window.location.href = "{{ url('/packages') }}";
                }
            });
		});


</script>



@stack('script')
  </body>
</html>
