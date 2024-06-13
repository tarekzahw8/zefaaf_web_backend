<!DOCTYPE html>

<html lang="ar">
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
			google: {
				"families": ["Montserrat:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!--end::Web font -->

	<!--begin::Base Styles -->



	<link href="{{asset('backend/assets/vendors/base/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />


	<link href="{{asset('backend/assets/vendors/base/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('backend/assets/demo/demo3/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('backend/imageuploadify.css')}}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

	<!--end::Base Styles -->

	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" />

	<style>
		.tox-pop.tox-pop--right,
		.tox-notification.tox-notification--in.tox-notification--error {
			display: none !important;
		}
	</style>
	@php
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	@endphp

	@if (stripos( $user_agent, 'Safari') !== false)
	<style>
		._ban,
		.activate {
			color: #000 !important;
		}

		.btn-danger,
		.btn-success,
		.btn-primary {
			color: #000 !important;
		}

		.primary {
			color: #000 !important;
		}
	</style>
	@else
	<style>
		._ban,
		.activate {
			color: #fff !important;
		}

		.btn-danger,
		.btn-success,
		.btn-primary {
			color: #fff !important;
		}

		.warning {
			background-color: #ffb822 !important;
			border-color: #ffb822;
			color: #fff !important
		}

		.success {
			background-color: #2ca189 !important;
			border-color: #2ca189 !important;
			color: #fff !important
		}

		.danger {
			background-color: #f4516c !important;
			border-color: #f4516c !important;
			color: #fff !important
		}

		.dark {
			background-color: #343a40 !important;
			border-color: #34bfa3 !important;
			color: #fff !important
		}

		.primary {
			background-color: #5867dd !important;
			border-color: #5867dd !important;
			color: #fff !important
		}
	</style>
	@endif
	<style>
		#m_header_topbar .dropdown {
			margin-top: 15px;
			width: 30px;
		}
	</style>


	<style>
		.m-timeline-1__item {
			margin-top: 5px;
		}

		#msgBox {
			color: red;
		}

		.select_multi_options .btn-group {
			display: block !important;
			width: 100%;
		}

		.select_multi_options .btn-group>.btn:first-child {
			display: block !important;
			width: 100%;
		}

		.m-checkbox-inline .m-checkbox,
		.m-checkbox-inline .m-radio,
		.m-radio-inline .m-checkbox,
		.m-radio-inline .m-radio {
			display: inline-block;
			margin-left: 20px;
			margin-bottom: 20px;
		}

		.m-checkbox>span,
		.m-radio>span {
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
			border-width: 0 0 2px 2px !important;
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
		}

		audio,
		video {
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

		.btn-group-lg>.btn.btn-icon,
		.btn.btn-icon.btn-lg {
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
			animation: animation-dropdown-menu-fade-in .3s ease 1, animation-dropdown-menu-move-up .3s ease-out 1;
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

		.symbol.symbol-20>img {
			width: 100%;
			max-width: 20px;
			height: 20px;
		}

		.navi .navi-item .navi-link:hover {
			-webkit-transition: all .15s ease;
			transition: all .15s ease;
			color: #3699ff
		}

		.en_text {
			text-align: left;
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
			-webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
			outline-offset: unset !important;
			margin-right: 5px;
		}

		#example_filter input:hover {
			border-color: unset;
			outline-offset: unset !important;
		}

		.m-portlet__head-text {
			color: blue !important;
		}

		body,
		html {
			font-size: 14px !important;
		}

		.table-bordered thead td,
		.table-bordered thead th {
			color: red !important;
			font-size: 16px !important;
		}

		.table-bordered td,
		.table-bordered th {
			font-size: 16px;
		}

		.m-portlet__head-text {
			font-size: 20px !important;
		}

		.m-form .col-form-label,
		.m-form .form-control-label,
		.m-form .m-form__group>label {
			font-size: 18px !important;
		}

		.form-control,
		.form-control[readonly] {
			font-size: 16px;
		}
	</style>
	@stack('style')
</head>
<!-- end::Head -->


<!-- begin::Body -->

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">



	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">


		<!-- BEGIN: Header -->
		@include('admin.templates.header')
		<!-- END: Header -->

		<!-- begin::Body -->
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			<!-- BEGIN: Left Aside -->
			<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>

			@include('admin.templates.side_nav')

			<!-- END: Left Aside -->
			<div class="m-grid__item m-grid__item--fluid m-wrapper">

				<!-- BEGIN: Subheader -->
				<div class="m-subheader ">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="m-subheader__title m-subheader__title--separator"></h3>
						</div>
					</div>
				</div>

				<!-- END: Subheader -->
				<div class="m-content">
					@yield('content')
				</div>
			</div>


		</div>
		<!-- end:: Body -->


		@include('admin.templates.footer')


	</div>
	<!-- end:: Page -->


	<!-- begin::Scroll Top -->
	<div id="m_scroll_top" class="m-scroll-top">
		<i class="la la-arrow-up"></i>
	</div>
	<!-- end::Scroll Top -->

	<!--begin::Base Scripts -->
	<script src="{{asset('backend/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('backend/assets/demo/demo3/base/scripts.bundle.js')}}" type="text/javascript"></script>
	<!--end::Base Scripts -->



	{{-- <script src="{{asset('backend/default/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
	<script src="{{asset('backend/assets/demo/default/custom/components/base/sweetalert2.js')}}" type="text/javascript"></script>

	<script src="{{asset('backend/assets/demo/default/custom/components/base/bootstrap-multiselect.js')}}" type="text/javascript"></script>


	<script type="text/javascript">
		base_url = '{{url(app()->getLocale()."/admin")}}';
	</script>

	<!--begin::Page Snippets -->
	<script src="{{asset('backend/assets/app/js/dashboard.js')}}" type="text/javascript"></script>
	<script src="{{asset('backend/SimpleAjaxUploader.min.js')}}" type="text/javascript"></script>

	<!--end::Page Snippets -->

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
	<script src='https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js'></script>

	<script src="https://ckeditor.com/latest/ckeditor.js" type="text/javascript"></script>
	{{-- <script src="{{asset('backend/ckeditor-classic.js')}}" type="text/javascript"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

	<script type="text/javascript" src="{{asset('backend/jquery.canvasjs.min.js')}}"></script>
	@if (Session::get('agent'))
	@include('admin.templates.toastr')
	@endif
	<script type="text/javascript" src="{{asset('/tinymce/js/tinymce/tinymce.min.js')}}"></script>

	<script type="text/javascript">
		tinymce.init({
			selector: '#kt-ckeditor-6',

			directionality: 'rtl',
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
			imagetools_cors_hosts: ['picsum.photos'],
			menubar: 'file edit view insert format tools table help',
			toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
			toolbar_sticky: true,
			automatic_uploads: true,
			image_advtab: true,
			convert_urls: false,
			// content_css: '//www.tiny.cloud/css/codepen.min.css',
			link_list: [{
					title: 'My page 1',
					value: 'http://www.tinymce.com'
				},
				{
					title: 'My page 2',
					value: 'http://www.moxiecode.com'
				}
			],
			image_list: [{
					title: 'My page 1',
					value: 'http://www.tinymce.com'
				},
				{
					title: 'My page 2',
					value: 'http://www.moxiecode.com'
				}
			],
			image_class_list: [{
					title: 'None',
					value: ''
				},
				{
					title: 'Some class',
					value: 'class-name'
				}
			],
			importcss_append: true,
			automatic_uploads: true,

			images_upload_url: '/upload',

			file_picker_types: 'image',

			images_upload_handler: function(blobInfo, success, failure) {
				var xhr, formData;
				xhr = new XMLHttpRequest();
				xhr.withCredentials = false;
				xhr.open('POST', '/upload');
				xhr.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");

				xhr.onload = function() {
					var json;

					if (xhr.status != 200) {
						failure('HTTP Error: ' + xhr.status);
						return;
					}

					json = JSON.parse(xhr.responseText);

					if (!json || typeof json.location != 'string') {
						failure('Invalid JSON: ' + xhr.responseText);
						return;
					}

					success(json.location);
				};

				formData = new FormData();
				formData.append('file', blobInfo.blob(), blobInfo.filename());

				xhr.send(formData);
			},
			file_picker_callback: function(cb, value, meta) {
				var input = document.createElement('input');
				input.setAttribute('type', 'file');
				input.setAttribute('accept', 'image/*');
				input.onchange = function() {
					var file = this.files[0];
					var reader = new FileReader();

					reader.onload = function() {
						var id = 'blobid' + (new Date()).getTime();
						var blobCache = tinymce.activeEditor.editorUpload.blobCache;
						var base64 = reader.result.split(',')[1];
						var blobInfo = blobCache.create(id, file, base64);
						blobCache.add(blobInfo);

						// call the callback and populate the Title field with the file name
						cb(blobInfo.blobUri(), {
							title: file.name
						});
					};
					reader.readAsDataURL(file);
				};

				input.click();
			},
			height: 400,
			image_caption: true,
			quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
			noneditable_noneditable_class: "mceNonEditable",
			toolbar_mode: 'sliding',
			contextmenu: "link image imagetools table",
		});

		CKEDITOR.replace('kt-ckeditor-5', {
			language: 'ar',
			extraPlugins: 'embed',
			toolbar: [{
					name: 'document',
					groups: ['mode', 'document', 'doctools'],
					items: ['Source', '-', 'Save']
				},
				{
					name: 'clipboard',
					groups: ['clipboard', 'undo'],
					items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
				},
				'/',
				{
					name: 'basicstyles',
					groups: ['basicstyles', 'cleanup'],
					items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
				},
				{
					name: 'links',
					items: ['Link', 'Unlink', 'Embed']
				},
				{
					name: 'paragraph',
					groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
					items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
				},
				'/',
				{
					name: 'styles',
					items: ['Iframe', 'Styles', 'Format', 'Font', 'FontSize']
				},
				{
					name: 'colors',
					items: ['TextColor', 'BGColor']
				},
				{
					name: 'tools',
					items: ['Maximize', 'ShowBlocks', 'Embed', 'Image']
				},
			],
			embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
			allowedContent: true,
			filebrowserUploadUrl: "{{ url('upload.php') }}"
		});


		// CKEDITOR.replace('kt-ckeditor-6', {
		// 	language: 'ar',
		// 	extraPlugins: 'embed',
		// 	toolbar: [{
		// 			name: 'document',
		// 			groups: ['mode', 'document', 'doctools'],
		// 			items: ['Source', '-', 'Save']
		// 		},
		// 		{
		// 			name: 'clipboard',
		// 			groups: ['clipboard', 'undo'],
		// 			items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
		// 		},
		// 		'/',
		// 		{
		// 			name: 'basicstyles',
		// 			groups: ['basicstyles', 'cleanup'],
		// 			items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
		// 		},
		// 		{
		// 			name: 'links',
		// 			items: ['Link', 'Unlink', 'Embed']
		// 		},
		// 		{
		// 			name: 'paragraph',
		// 			groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
		// 			items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
		// 		},
		// 		'/',
		// 		{
		// 			name: 'styles',
		// 			items: ['Iframe', 'Styles', 'Format', 'Font', 'FontSize']
		// 		},
		// 		{
		// 			name: 'colors',
		// 			items: ['TextColor', 'BGColor']
		// 		},
		// 		{
		// 			name: 'tools',
		// 			items: ['Maximize', 'ShowBlocks', 'Embed', 'Image']
		// 		},
		// 	],
		// 	embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
		// 	allowedContent: true,
		// 	filebrowserUploadUrl: "{{ url('upload.php') }}",
		// 	filebrowserUploadMethod: "form"
		// });

		// CKEDITOR.replace('kt-ckeditor-7', {
		// 	language: 'ar',
		// 	extraPlugins: 'embed',
		// 	toolbar: [{
		// 			name: 'document',
		// 			groups: ['mode', 'document', 'doctools'],
		// 			items: ['Source', '-', 'Save']
		// 		},
		// 		{
		// 			name: 'clipboard',
		// 			groups: ['clipboard', 'undo'],
		// 			items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
		// 		},
		// 		'/',
		// 		{
		// 			name: 'basicstyles',
		// 			groups: ['basicstyles', 'cleanup'],
		// 			items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
		// 		},
		// 		{
		// 			name: 'links',
		// 			items: ['Link', 'Unlink', 'Embed']
		// 		},
		// 		{
		// 			name: 'paragraph',
		// 			groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
		// 			items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
		// 		},
		// 		'/',
		// 		{
		// 			name: 'styles',
		// 			items: ['Iframe', 'Styles', 'Format', 'Font', 'FontSize']
		// 		},
		// 		{
		// 			name: 'colors',
		// 			items: ['TextColor', 'BGColor']
		// 		},
		// 		{
		// 			name: 'tools',
		// 			items: ['Maximize', 'ShowBlocks', 'Embed', 'Image']
		// 		},
		// 	],
		// 	embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
		// 	allowedContent: true,
		// 	filebrowserUploadUrl: "{{ url('upload.php') }}",
		// 	filebrowserUploadMethod: "form"
		// });
	</script>

	<script>
		$('#ad_image').each(function() {
			if ($(this).hasClass('uploadify')) {
				$(this).imageuploadify();
			}
		});

		
		{{-- $(function () {
        $('#datepicker1').datepicker({
            autoclose: true,
            todayHighlight: true,
        });
    }); --}}

		$(document).ready(function() {
			$('.search-select').selectize({
				sortField: 'text'
			});
		});

		$(document).on('focus', ".datepicker-me-class", function() {
			$(this).datepicker({
				format: 'yyyy-mm-dd',
				days: ['الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت'],
				daysShort: ['الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت'],
				daysMin: ['الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت'],
				months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
				monthsShort: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
				autoclose: true
			}).on('changeDate', function(ev) {
				console.log("here");
				$(this).datepicker('hide');
			});
		});

		{{-- $('.datePicker').datepicker().on('changeDate', function(ev)
    {
        $('.datepicker-me-class').hide();
    }); --}}



		$('._remove').on('click', function() {
			id = $(this).attr('data-id');
			swal({
				title: '{{ __("admin.do you want to continue") }}',
				confirmButtonText: '{{ __("admin.yes") }}',
				cancelButtonText: '{{ __("admin.no") }}',
				showCancelButton: true,
				showCloseButton: true,
				target: document.getElementById('rtl-container')
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '{{url("/admin")}}/{{ isset($route)? $route : "" }}/' + id,
						type: 'POST',
						data: {
							'_method': 'delete',
							'_token': $('meta[name="csrf-token"]').attr('content')
						},
						success: function(msg) {
							if (msg.status === 'success') {
								swal({
									position: 'center',
									type: 'success',
									title: '{{ __("admin.Deleted successfully") }}',
									showConfirmButton: false,
									timer: 2000
								});
								window.location.reload();
							} else if (msg.status === 'failed') {
								swal({
									position: 'center',
									type: 'error',
									title: msg.message,
									showConfirmButton: false,
									timer: 2000
								});
							}
						},
						error: function() {
							swal({
								position: 'center',
								type: 'error',
								title: "{{ __('admin.Cancelled') }}",
								showConfirmButton: false,
								timer: 2000
							});
							//window.location.reload();
						},
					});
				} else {
					swal({
						position: 'center',
						type: 'error',
						title: "{{ __('admin.Cancelled') }}",
						showConfirmButton: false,
						timer: 2000
					});
				}
			});
		});


		$('._ban').on('click', function() {
			id = $(this).attr('data-id');
			swal({
				title: 'هل أنت متأكد من الايقاف ؟',
				confirmButtonText: 'نعم',
				cancelButtonText: 'لا',
				showCancelButton: true,
				showCloseButton: true,
				target: document.getElementById('rtl-container')
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '{{url("/admin")}}/{{ isset($OtherRoute)? $OtherRoute : "" }}/ban/' + id,
						type: 'POST',
						data: {
							'_method': 'post',
							'_token': $('meta[name="csrf-token"]').attr('content'),
							'active': 0,
							'id': id
						},
						success: function(msg) {
							if (msg.status === 'success') {
								window.location.reload();
							}
						},
						error: function() {
							window.location.reload();
						},
					});
				} else {
					swal({
						position: 'center',
						type: 'error',
						title: "تم الالغاء",
						showConfirmButton: false,
						timer: 2000
					});
				}
			});
		});




		$('._activate').on('click', function() {
			id = $(this).attr('data-id');
			swal({
				title: 'هل أنت متأكد من التفعيل ؟',
				confirmButtonText: 'نعم',
				cancelButtonText: 'لا',
				showCancelButton: true,
				showCloseButton: true,
				target: document.getElementById('rtl-container')
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '{{url("/admin")}}/{{ isset($OtherRoute)? $OtherRoute : "" }}/activate/' + id,
						type: 'POST',
						data: {
							'_method': 'post',
							'_token': $('meta[name="csrf-token"]').attr('content'),
							'active': 1,
							'id': id
						},
						success: function(msg) {
							if (msg.status === 'success') {
								window.location.reload();
							}
						},
						error: function() {
							window.location.reload();
						},
					});
				} else {
					swal({
						position: 'center',
						type: 'error',
						title: "تم الالغاء",
						showConfirmButton: false,
						timer: 2000
					});
				}
			});
		});



		$('._suspend').on('click',function(){
	balance = 10;
	name = "test";
	id = $(this).attr('data-id');
	$.confirm({
		title: ' حظر العضو ',
		content: '' +
			'<form action="" class="formName">' +
				'<div class="form-group">' +
			'</div>'+
			  '<div class="form-group">' +
			'<label>تاريخ نهاية الحظر</label>' +
			'<input value="" placeholder="dd-mm-yyyy" onkeydown="return false" min="{{ date('Y-m-d', strtotime(' +1 day')) }}" type="date" name="susbendedTillDate" class="susbendedTillDate form-control" required />' +
			'</div>' +
			'</form>',
			buttons: {
				formSubmit: {
					text: 'تأكيد الحظر',
					btnClass: 'btn-blue',
					action: function () {
						var susbendedTillDate = this.$content.find('.susbendedTillDate').val();
                        swal({
                            title: 'هل أنت متأكد من الحظر ؟',
                            confirmButtonText:  'نعم',
                            cancelButtonText:  'لا',
                            showCancelButton: true,
                            showCloseButton: true,
                            target: document.getElementById('rtl-container')
                          }).then((result) => {
                            if (result.value) {
                               
                                $.ajax({
                                    url: '{{url("/admin")}}/{{ isset($OtherRoute)? $OtherRoute : "" }}/suspend/'+id,
                                    type: 'POST',
                                    data: {'_method':'post','_token': $('meta[name="csrf-token"]').attr('content'),'active':2,'id':id,'susbendedTillDate':susbendedTillDate },
                                    success: function( msg ) {
                                        if ( msg.status === 'success' ) {
                                            window.location.reload();
                                        }
                                    },
                                    error : function(){
                                            window.location.reload();
                                    },
                                });
                            }
                          });
					}
				},
				cancel: {
							text: 'الغاء',
							action: function () {
							}
					}
			},
			onContentReady: function () {
				// bind to events
				var jc = this;
				this.$content.find('form').on('submit', function (e) {
					// if the user submits the form by pressing enter in the field.
					e.preventDefault();
					jc.$$formSubmit.trigger('click'); // reference the button and click it
				});
			}
		});
	});



		$('._subscribe').on('click', function() {
			balance = 10;
			name = "test";
			id = $(this).attr('data-id');
			$.confirm({
				title: ' إشتراك لعميل ',
				content: '' +
					'<form action="" class="formName">' +
					'<div class="form-group">' +
					'</div>' +
					'<div class="form-group">' +
					'<label>الباقة</label>' +
					'<select name="packageId" class="packageId form-control" required>' +
					@if(isset($user_packages))
				@foreach($user_packages as $key => $item)
				'<option value="{{ $item["id"] }}"> {{ $item["title"] }} </option>' +
				@endforeach
			'<option value="11"> مدفوع </option>' +
				@endif 
				'</select>' +
				'</div>' +
				'</form>',
				buttons: {
					formSubmit: {
						text: 'تأكيد الإشتراك',
						btnClass: 'btn-blue',
						action: function() {
							var packageId = this.$content.find('.packageId').val();
							swal({
								title: 'هل أنت متأكد  ؟',
								confirmButtonText: 'نعم',
								cancelButtonText: 'لا',
								showCancelButton: true,
								showCloseButton: true,
								target: document.getElementById('rtl-container')
							}).then((result) => {
								if (result.value) {

									$.ajax({
										url: '{{url("/admin")}}/{{ isset($OtherRoute)? $OtherRoute : "" }}/subscribe/' + id,
										type: 'POST',
										data: {
											'_method': 'post',
											'_token': $('meta[name="csrf-token"]').attr('content'),
											'id': id,
											'packageId': packageId
										},
										success: function(msg) {
											if (msg.status === 'success') {
												window.location.reload();
											}
										},
										error: function() {
											window.location.reload();
										},
									});
								}
							});
						}
					},
					cancel: {
						text: 'الغاء',
						action: function() {}
					}
				},
				onContentReady: function() {
					// bind to events
					var jc = this;
					this.$content.find('form').on('submit', function(e) {
						// if the user submits the form by pressing enter in the field.
						e.preventDefault();
						jc.$$formSubmit.trigger('click'); // reference the button and click it
					});
				}
			});
		});








		$('._add_coupons').on('click', function() {
			balance = 10;
			name = "test";
			id = $(this).attr('data-id');
			$.confirm({
				title: 'اضافة كوبونات  ',
				content: '' +
					'<form action="" class="formName">' +
					'<div class="form-group">' +
					'<label>العدد المطلوب</label>' +
					'<input name="copounsCount" class="copounsCount form-control" required />' +
					'</div>' +
					'<div class="form-group">' +
					'<label>الباقة</label>' +
					'<select name="packageId" class="packageId form-control" required>' +
					@foreach($packages as $key => $item)
				'<option value="{{ $item["id"] }}"> {{ $item["title"] }} </option>' +
				@endforeach '</select>' +
				'</div>' +
				'</form>',
				buttons: {
					formSubmit: {
						text: 'تأكيد ',
						btnClass: 'btn-blue',
						action: function() {
							var packageId = this.$content.find('.packageId').val();
							var copounsCount = this.$content.find('.copounsCount').val();
							swal({
								title: 'هل أنت متأكد  ؟',
								confirmButtonText: 'نعم',
								cancelButtonText: 'لا',
								showCancelButton: true,
								showCloseButton: true,
								target: document.getElementById('rtl-container')
							}).then((result) => {
								if (result.value) {

									$.ajax({

										url: '{{url("/admin")}}/{{ isset($OtherRoute)? $OtherRoute : "" }}/addCopouns/' + id,
										type: 'POST',
										data: {
											'_method': 'post',
											'_token': $('meta[name="csrf-token"]').attr('content'),
											'id': id,
											'packageId': packageId,
											'copounsCount': copounsCount
										},
										success: function(msg) {
											if (msg.status === 'success') {
												window.location.reload();
											}
										},
										error: function() {
											window.location.reload();
										},
									});
								}
							});
						}
					},
					cancel: {
						text: 'الغاء',
						action: function() {}
					}
				},
				onContentReady: function() {
					// bind to events
					var jc = this;
					this.$content.find('form').on('submit', function(e) {
						// if the user submits the form by pressing enter in the field.
						e.preventDefault();
						jc.$$formSubmit.trigger('click'); // reference the button and click it
					});
				}
			});
		});

		$("#username_coupon").on('input', function() {
			let search = this.value;
			let length = this.value.length;
			if (length >= 6) {
				$.get("{{url('/agent_dashboard/counpon/search/user')}}", {
						search: search,
						type: 'notification'
					})
					.done(function(data) {
						$("#load-coupon-users").html(data);
					});
			}
		});




		$('#confirm_search').on('click', function(e) {
            console.log("test")
			e.preventDefault();
			$('#search_form').submit();
		});

		$(document).ready(function() {
			$('#multiselect').multiselect({
				includeSelectAllOption: true,
				maxHeight: 200,
				enableFiltering: true,
				nonSelectedText: 'اختر',
				selectAllText: 'اختر الكل',
				filterPlaceholder: 'ابحث ...',
				allSelectedText: " تم اختيار الكل ",
				nSelectedText: " مختارة "
			});

		});
	</script>

	<script>
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

		function readURLUpload(input, img_name) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#' + img_name).show();
					$('#' + img_name).attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function() {
			readURL(this);
		});

		$(".imgInpu").change(function() {
			$img_name = $(this).attr('name');
			readURLUpload(this, $img_name);
		});
		$(document).ready(function() {
			$('#example').DataTable({
				"paging": false,
				"ordering": false,
				"info": false,
				"oLanguage": {
					"sSearch": "بحث : ",
				},
				"fnInitComplete": function(oSettings) {
					oSettings.oLanguage.sZeroRecords = "لا يوجد نتائج للبحث"
				}
			});
		});
	</script>

	@stack('script')
</body>
<!-- end::Body -->

</html>
