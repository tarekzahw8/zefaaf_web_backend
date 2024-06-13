  <!-- Sidebar -->
  <nav id="sidebar">

         <a href="#" class="close-menu">
           <i class="fas fa-times"></i>
         </a>

         <!-- start sidebar header -->
         <div class="sidebar-header">
            {{-- <span class="theme-color"><i class="fas fa-paint-brush"></i></span>  --}}

           @if(!Session::has('token'))
           <!-- Start login form -->
           <div class="login-form">
               <h3>تسجيل دخول
               </h3>
               <form id="LoginForm" action="{{ url('/login') }}" method="post">
               @csrf
                 {{-- <div class="d-flex justify-content-between"> --}}
                    {{-- <div class="form-group tel-input"> --}}
                    <div class="form-group">
                       <input type="text" name= "login_mobile" id="login_mobile" class="form-control" placeholder="إسم المستخدم">
                    </div>
                    {{-- <div class="form-group select-country">
                     <select class="form-control" name="detectedCountry" id="detectedCountry">
                      @foreach($countries as $key=>$value)
                        <option value="{{ $value['phoneCode'] }}"> {{ $value['phoneCode'] }} {{ $value['nameAr'] }} </option>
                      @endforeach
                     </select>
                    </div> --}}
                 {{-- </div> --}}
                  <div class="form-group">
                      <input type="password" id="login_password" name="login_password" class="form-control"  placeholder="كلمة المرور">
                  </div>
                  <div class="form-check mt-2">
                    <input type="checkbox" name="remeber" value="1" class="form-check-input" id="remeber">
                    <label class="form-check-label" for="remeber">
                      تذكرني
                    </label>
                  </div>
                 {{-- <a href="#" class="forgot-psw">نسيت كلمة المرور ؟</a> --}}
				 <a href="{{ url('user/change/password') }}" class="forgot-psw">نسيت كلمة المرور ؟</a>
                 <button type="button" id="LoginBtn" class="btn btn-block main-btn login-btn">دخول</button>
               </form>
               <p class="new-account text-center">ليس لديك حساب … <a href="{{ url('/register') }}">سجل الآن مجاناً</a></p>
           </div>

           <!-- Start forgot password form -->
           <div class="forgot-password">
               <h3>نسيت كلمة المرور
                 <br />
                 لا داعي للقلق
               </h3>
               <form method="post" action="{{ url('/user/forget/password') }}">
                @csrf
                 {{-- <div class="d-flex justify-content-between">
                   <div class="form-group">
                       <input type="text" name="forget_username" id="forget_username" class="form-control" placeholder="إسم المستخدم">
                   </div>--}}
				   <div class="form-group tel-input"  style="float: left;">
                            <input type="tel" class="form-control" id="forget_mobile" name="forget_mobile" placeholder="رقم الموبايل">

                        </div>
                   <div class="form-group select-country">
                     <select class="form-control" name="forget_country_code" id="forget_country_code">
                        @foreach($countries as $key=>$value)
                          <option value="{{ $value['phoneCode'] }}" >{{ $value['nameAr'] }} {{ $value['phoneCode'] }}  </option>
                        @endforeach
                     </select>
                   </div>
                 {{-- </div> --}}
                 {{-- <p class="note">الرجاء التأكد من إدخال رقم الهاتف الذي تم تقديمه من قبل.</p> --}}
                 <button type="submit" class="btn btn-block main-btn follow-btn" id="forget-pass-btn">تغيير كلمة المرور</button>
               </form>
           </div>
           <!-- End forgot password form-->

           <!-- Start activation code -->
           <div class="activation-form1 text-center">
             <h3>كود التحقق</h3>
             <p class="my-md-4 my-3">لقد ارسلنا رسالة نصية الي <span id="ForgetphoneNo">111****</span> تشمل ع لي رمز <span class="mt-2 d-block">ادخل رمز التحقيق</span> <span id="forget_verify_code"></span></p>

             <form class="d-flex justify-content-center" id="forgetverify">
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
             </form>
             <button class="btn btn-link btn-block" id="ResendBtn">إعادة إرسال مرة أخرى</button>
             <button class="btn btn-primary btn-block  main-btn check-forget-code">تم</button>
           </div>
           <!-- End activation code -->

