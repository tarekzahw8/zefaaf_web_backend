@extends('admin.layouts.index_layout',['title' => __('admin.dashboard')])


@section('content')
@php 
$telesale = Session::get('telesale');
@endphp
<div class="row">
	
	<div class="col-lg-12">

		<!--begin:: Widgets/Quick Stats-->
		<div class="row m-row--full-height">


	<div class="col-xl-4">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">كود التسويق
</a>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							 {{ $telesale['code'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 1-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">العمولة</a>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							 {{ $telesale['commision'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 1-->
			</div>
			
		


			<div class="col-xl-4">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">خصم العميل</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							{{ $telesale['discount'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 1-->
			</div>

			<div class="col-xl-4"  style="margin-top: 10px;">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الرصيد</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							{{ $telesale['balance'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 1-->
			</div>

			<div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 2-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الرصيد المدفوع</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							{{ $telesale['payedBalance'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 2-->
			</div>
			
			<div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 2-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الاعضاء المسجلين</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							{{ $telesale['registerdUsers'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 2-->
			</div>
			
			<div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 2-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الاشتراكات
</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							{{ $telesale['purchasedUsers'] }}
						</h5>
						
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 2-->
			</div>

			
			
		</div>
	</div>
</div>



@endsection
