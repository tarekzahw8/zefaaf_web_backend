@extends('front.layouts.app')
@section('content')
<style>
.min-height-footer{
   min-height: 650px !important;
}
.packages-data {
    width: calc(25% - 16px);
    float: right;
    margin: 0px 8px;
}

.packages-data img{width:100%;}

@media (max-width: 768px) {
    .packages-data {margin-bottom : 30px; text-align:center;}
.packages-data img{width:70%; margin:auto;max-height:90vh;}
    
   .min-height-footer{
     min-height: unset !important;   
   }
   .packages-data{
      width: unset !important;
      float: none !important;
      margin-left: unset !important;
   }
}
@media (max-width: 575.98px) {
   .min-height-footer{
     min-height: unset !important;   
   }
   .packages-data{
      width: unset !important;
      float: none !important;
      margin-left: unset !important;
   }
}
@media (max-width: 400px) {
   .min-height-footer{
     min-height: unset !important;   
   }
   .packages-data{
      width: unset !important;
      float: none !important;
      margin-left: unset !important;
   }
}

.paypal-button * {
    max-width: 80%!important;
    margin: 0 auto!important;
    /* height: 43px!important; */
    text-align: center;
}
.paypal-button{ margin-top:10px;}
</style>

            <!-- Start packages list -->
            <div class="py-5 px-2 min-height-footer" >
               <div class="container text-center">
                  <h3 class="sub-title">الباقات</h3>
                  <div style="
    display: inline-flex;
    flex-wrap: wrap;
    align-items: end;justify-content: center;
">
                     {{-- <h5><img src="{{url('/')}}/public/front/imgs/crowns.png" alt="crown">الباقات المميزه</h5> --}}
                     {{-- <p class="packages-description">
                        {!! isset($settings['backageDesc'])?$settings['backageDesc']:"" !!}
                     </p> --}}
                     @foreach($packages as $key=>$item)
					 
                     <div class="packages-data" style="">
                       
                           @if (Session::get('user'))
							      <a href="javascript:;" class='pay-button' data-id="{{ $item['id'] }}" style="cursor: default;">  
									@else
                           <a href="javascript:;" class='not-auth'>
                           @endif   
                           
                           <img src="{{Config::get('app.image_url')}}/{{ $item['image'] }}" >
                              @if (Session::get('user'))
                                 <div id="paypal-button-{{ $key }}" data-id="{{ $item['id'] }}" data-amount="{{ $item["usdValue"] }}" class="paypal-button" data-title="{{ $item['title'] }}"></div>
                              @endif					   
                           </a>
                        
                     </div>
                     @endforeach
					 
					 
                     {{-- <div class="packages-list mt-5">
                         @foreach($packages as $key=>$item)
                        <div class="row package mx-0">
                                <div class="col-sm-4 text-center">
                                    <h2>${{ $item['usdValue'] }}</h2>
                                    <span>{{ $item['title'] }}</span>
                                </div>
                            <div class="col-sm-8">
                                <p>
                                
                                {!! isset($settings['backageDesc'])?$settings['backageDesc']:"" !!}
                                </p>
                                <a href="{{ url('/packages/details') }}/{{ $item['id'] }}" class="btn btn-light float-sm-right">اشترك الآن</a>
                            </div>
                       </div> 
                       @endforeach

                     </div> --}}
                  </div>
				  @if($agent)
						 <button class="btn btn-primary main-btn" onclick="window.location = '{{ url('/agents') }}';" type="button" style="background-color:red">وكيل بلدك </button> 
					 @endif
               </div>
            </div>
            <!-- End packages list -->
{{-- <div id="root"></div> --}}

@push('script')
    <script>
		   var title = "";
       $(".not-auth").click(function (e) { 
          e.preventDefault();
          toastr.error("يجب تسجيل الدخول أولاً");
       });
	   $(".pay-button").click(function (e) { 
		  title = $(this).attr("data-title");
          $("#paypal-button").click();
       });
    </script>
@if (Session::get('user'))	
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>

<script>
   document.querySelectorAll('.paypal-button').forEach(function(selector) {
        paypal.Button.render({
         env: 'production',
         client: {
            sandbox: 'sandbox-id',
            production: 'AeY_P1Gvr3QDz4PaizUeV1u7imht3hyGT7uMckgQcGUMDJnDSq0gsd21XZ35KLGlouw9PpIvsTT-8scQ'
         },
         // Customize button (optional)
         locale: 'ar_EG',
         style: {
            size: 'medium',
            color: 'gold',
            shape: 'pill',
            label: 'buynow',
            tagline: 'false'
         },
         funding:
         {
            disallowed: [ paypal.FUNDING.CREDIT ]
         },

         // Enable Pay Now checkout flow (optional)
         commit: true,

         // Set up a payment
         payment: function(data, actions) {
            return actions.payment.create({
            transactions: [{
                  amount: {
                     total: selector.dataset.amount, //Package value
                     currency: 'USD'
                  },
                  description: 'اشتراك في باقة زفاف المدفوعه',
                  custom: "{{ Session::get('user')['id'] }}:"+selector.dataset.amount, //userId:pavkageId

            }]
            });
         },
         // Execute the payment
         onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
            window.alert('مُبارك عليك العضوية '+title+' . إذا لم تظهر معك الباقة المدفوعة برجاء الإنتظار بضع ثوان ثم إعادة التسجيل.');
            location.replace("https://zefaaf.net?success=true");

            });
         }
        }, selector);
    });
</script>	
@endif
@endpush

@endsection		

