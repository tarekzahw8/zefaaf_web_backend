<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
	<!-- BEGIN: Aside Menu -->
	<div
	id="m_ver_menu"
	class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown "
	data-menu-vertical="true"
	m-menu-dropdown="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500"
	>
	<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
		<li class="m-menu__item {{ isActiveTap('dashboard') }}" aria-haspopup="true" >
			@if (Session::get('agent'))
			<a  href="{{url('agent_dashboard/dashboard')}}" class="m-menu__link ">
			@else
			<a  href="{{url('admin/dashboard')}}" class="m-menu__link ">
			@endif

				<span class="m-menu__item-here"></span>
				{{-- <i class="m-menu__link-icon flaticon-line-graph"></i> --}}
				{{-- <img alt="" src="{{asset('/backend/imgs/Artboard 1.png')}}" width="40"/> --}}
				{{-- <span class="m-menu__link-text">{{ __('admin.Dashboard') }}</span> --}}
				<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 1.png')}}" width="60"/></span>
			</a>
		</li>

		@if (Session::get('admin_token'))
			@if(Session::get('admin')['type'] ==1 || array_search(1, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
				<li class="m-menu__item {{ isActiveTap('admins') }} {{ isActiveTap('admin') }}" aria-haspopup="true" >
					<a  href="{{url('admin/admins')}}" class="m-menu__link ">
						<span class="m-menu__item-here"></span>
						{{-- <i class="m-menu__link-icon flaticon-profile"></i> --}}
						<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 2.png')}}" width="60"/></span>
					</a>
				</li>
			@endif



			<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('agents') }} {{ isActiveTap('agent') }} {{ isActiveTap('coupons') }} {{ isActiveTap('coupon') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					{{-- <i class="m-menu__link-icon flaticon-layers"></i>
					<span class="m-menu__link-text">وكلاء زفاف</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i> --}}
					<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/agents.png')}}" width="60"/>
					</span>
					<span class="m-menu__link-text" style="color: white">وكلاء زفاف</span>
				</a>
				<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">

						<li class="m-menu__item {{ isActiveTap('agents') }} {{ isActiveTap('agent') }}" aria-haspopup="true">
							<a href="{{url('admin/agents')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">{{ __('admin.agents') }}</span>
							</a>
						</li>

						<li class="m-menu__item {{ isActiveTap('coupons') }} {{ isActiveTap('coupon') }}" aria-haspopup="true">
							<a href="{{url('admin/coupons')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">{{ __('admin.coupons') }}</span>
							</a>
						</li>




					</ul>
				</div>
			</li>

			@if(Session::get('admin')['type'] ==1 || array_search(12, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
				<li class="m-menu__item {{ isActiveTap('telesales') }}" aria-haspopup="true" >
					<a  href="{{url('admin/telesales')}}" class="m-menu__link ">
						<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/agents.png')}}" width="60"/>
					</span>
					<span class="m-menu__link-text" style="color: white">مناديب التسويق</span>
					</a>
				</li>
			@endif


			@if(Session::get('admin')['type'] ==1 || array_search(10, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
			<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('users') }} {{ isActiveTap('user') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					{{-- <i class="m-menu__link-icon flaticon-layers"></i> --}}
					<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 6.png')}}" width="60"/></span>
					{{-- <i class="m-menu__ver-arrow la la-angle-right"></i> --}}
				</a>
				<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">

						<li class="m-menu__item {{ isActiveTap('users') }} {{ isActiveTap('user') }}" aria-haspopup="true">
							<a href="{{url('admin/users')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">الأعضاء</span>
							</a>
						</li>

						<li class="m-menu__item {{ isActiveTap('FailedSubscriptions') }}" aria-haspopup="true">
							<a href="{{url('admin/image/users')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">صور الأعضاء</span>
							</a>
						</li>




					</ul>
				</div>
			</li>

			@endif


		@if(Session::get('admin')['type'] ==1 || array_search(11, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('subscriptions') }} {{ isActiveTap('subscription') }} {{ isActiveTap('FailedSubscriptions') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				{{-- <i class="m-menu__link-icon flaticon-layers"></i> --}}
				<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 12.png')}}" width="60"/></span>
				{{-- <i class="m-menu__ver-arrow la la-angle-right"></i> --}}
			</a>
			<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">

					<li class="m-menu__item {{ isActiveTap('subscriptions') }} {{ isActiveTap('subscription') }}" aria-haspopup="true">
						<a href="{{url('admin/subscriptions')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">الاشتراكات</span>
						</a>
					</li>

					<li class="m-menu__item {{ isActiveTap('FailedSubscriptions') }}" aria-haspopup="true">
						<a href="{{url('admin/FailedSubscriptions')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">محاولات دفع</span>
						</a>
					</li>




				</ul>
			</div>
		</li>
		@endif

		@if(Session::get('admin')['type'] ==1 || array_search(12, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item {{ isActiveTap('notifications') }}" aria-haspopup="true" >
			<a  href="{{url('admin/notifications')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				{{-- <i class="m-menu__link-icon flaticon-file-1"></i> --}}
				<span class="m-menu__link-text"> <img alt="" src="{{asset('/backend/imgs/Artboard 11.png')}}" width="60"/> </span>
			</a>
		</li>
		@endif

		{{-- <li class="m-menu__item {{ isActiveTap('agents') }} {{ isActiveTap('agent') }}" aria-haspopup="true" >
			<a  href="{{url('admin/agents')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				<i class="m-menu__link-icon flaticon-profile"></i>
				<span class="m-menu__link-text">{{ __('admin.agents') }}</span>
			</a>
		</li>

		<li class="m-menu__item {{ isActiveTap('coupons') }} {{ isActiveTap('coupon') }}" aria-haspopup="true" >
			<a  href="{{url('admin/coupons')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				<i class="m-menu__link-icon flaticon-profile"></i>
				<span class="m-menu__link-text">{{ __('admin.coupons') }}</span>
			</a>
		</li> --}}

		@if(Session::get('admin')['type'] ==1 || (array_search(2, array_column(Session::get('privlages'), 'moduleId')) !== FALSE || array_search(3, array_column(Session::get('privlages'), 'moduleId')) !== FALSE || array_search(4, array_column(Session::get('privlages'), 'moduleId')) !== FALSE ))
		<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('settings') }} {{ isActiveTap('fixedDatas') }} {{ isActiveTap('countries') }} {{ isActiveTap('cities') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				{{-- <i class="m-menu__link-icon flaticon-layers"></i> --}}
				<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 3.png')}}" width="60"/></span>
				{{-- <i class="m-menu__ver-arrow la la-angle-right"></i> --}}
			</a>
			<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					@if(Session::get('admin')['type'] ==1 || array_search(4, array_column(Session::get('privlages'), 'moduleId')) !== FALSE )
					<li class="m-menu__item {{ isActiveTap('countries') }}" aria-haspopup="true">
						<a href="{{url('admin/countries')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text" >الدول</span>
						</a>
					</li>
					@endif

					{{-- <li class="m-menu__item {{ isActiveTap('cities') }}" aria-haspopup="true">
						<a href="{{url('admin/cities')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">المدن</span>
						</a>
					</li> --}}
					@if(Session::get('admin')['type'] ==1 ||  array_search(3, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
					<li class="m-menu__item {{ isActiveTap('fixedDatas') }}" aria-haspopup="true">
						<a href="{{url('admin/fixedDatas')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">البيانات الثابتة</span>
						</a>
					</li>
					@endif
					@if(Session::get('admin')['type'] ==1 || array_search(2, array_column(Session::get('privlages'), 'moduleId')) !== FALSE )
					<li class="m-menu__item {{ isActiveTap('settings') }}" aria-haspopup="true">
						<a href="{{url('admin/settings')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">الإعدادات</span>
						</a>
					</li>
					@endif

				</ul>
			</div>
		</li>
		@endif

		@if(Session::get('admin')['type'] ==1 || array_search(6, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('abouts') }} {{ isActiveTap('privacy') }} {{ isActiveTap('register') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				{{-- <i class="m-menu__link-icon flaticon-layers"></i> --}}
				<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 4.png')}}" width="60"/></span>
				{{-- <i class="m-menu__ver-arrow la la-angle-right"></i> --}}
			</a>
			<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">

					<li class="m-menu__item {{ isActiveTap('abouts') }}" aria-haspopup="true">
						<a href="{{url('admin/abouts')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">رسالتنا</span>
						</a>
					</li>

					<li class="m-menu__item {{ isActiveTap('register') }}" aria-haspopup="true">
						<a href="{{url('admin/register')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">الشروط والأحكام</span>
						</a>
					</li>

					<li class="m-menu__item {{ isActiveTap('privacy') }}" aria-haspopup="true">
						<a href="{{url('admin/privacy')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">سياسة الخصوصية</span>
						</a>
					</li>
					<li class="m-menu__item {{ isActiveTap('License') }}" aria-haspopup="true">
						<a href="{{url('admin/License')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">قسم التسجيل</span>
						</a>
					</li>


				</ul>
			</div>
		</li>
		@endif

		{{-- <li class="m-menu__item {{ isActiveTap('settings') }}" aria-haspopup="true" >
			<a  href="{{url('admin/settings')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				<i class="m-menu__link-icon flaticon-settings-1"></i>
				<span class="m-menu__link-text"> {{ __('admin.Settings') }} </span>
			</a>
		</li> --}}
		@if(Session::get('admin')['type'] ==1 || array_search(7, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item {{ isActiveTap('packages') }} {{ isActiveTap('package') }}" aria-haspopup="true" >
			<a  href="{{url('admin/packages')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				{{-- <i class="m-menu__link-icon flaticon-profile"></i> --}}
				<span class="m-menu__link-text"> <img alt="" src="{{asset('/backend/imgs/Artboard 5.png')}}" width="60"/> </span>
			</a>
		</li>
		@endif



		@if(Session::get('admin')['type'] ==1 || array_search(10, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('favs') }} {{ isActiveTap('photos') }} {{ isActiveTap('ignors') }}" aria-haspopup="true" m-menu-submenu-toggle="hover" style="display: none">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				<i class="m-menu__link-icon flaticon-layers"></i>
				<span class="m-menu__link-text">قوائم الأعضــــاء </span>
				<i class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">

					<li class="m-menu__item {{ isActiveTap('favs') }}" aria-haspopup="true">
						<a href="{{url('admin/favs')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">قائمه الإعجاب</span>
						</a>
					</li>

					<li class="m-menu__item {{ isActiveTap('ignors') }}" aria-haspopup="true">
						<a href="{{url('admin/ignors')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">قائمه الحظر</span>
						</a>
					</li>

					<li class="m-menu__item {{ isActiveTap('photos') }}" aria-haspopup="true">
						<a href="{{url('admin/photos')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">قائمه مشاهده الصور</span>
						</a>
					</li>



				</ul>
			</div>
		</li>
		@endif



		@if(Session::get('admin')['type'] ==1 || array_search(11, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		{{-- <li class="m-menu__item {{ isActiveTap('subscriptions') }} {{ isActiveTap('subscription') }}" aria-haspopup="true" >
			<a  href="{{url('admin/subscriptions')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				<i class="m-menu__link-icon flaticon-profile"></i>
				<span class="m-menu__link-text"> <img alt="" src="{{asset('/backend/imgs/Artboard 12.png')}}" width="60"/> </span>
			</a>
		</li> --}}
		@endif

		@if(Session::get('admin')['type'] ==1 || array_search(17, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item {{ isActiveTap('chats') }}" aria-haspopup="true" >
			<a  href="{{url('admin/chats')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				{{-- <i class="m-menu__link-icon flaticon-file-1"></i> --}}
				<span class="m-menu__link-text"> <img alt="" src="{{asset('/backend/imgs/Artboard 10.png')}}" width="60"/> </span>
			</a>
		</li>
		@endif
		@if(Session::get('admin')['type'] ==1 || array_search(13, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('categories') }} {{ isActiveTap('posts') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				{{-- <i class="m-menu__link-icon flaticon-layers"></i> --}}
				<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 9.png')}}" width="60"/></span>
				<i class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">

					<li class="m-menu__item {{ isActiveTap('categories') }}" aria-haspopup="true">
						<a href="{{url('admin/categories')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">تصنيفات المقالات</span>
						</a>
					</li>

					{{-- <li class="m-menu__item {{ isActiveTap('posts') }}" aria-haspopup="true">
						<a href="{{url('admin/posts')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">المقالات</span>
						</a>
					</li> --}}

				</ul>
			</div>
		</li>
		@endif
		@if(Session::get('admin')['type'] ==1 || array_search(14, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item {{ isActiveTap('successStories') }}" aria-haspopup="true" >
			<a  href="{{url('admin/successStories')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				{{-- <i class="m-menu__link-icon flaticon-file-1"></i> --}}
				<span class="m-menu__link-text"> <img alt="" src="{{asset('/backend/imgs/Artboard 8.png')}}" width="60"/> </span>
			</a>
		</li>
		@endif
		@if(Session::get('admin')['type'] ==1 || array_search(15, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item {{ isActiveTap('messages') }}" aria-haspopup="true" >
			<a  href="{{url('admin/messages')}}" class="m-menu__link ">
				<span class="m-menu__item-here"></span>
				 {{-- <i class="m-menu__link-icon flaticon-file-1"></i> --}}
				<span class="m-menu__link-text" >
				<img alt="" src="{{asset('/backend/imgs/marriage_request.png')}}" width="60"/>
				</span>
				<span class="m-menu__link-text" style="color: #fff;">طلبات الزواج</span>
			</a>
		</li>
		@endif
		@if(Session::get('admin')['type'] ==1 || array_search(16, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
		<li class="m-menu__item m-menu__item--submenu {{ isActiveTap('UsersReport') }} {{ isActiveTap('paymentsReport') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				{{-- <i class="m-menu__link-icon flaticon-layers"></i> --}}
				<span class="m-menu__link-text"><img alt="" src="{{asset('/backend/imgs/Artboard 13.png')}}" width="60"/></span>
				<i class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu " m-hidden-height="840" style="display: none; overflow: hidden;">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">

					<li class="m-menu__item {{ isActiveTap('UsersReport') }}" aria-haspopup="true">
						<a href="{{url('admin/UsersReport')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">تقرير المستخدمين</span>
						</a>
					</li>

					<li class="m-menu__item {{ isActiveTap('paymentsReport') }}" aria-haspopup="true">
						<a href="{{url('admin/paymentsReport')}}" class="m-menu__link ">
							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
							</i>
							<span class="m-menu__link-text">تقريرالمدفوعات</span>
						</a>
					</li>

				</ul>
			</div>
		</li>
		@endif

		@endif


	</ul>
	</div>
	<!-- END: Aside Menu -->
</div>
