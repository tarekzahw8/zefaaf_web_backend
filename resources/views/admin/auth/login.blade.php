<!DOCTYPE html>
<html lang="ar">

<!-- begin::Head -->
<head>
	<meta charset="utf-8" />
	<title> zefaaf | {{ __('admin.admin_panel') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!--end::Web font -->

	<!--begin::Base Styles -->

	<link href="{{asset('/backend/assets/vendors/base/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/backend/assets/demo/default/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />


	<!--end::Base Styles -->
	<link rel="shortcut icon" href="{{ config('app.url') }}//favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ config('app.url') }}//backend/assets/app/media/img//bg/bg-3.jpg);">
			<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
				<div class="m-login__container">
					<div class="m-login__logo">
						<a href="#">
							<img src="{{asset('/logo.png')}}" style="width:80px;">
						</a>
					</div>
					<div class="m-login__signin">
						<div class="m-login__head">
							<h3 class="m-login__title">الدخول إلى لوحة التحكم</h3>
						</div>
						@if($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
							<strong>{{ $errors->first() }}</strong>
						</div>
						@endif
						<form class="m-login__form m-form" action="{{ url('/') }}/admin/auth/login" method="post">
							{{ csrf_field() }}
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="text" placeholder="{{ __('admin.email') }}"
								name="email" autocomplete="off">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input m-login__form-input--last"
								type="password" placeholder="{{ __('admin.password') }}" name="password">
							</div>
							<div class="form-group m-form__group" style="margin-top: 10px;margin-right: 30px;">
								<input type="checkbox" name="remeber" value="1" class="form-check-input" id="remeber">
								<label class="form-check-label" for="remeber">
									تذكرني
								</label>
							</div>
							<div class="m-login__form-action">
								<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" style="background-color: #2aacff; border: none;">{{ __('admin.sign_in') }}</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- end:: Page -->

	<!--begin::Base Scripts -->
	<script src="{{asset('/backend/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('/backend/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

	<!--end::Base Scripts -->

</body>

<!-- end::Body -->
</html>