<!-- Start forgot password form -->
           <div class="forgot-password2">
               <h3>تغيير كلمة المرور</h3>
               <form>
                 <div class="justify-content-between">
                 <div class="form-group">
                     <input type="password" id="chang_password" name="chang_password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                 </div>
                 <div class="form-group">
                     <input type="password" id="confirm_chang_password" name="confirm_chang_password" class="form-control" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور">
                 </div>

                 </div>
                 <button type="button" class="btn btn-block main-btn" id="ForgetPassBtn">متابعة</button>
               </form>
           </div>
           <!-- End forgot password form-->

           @else

            <div class="mainmenu-header">
                 <div class="d-flex justify-content-center mb-3">
                   <div class="d-flex status">
                    @php
                    $status_color = Session::get('user')['available']==1?"green":(Session::get('user')['available']==2 ?"#FF4E4E" : "gray")
                    @endphp
                     <p><i class="fas fa-circle" style="color:{{ $status_color }}"></i>حالتك
                      {{ Session::get('user')['available']==1 ? "متصل" : (Session::get('user')['available']==2 ? "مشغول" : "غير متصل") }}
                       الآن

                     @php
                     $status = Session::get('user')['available']==2 ? 1:2;
                     @endphp
                    </p>
                     <a data-status="{{ $status }}" href="{{ url('/user/change/status') }}?status={{ $status }}">تغيير حالتك</a>
                   </div>

                   <a href="{{ url('/chats') }}" class="btn btn-link cir-btn">
                     <img src="{{url('/')}}/front/imgs/chat.png" alt="chat" style="padding-top: 7px;">
                     @if(Session::get('updates')['newChats'] > 0)
                     <span class="badge">{{ Session::get('updates')['newChats'] }}</span>
                     @endif
                   </a>
               </div>

               <div class="d-flex justify-content-center align-items-center">
                 <a class="btn btn-link edit-btn mr-4" href="{{ url('/profile') }}"><i class="fas fa-pen"></i></a>

                 <div class="profile-img">
                  <form action="{{ url('/user/uploadPhoto') }}" id="uploadMyPhoto" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="attachment" id="imgupload" style="display:none"/>
                  </form>

                  @if (Session::get('user')['profileImage'])
                  <span><img src="{{Config::get('app.image_url')}}/{{ Session::get('user')['profileImage'] }}" alt="profile-img"></span>
                  <button class="btn btn-link cir-btn" id="OpenImgUpload">
                    {{-- <img src="{{url('/')}}/front/imgs/add-button.png" alt="chat"> --}}
                  </button>
                  @else
                  <span>
                    @if(Session::get('user')['gender'] == 1 )
                    <img src="{{url('/')}}/front/imgs/woman.png" alt="profile-img">
                    @else
                    <img src="{{url('/')}}/front/imgs/man2.png" alt="profile-img">
                    @endif
                  </span>
				@if(Session::get('user')['packageLevel'] > 1)
                  <button class="btn btn-link cir-btn" id="OpenImgUpload">
				  <img src="{{url('/')}}/front/imgs/add-button.png" alt="chat">
				  </button>
				  @else
				<button class="btn btn-link cir-btn has-no-permission-image" >
				  <img src="{{url('/')}}/front/imgs/add-button.png" alt="chat">
				  </button>
			@endif
                  @endif

				   @if(Session::get('user')['tempProfileImage'])
					<a href="javascript:;" style="color:#fff;font-size: 9px;">صورتك بإنتظار المراجعة</a>
                   @endif
                   @if(Session::get('user')['packageLevel'] <= 1)
                   <a href="javascript:;" class="btn btn-link cir-btn has-no-permission-level1"><img src="{{url('/')}}/front/imgs/add-button.png" alt="chat"></a>
                   <a href="javascript:;" id="package_message" class="has-no-permission-level1">
				   لرفع صورتك يجب الترقية للفضية</a>
                   @endif
                   @if(Session::get('user')['packageId'] > 0)
                   <button class="btn btn-link king-btn" style="background-color: {{ $status_color }}">
                   @if(Session::get('user')['gender'] == 1 || Session::get('user')['packageId'] == 11 )
                    <img src="{{url('/')}}/front/imgs/king.png" alt="crown" >
                   @else
                    @if(Session::get('user')['packageLevel'] == 4)
										<img src="{{url('/')}}/platinum.png" alt="crown" >
									@elseif(Session::get('user')['packageLevel'] == 5)
										<img src="{{url('/')}}/mass.png" alt="crown" >
									@else
										<img src="{{url('/')}}/front/imgs/man_star.png" alt="crown" >
									@endif
                   @endif
                   </button>
					@if (Session::get('user')['profileImage'])
						<button class="btn btn-link delete-img-btn">
							<img src="{{url('/')}}/front/imgs/failed.png" alt="crown" >
						</button>
					@endif
                   @endif
                 </div>

                 <a class="btn btn-link logout-btn ml-4" href="#" id="LogoutBtn">
                   {{-- <i class="fas fa-power-off"></i> --}}
                   <img src="{{url('/')}}/front/imgs/power.png" alt="crowns" style="width: 18px;
                   height: 20px;">
                  </a>
               </div>

               <div class="profile-info text-center mt-1">
                 <h3>{{ Session::get('user')['userName'] }}</h3>
                 <div class="d-flex justify-content-center">
                  @if(Session::get('user')['packageId'] != 0)
                   <p>صلاحية الباقة حتى يوم</p>
                   <p class="date ml-3">{{ Session::get('user')['packageRenewDate'] }}</p>
                  @endif
                 </div>
               </div>
              @if(Session::get('user')['packageId'] == 0)
               <div class="account-status d-flex justify-content-center align-items-center mt-2">
                 <p class="mb-0">أنت حالياً على الباقة المجانية</p>
                 <a href="{{ url('/packages') }}" class="btn btn-primary btn-sm ml-3">الترقية الآن</a>
               </div>
               @endif

               <div class="row two-btns mt-3">
                 <div class="col-6">
                 {{-- <a href="{{ url('/user/change/phone') }}" class="btn btn-block">تغيير رقم الموبايل</a> --}}
                 <button type="button" class="btn btn-block" id="DeleteAccount">إلغاء حسابي</button>
                 </div>
                 <div class="col-6">
                   <a href="{{ url('/user/password/change') }}" class="btn btn-block">تغيير كلمة المرور</a>
                 </div>
               </div>

               <div class="row four-icons mx-0 mt-4">
                 <div class="col-3">
                    <a href="{{ url('/contact-us') }}" class="d-flex justify-content-center">
                        <span class="cir-icon"><img src="{{url('/')}}/front/imgs/marriage.png" alt="icon"></span>
                     <p><span>{{ Session::get('updates')['newMessages'] }}</span>
                    <span class="icon-activity-text"> طلبات الزواج </span>
                    </p>
                    </a>
                 </div>
                 <div class="col-3">
                    <a href="{{ url('/notifications?show=visitor') }}" class="d-flex justify-content-center">
                        <span class="cir-icon"><img src="{{url('/')}}/front/imgs/look.png" alt="icon"></span>
                     <p><span>{{ Session::get('updates')['newViews'] }}</span>
                      <span class="icon-activity-text"> المشاهدات </span></p>
                    </a>
                 </div>
                 <div class="col-3">
                    <a href="{{ url('/notifications?show=interest') }}" class="d-flex justify-content-center">
                        <span class="cir-icon"><img src="{{url('/')}}/front/imgs/fav.png" id="fav-icon" alt="icon"></span>
                     <p><span>{{ Session::get('updates')['newIntersest'] }}</span>
                      <span class="icon-activity-text"> الإعجاب </span></p>
                    </a>
                 </div>
                 <div class="col-3">
                    <a href="{{ url('/articles') }}" class="d-flex justify-content-center">
                      <span class="cir-icon"><img src="{{url('/')}}/front/imgs/add-friend.png" alt="icon"></span>
                     <p><span>{{ Session::get('updates')['newPosts'] }}</span>
                      <span class="icon-activity-text"> مواضيع </span>
                      </p>
                    </a>
                 </div>

               </div>
           </div>
           @endif
         </div>

         <!-- start sidebar links -->
         <div class="sidemenu">
           <ul class="main-list list-unstyled">
               <li class="{{ isActiveTapFront('/') }}">
                   <a href="{{ url('/') }}">
                     <img src="{{url('/')}}/front/imgs/home.png" alt="home">الرئيسية
                     <i class="fas fa-chevron-left float-right"></i>
                   </a>
               </li>
               @if(Session::has('token'))
               <li class="{{ isActiveTapFront('notifications') }}">
                   <a href="{{ url('/notifications') }}">
                     <img src="{{url('/')}}/front/imgs/active.png" alt="active">الإشعارات

                     <i class="fas fa-chevron-left float-right"></i>
                   </a>
               </li>
               <li class="{{ isActiveTapFront('members') }}">
                   <a href="{{ url('/members') }}">
                     <img src="{{url('/')}}/front/imgs/add-friend.png" alt="add-friend">قوائم الأعضاء
                     <i class="fas fa-chevron-left float-right"></i>
                   </a>
               </li>
               <li class="{{ isActiveTapFront('profile') }}">
                 <a href="{{ url('/profile') }}">
                   <img src="{{url('/')}}/front/imgs/person.png" alt="person">حسابي
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
               </li>
               <li class="{{ isActiveTapFront('search') }}">
                 <a href="{{ url('/search') }}">
                   <img src="{{url('/')}}/front/imgs/search.png" alt="search">بحث
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
               </li>

               <li class="{{ isActiveTapFront('automated-search') }}">
                 <a href="{{ url('/automated-search') }}">
                   <img src="{{url('/')}}/front/new_imgs/auto-search.png" alt="search">الباحث الآلي
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
               </li>

              <li class="{{ isActiveTapFront('settings') }}">
                 <a href="{{ url('/settings') }}">
                   <img src="{{url('/')}}/front/imgs/gear.png" alt="gear">الإعدادات
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
              </li>

              <li class="{{ isActiveTapFront('chats') }}">
				@if(Session::get('user')['packageLevel'] > 0)
                <a href="{{ url('/chats') }}">
				@else
				<a href="#" class="has-no-permission-level1">
				@endif
                  <img src="{{url('/')}}/front/imgs/our-message.png" alt="gear">المحادثات
                  <i class="fas fa-chevron-left float-right"></i>
                </a>
             </li>
              @endif
           </ul>



           <ul class="main-list list-unstyled">
             <li class="{{ isActiveTapFront('packages') }}">
                 <a href="{{ url('/packages') }}">
                   <img src="{{url('/')}}/front/imgs/packages.png" alt="crowns">الباقات
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             <li class="{{ isActiveTapFront('sucsses/stories') }}">
                 <a href="{{ url('/sucsses/stories') }}">
                   <img src="{{url('/')}}/front/imgs/success-stories.png" alt="wedding-rings">قصص النجاح
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             <li class="{{ isActiveTapFront('articles') }}">
                 <a href="{{ url('/articles') }}">
                   <img src="{{url('/')}}/front/imgs/articles.png" alt="article">المقالات
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             <li class="{{ isActiveTapFront('marriage') }}">
               <a href="{{ url('/marriage') }}">
                 <img src="{{url('/')}}/front/imgs/sunna-married.png" alt="article">
                 الزواج في ضوء السُنّة
                 <i class="fas fa-chevron-left float-right"></i>
               </a>
             </li>

           </ul>

           {{-- <ul class="main-list list-unstyled">
            <li class="{{ isActiveTapFront('wedding-plan') }}">
                <a href="{{ url('/wedding-plan') }}">
                  <img src="{{url('/')}}/front/imgs/star.png" alt="contact">
                  خطط لزواجك مع زفاف
                  <i class="fas fa-chevron-left float-right"></i>
                </a>
            </li>
            <li class="{{ isActiveTapFront('wedding-accessories') }}">
                <a href="{{ url('/wedding-accessories') }}">
                  <img src="{{url('/')}}/front/imgs/star.png" alt="help">
                  اكسسوارات زفاف
                  <i class="fas fa-chevron-left float-right"></i>
                </a>
            </li>
            <li class="{{ isActiveTapFront('privacy') }}">
                <a href="{{ url('/wedding-kosha') }}">
                  <img src="{{url('/')}}/front/imgs/star.png" alt="star">
                  كوشة زفاف
                  <i class="fas fa-chevron-left float-right"></i>
                </a>
            </li>

            <li class="{{ isActiveTapFront('wedding-cake') }}">
                <a href="{{ url('/wedding-cake') }}">
                  <img src="{{url('/')}}/front/imgs/star.png" alt="star">
                  كعكة زفاف
                  <i class="fas fa-chevron-left float-right"></i>
                </a>
            </li>

            <li class="{{ isActiveTapFront('wedding-pictorial-programs') }}">
                <a href="{{ url('/wedding-pictorial-programs') }}">
                  <img src="{{url('/')}}/front/imgs/star.png" alt="star">
                 برامج زفاف التصويرية
                  <i class="fas fa-chevron-left float-right"></i>
                </a>
            </li>

          </ul> --}}

           <ul class="main-list list-unstyled">
             <!--<li class="{{ isActiveTapFront('agents') }}">
                 <a href="{{ url('/agents') }}">
                   <img src="{{url('/')}}/front/imgs/agents.png" alt="contact">وكلاء زفاف
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>-->
			 @if(Session::has('token'))
             <li class="{{ isActiveTapFront('contact-us') }}">
				@if(Session::get('user')['packageLevel'] > 3)
                 <a href="{{ url('/contact-us/send/marriage') }}">
				@else
					<a href="#" class="has-no-permission-level2">
				@endif
                   <img src="{{url('/')}}/backend/imgs/marriage_request.png" alt="contact">استمارة زفاف
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>

			 <li class="{{ isActiveTapFront('support') }}">
                 <a href="{{ url('/support') }}">
                   <img src="{{url('/')}}/front/imgs/Artboard 1.png" alt="contact">الدعم التقني
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
			 @endif
             <li class="{{ isActiveTapFront('our-mission') }}">
                 <a href="{{ url('/our-mission') }}">
                   <img src="{{url('/')}}/front/imgs/our-message.png" alt="help">رسالتنا
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             <li class="{{ isActiveTapFront('privacy') }}">
                 <a href="{{ url('/privacy') }}">
                   <img src="{{url('/')}}/front/imgs/privacy.png" alt="star">سياسة الخصوصية
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             <li class="{{ isActiveTapFront('conditions') }}">
                 <a href="{{ url('/conditions') }}">
                   <img src="{{url('/')}}/front/new_imgs/terms.png" alt="star">الشروط والأحكام
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             <li class="{{ isActiveTapFront('usage') }}">
                 <a href="https://www.youtube.com/@zefaaf" target="_blank">
                   <img src="{{url('/')}}/social_icons/youtube.png" alt="star">يوتيوب زفاف
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>

			 <li class="{{ isActiveTapFront('usage') }}">
                 <a href="{{ $settings['Whatsapp'] }}" target="_blank">
                   <img src="{{url('/')}}/front/whats.png" alt="star">لتفعيل الاشتراكات
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>

			 <li class="{{ isActiveTapFront('usage') }}">
                 <a href="https://t.me/{{ $settings['mobile'] }}" target="_blank">
                   <img src="{{url('/')}}/front/telegram.png" alt="star">خدمة تقارب
                   <i class="fas fa-chevron-left float-right"></i>
                 </a>
             </li>
             {{-- <li>
              <a href="#">
                <img src="{{url('/')}}/front/imgs/rate-app.png" alt="star">تقييم التطبيق
                <i class="fas fa-chevron-left float-right"></i>
              </a>
            </li> --}}
           </ul>

           <!-- social media link -->
           <div class="social-link mb-4">
             <h3>تابعنا على وسائل التواصل الإجتماعي</h3>
             <ul class="list-inline social-link my-3">
               <li class="list-inline-item" style="background: unset;"><a href="{{ $settings['Instagram'] }}" target="_blank">
			   {{--<i class="fab fa-instagram"></i>--}}
			   <img src="{{url('/')}}/social_icons/instagram.png" width="25" />
			   </a></li>
               {{--<li class="list-inline-item"><a href="{{ $settings['Whatsapp'] }}" target="_blank">
			   <i class="fab fa-whatsapp"></i>
			   <img src="{{url('/')}}/social_icons/whatsapp.png" width="25" />
			   </a></li>--}}
               <li class="list-inline-item"><a href="{{ $settings['Facebook'] }}" target="_blank">
			   {{--<i class="fab fa-facebook-f"></i>--}}
			    <img src="{{url('/')}}/social_icons/facebook.png" width="25" />
			   </a></li>

			   <li class="list-inline-item"><a href="https://www.twitter.com/@zefaaf" target="_blank">
			   {{--<i class="fab fa-facebook-f"></i>--}}
			    <img src="{{url('/')}}/social_icons/twitter.png" width="25" style="margin-right: -2px;margin-top: -3px;" />
			   </a></li>
			   {{--<li class="list-inline-item" style="background:none"><a href="https://t.me/{{ $settings['mobile'] }}" target="_blank">
			   <img src="{{url('/')}}/social_icons/telegram.png" width="25" />
			   </a></li>--}}
             </ul>
           </div>

           <!-- packages -->
           <div class="packages owl-carousel">
            @foreach($packages as $key=>$value)
             {{-- <div class="item text-center p-2">
               <h2>${{ $value['usdValue'] }}</h2>
               <span>{{ $value['title'] }}</span>
               <p>
                {{ isset($value['desc'])?$value['desc']:"" }}
               </p> --}}
               {{-- <a href="{{ url('/packages/purchase') }}/{{ $value['id'] }}" class="btn btn-light float-sm-right">اشترك الآن</a> --}}
               {{-- <a href="{{ url('/packages/details') }}/{{ $value['id'] }}" class="btn btn-light float-sm-right">اشترك الآن</a> --}}
               {{-- <a href="#" onclick="save({{ $value['id'] }})" class="btn btn-light float-sm-right">اشترك الآن</a>
             </div> --}}
             @endforeach

           </div>

         </div>
       </nav>


