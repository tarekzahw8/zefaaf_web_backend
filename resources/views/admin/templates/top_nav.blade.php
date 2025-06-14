
<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
							<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
											{{-- <img class="h-20px w-20px rounded-sm" src="{{ $img }}" alt=""> --}}
										</div>
									</div>
									<!--end::Toggle-->

								</div>

	@php
		$admin = Session::get('admin');
		if(Session::get('agent'))
		{
			$admin = Session::get('agent');
		}

		if(Session::get('telesale'))
		{
			$admin = Session::get('telesale');
		}

	@endphp


	<div class="m-stack__item m-topbar__nav-wrapper">
		<ul class="m-topbar__nav m-nav m-nav--inline">
			<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
				<a href="#" class="m-nav__link m-dropdown__toggle">
					<span class="m-topbar__userpic">
						<img src="{{asset('/backend/assets/app/media/img/users/user3.png')}}" alt=""/>
					</span>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
					<div class="m-dropdown__inner">

						<div class="m-dropdown__header m--align-center" style="background: url({{ config('app.url') }}//backend/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
							<div class="m-card-user m-card-user--skin-dark">
								<div class="m-card-user__pic">
									<img src="{{asset('/backend/assets/app/media/img/users/user3.png')}}" alt=""/>
								</div>
								<div class="m-card-user__details">
									<span class="m-card-user__name m--font-weight-500">
										 {{ $admin['name'] }}
									</span>
									<a href="" class="m-card-user__email m--font-weight-300 m-link">
										 {{ $admin['email'] }}
									</a>
								</div>
							</div>
						</div>
						<div class="m-dropdown__body">
							<div class="m-dropdown__content">
								<ul class="m-nav m-nav--skin-light">
									<li class="m-nav__section m--hide">
										<span class="m-nav__section-text">Section</span>
									</li>
									@if (Session::get('admin'))
									<li class="m-nav__item">
										<a href="{{url('admin/profile')}}" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-profile-1"></i>
											<span class="m-nav__link-title">
												<span class="m-nav__link-wrap">
													<span class="m-nav__link-text">{{ __('admin.Profile') }}</span>
												</span>
											</span>
										</a>
									</li>
									@endif

									<li class="m-nav__separator m-nav__separator--fit">
									</li>
									<li class="m-nav__item">
										<a href="{{url('admin/logout')}}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">{{ __('admin.LogOut') }}</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</li>

		</ul>
	</div>
</div>
