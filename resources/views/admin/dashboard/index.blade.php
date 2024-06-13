@extends('admin.layouts.index_layout',['title' => __('admin.dashboard')])


@section('content')

<div class="row">
	
	<div class="col-lg-12">

		<!--begin:: Widgets/Quick Stats-->
		<div class="row m-row--full-height">


			<div class="col-xl-4">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::Body-->
					<div class="card-body">
						@if(Session::get('admin')['type'] ==1 || array_search(10, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
						<a href="{{ url('/admin/users') }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">مستخدمي زفاف </a>
						@else
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">مستخدمي زفاف </a>
						@endif
						{{-- <div class="font-weight-bold text-success mt-9 mb-5"></div> --}}
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							إجمالي  : {{ $totalUsers }}
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							جديد اليوم : {{ $users }}
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							جديد الشهر : {{ $users_months }}
						</h5>
						{{-- <h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							بإنتظار التفعيل : {{ $users_active }}
						</h5> --}}
						
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
						@if(Session::get('admin')['type'] ==1 || array_search(10, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
						<a href="{{ url('/admin/users') }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">نوع الأعضــــاء </a>
						@else
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">نوع الأعضــــاء </a>
						@endif
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							الرجال : {{ $men }}
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							النساء : {{ $women }}
						</h5>
						{{-- <h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							بإنتظار التفعيل : {{ $users_active }}
						</h5> --}}
						
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
						@if(Session::get('admin')['type'] ==1 || array_search(10, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
						<a href="{{ url('/admin/users') }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">أجهزة الأعضـــاء </a>
						@else
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">أجهزة الأعضـــاء </a>
						@endif
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							الاندرويد : {{ $android }}
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							الايفون : {{ $iphone }}
						</h5>
						{{-- <h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							بإنتظار التفعيل : {{ $users_active }}
						</h5> --}}
						
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
						@if(Session::get('admin')['type'] ==1 || array_search(11, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
						<a href="{{ url('/admin/subscriptions') }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الإشتراكات</a>
						@else
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الإشتراكات</a>
						@endif
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							جديد اليوم : {{ $purchases }} ({{ $todayPurchaseValue }}$)
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							جديد الشهر : {{ $purchases_months }} ({{ $monthPurchaseValue }}$)
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							ترويجي  : {{ $freeMonthPurchase }} 
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
						@if(Session::get('admin')['type'] ==1 || array_search(11, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
						<a href="{{ url('/admin/subscriptions') }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">بوابـة الدفـع</a>
						@else
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">بوابـة الدفـع</a>
						@endif
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0" dir="ltr">
						    
							 <a href="{{url('/admin/subscriptions')}}?q=applepay"> Apple  </a>: {{ $paymentRefrences[1]['total'] }} 
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							<a href="{{url('/admin/subscriptions')}}?q=googlepay">Google</a>  : {{ $paymentRefrences[2]['total'] }} 
						</h5>
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0" style="direction: ltr;">
							 <a href="{{url('/admin/subscriptions')}}?q=PayPal"> PayPal</a>  : {{ $paymentRefrences[4]['total'] }} 
						</h5>
						
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 2-->
			</div>
			
			<div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 3-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::body-->
					<div class="card-body">
						@if(Session::get('admin')['type'] ==1 || array_search(15, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
						<a href="{{ url('/admin/messages') }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">طلبات الزواج</a>
						@else
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">طلبات الزواج</a>
						@endif
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							جديد طلبات الزواج : {{ $messages }}
						</h5>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 3-->
			</div>
			
			{{-- <div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 3-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">الرجال</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							إجمالي الرجال : {{ $men }}
						</h5>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 3-->
			</div> --}}
			{{-- <div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 3-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">النساء</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							إجمالي النساء : {{ $women }}
						</h5>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 3-->
			</div> --}}
			{{-- <div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 3-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">عدد مستخدمي الأندرويد</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							 {{ $android }}
						</h5>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 3-->
			</div> --}}
			
			{{-- <div class="col-xl-4" style="margin-top: 10px;">
				<!--begin::Stats Widget 3-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="height: 100%;">
					<!--begin::body-->
					<div class="card-body">
						
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5" style="font-size: 19px;color:red !important;">عدد مستخدمي الايفون</a>
						
						<h5 class="text-dark-75 font-weight-bolder font-size-h5 m-0">
							 {{ $iphone }}
						</h5>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 3-->
			</div> --}}
			
		</div>
	</div>
</div>


<div class="row" style="margin-top: 30px">
	<div class="col-lg-12">

		<div class="row m-row--full-height">


				<div class="col-sm-6 col-md-12 col-lg-6" style="margin-bottom: 20px;box-shadow: 0 1px 15px 1px rgba(69,65,78,.08);background-color: #fff;">
					<div class="table-responsive">

                        <table class="table table-bordered" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th><b> الدولة </b></th>
									<th><b>رجال مدفوع</b></th>
                                    <th><b>رجال مجانى</b></th>
                                    <th><b>نساء  </b></th>
                                    {{-- <th><b>نساء مجانى</b></th> --}}
                                    <th><b>الاجمالى  </b></th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach ($usersChart as $item)
                                <tr>
                                    <th scope="row">{{ $item['nameAr'] }}</th>
                                    <th scope="row">{{ $item['PremiumMens'] }}</th>
									<th scope="row">{{ $item['FreeMens'] }}</th>
                                    <th scope="row">{{ $item['PremiumWomens'] }}</th>
									{{-- <th scope="row">{{ $item['FreeWomens'] }}</th> --}}
                                    <th scope="row">{{ $item['totalUsers'] }}</th>
                                    
								</tr>
								@endforeach
                        	</tbody>
                    	</table>
                	</div>
				</div>
				
				<div class="col-sm-6 col-md-12 col-lg-6" style="margin-bottom: 20px;">
					<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
				</div>

				<div class="col-sm-12 col-md-12 col-lg-6" style="box-shadow: 0 1px 15px 1px rgba(69,65,78,.08);background-color: #fff;">
					
					<div class="table-responsive">

                        <table class="table table-bordered" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th><b> الدولة </b></th>
                                    <th><b> عدد الإشتراكات </b></th>
                                    <th><b>القيمة بالدولار</b></th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach ($paymentsChart as $item)
                                <tr>
                                    <th scope="row">{{ $item['nameAr'] }}</th>
                                    <th scope="row">{{ $item['purchasesCount'] }}</th>
                                    <th scope="row">{{ $item['payments'] }}</th>
                                    
								</tr>
								@endforeach
                        	</tbody>
                    	</table>
                	</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6">
					<div id="chartContainer2" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
				</div>
		</div>
	</div>
</div>


@push('script')
<script>
	window.onload = function () {
	
		var chart = new CanvasJS.Chart("chartContainer",
    	{
		animationEnabled: true,  	
      	title:{
			text: " الأعضــــاء",
			fontSize: 20,
			fontColor:"red"
      	},
		toolTip: {
			shared: true,
			reversed: true
		},
		legend: {
			reversed: true,
			verticalAlign: "center",
			horizontalAlign: "right"
		},
        data: [
			{
				type: "stackedColumn",
				showInLegend: true,
				name: "رجال مدفوع",
				dataPoints: [
					@foreach($usersChart as $key=>$item)
						{  y: {{ $item['PremiumMens'] }} , label: "{{ $item['nameAr'] }}"},
					@endforeach
					

				]
			},
			{
				type: "stackedColumn",
				showInLegend: true,
				name: "رجال مجانى",
				dataPoints: [
					@foreach($usersChart as $key=>$item)
						{  y: {{ $item['FreeMens'] }} , label: "{{ $item['nameAr'] }}"},
					@endforeach

				]
			},
			{
        		type: "stackedColumn",
				showInLegend: true,
				name: "نساء",
				dataPoints: [
					@foreach($usersChart as $key=>$item)
						{  y: {{ $item['PremiumWomens'] }} , label: "{{ $item['nameAr'] }}"},
					@endforeach
				]
      		},
			// {
			// 	type: "stackedColumn",
			// 	showInLegend: true,
			// 	name: "نساء مجانى",
			// 	dataPoints: [
			// 		@foreach($usersChart as $key=>$item)
			// 			{  y: {{ $item['FreeWomens'] }} , label: "{{ $item['nameAr'] }}"},
			// 		@endforeach
					

			// 	]
			// } 
			
      ]
    });

    chart.render();
	//Better to construct options first and then pass it as a parameter


	var options2 = {
		exportEnabled: true,
		animationEnabled: true,
		title:{
			text: "المدفوعات",
			fontSize: 20,
			fontColor:"red"
		},
		legend:{
			horizontalAlign: "right",
			verticalAlign: "center"
		},
		data: [{
			type: "pie",
			showInLegend: true,
			toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
			indexLabel: "{name}",
			legendText: "(%{name} (#percent",
			indexLabelPlacement: "inside",
			dataPoints: [
				@foreach($paymentsChart as $key=>$item)
					{ y: {{ $item['payments'] }}, name: "{{ $item['nameAr'] }}" },
				@endforeach
				
			]
		}]
	};
	
	//$("#chartContainer").CanvasJSChart(options);
	$("#chartContainer2").CanvasJSChart(options2);
	}
	</script>
@endpush

@endsection
