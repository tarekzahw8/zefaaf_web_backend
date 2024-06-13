<!DOCTYPE html>

<html lang="ar" >
<!-- begin::Head -->
<head>
	<meta charset="utf-8" />

	<title>{{ __('admin.steps') }} | {{ __('admin.Dashboard') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Montserrat:300,400,500,600,700","Roboto:300,400,500,600,700"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!--end::Web font -->

	<!--begin::Base Styles -->



	<link href="{{asset('public/backend/assets/vendors/base/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	

	<link href="{{asset('public/backend/assets/demo/demo3/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	

	<link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" />

	<style>
		
		#m_header_topbar .dropdown {
			margin-top: 15px;
			width: 30px;
		}
		._ban,.activate {
			color: #fff !important;
		}
		.btn-danger , .btn-success , .btn-primary
		{
			color: #fff !important;
		}
	</style>
	

	<style>
		.m-timeline-1__item{
			margin-top: 5px;
		}
		#msgBox{
			color: red;
		}
		.select_multi_options .btn-group
		{
			display: block !important;
			width: 100%;
		}
		.select_multi_options .btn-group>.btn:first-child
		{
			display: block !important;
			width: 100%;
        }
        .m-checkbox-inline .m-checkbox, .m-checkbox-inline .m-radio, .m-radio-inline .m-checkbox, .m-radio-inline .m-radio {
            display: inline-block;
            margin-left: 20px;
            margin-bottom: 20px;
        }
        .m-checkbox>span, .m-radio>span {
            border-radius: 3px;
            background: 100% 0;
            position: absolute;
            top: 1px;
            right: 0;
            height: 20px;
            width: 20px;
        }
        .m-checkbox>span:after {
            top: 50%;
            right: 50%;
            margin-right: -6px;
            margin-top: -4px;
            width: 13px;
            height: 7px;
            border-width: 0 0 2px 2px!important;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        audio, video {
            max-width: 100% !important;
        }
        .m-timeline-1 .m-timeline-1__items .m-timeline-1__item .m-timeline-1__item-content .media>img {
            width: 50px;
            height: 50px;
            border-radius: 150px;
        }
		.topbar .dropdown {
			display: flex;
			-webkit-box-align: stretch;
			align-items: stretch;
		}
		.topbar .topbar-item {
			display: flex;
			-webkit-box-align: center;
			align-items: center;
		}
		.btn-group-lg > .btn.btn-icon, .btn.btn-icon.btn-lg {
			height: calc(1.5em + 1.65rem + 2px);
			width: calc(1.5em + 1.65rem + 2px);
		}
		.btn:not(:disabled):not(.disabled) {
			cursor: pointer;
		}
		.btn.btn-clean {
			color: #b5b5c3;
			background-color: transparent;
			border-color: transparent;
		}
		.h-20px {
			height: 20px !important;
		}
		.w-20px {
			width: 20px !important;
		}
		.rounded-sm {
			border-radius: .28rem !important;
		}
		.dropdown-menu.dropdown-menu-sm {
			width: 175px;
		}
		.dropdown-menu.dropdown-menu-anim-up {
    		animation: animation-dropdown-menu-fade-in .3s ease 1,animation-dropdown-menu-move-up .3s ease-out 1;
		}
		.navi {
			padding: 0;
			margin: 0;
			display: block;
			list-style: none;
		}
		.navi .navi-item {
			padding: 0;
			display: block;
			list-style: none;
		}
		.navi .navi-item .navi-link {
			color: #3f4254;
		}
		.navi .navi-item .navi-link {
			font-size: 1rem;
		}
		.navi .navi-item .navi-link {
			display: flex;
			-webkit-box-align: center;
			align-items: center;
			padding: .75rem 1.5rem;
			text-decoration: none;
			background-color: transparent;
		}
		.symbol.symbol-20 > img {
			width: 100%;
			max-width: 20px;
			height: 20px;
		}
		
		.navi .navi-item .navi-link:hover
		{-webkit-transition:all .15s ease;transition:all .15s ease;color:#3699ff}
		.en_text{
			text-align:left;
		}
		#example_filter input {
			border-color: #ebedf2;
			display: inline-block;
			padding: .85rem 1.15rem;
			font-size: 1rem;
			line-height: 1.25;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: .25rem;
			-webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			outline-offset: unset !important;
			margin-right: 5px;
		}

		#example_filter input:hover {
			border-color:unset;
			outline-offset: unset !important;
		}
		
	</style>
	@stack('style')
</head>
<!-- end::Head -->


    <!-- begin::Body -->
    <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >


        <div class="row">
            <div class="col-lg-12">
        
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-progress">
        
                            <!-- here can place a progress bar-->
                        </div>
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        تقارير المدفوعات
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                {{-- <a href="{{url('/admin/'.$route.'/create')}}" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('admin.add') }}</span>
                                    </span>
                                </a> --}}
        
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="table-responsive">
        
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="color: red !important;"><b>اسم العضو</b></th>
                                            <th style="color: red !important;"><b>رقم الهاتف</b></th>
                                            <th style="color: red !important;"><b>النوع</b></th>
                                            <th style="color: red !important;"><b>الباقة </b></th>
                                            <th style="color: red !important;"><b>الدولة </b></th>
                                            <th style="color: red !important;"><b>تاريخ الإشتراك</b></th>
                                            <th style="color: red !important;"><b>قيمة الإشتراك</b></th>
                                            <th style="color: red !important;"><b>مرجع الإشتراك</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include("admin.$view.loop_payment")
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
        
        
            </div>
            <!--end::Portlet-->
        </div>
        </div>
<script src="{{asset('public/backend/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/demo/demo3/base/scripts.bundle.js')}}" type="text/javascript"></script>
</body>
<!-- end::Body -->
</html>
