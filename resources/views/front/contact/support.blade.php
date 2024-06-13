@extends('front.layouts.app')
@section('content')



            <!-- Start contact us form -->
            <div class="contact-us p-5 min-height-footer">
               <div class="container">
				@if(Session::get('token'))
					@if(Session::get('user')['packageId'] ==15)
					{{--<a href="{{ url('/contact-us/send/marriage') }}" class="btn btn-link write-msg main-btn" id="marriage_btn">الدعم التقني</a>--}}
					@else
						{{--<a href="javascript::;" class="btn btn-link write-msg main-btn invalid_marriage_btn" id="marriage_btn">الدعم التقني</a>--}}
					@endif		
					
					{{--<a href="javascript:;"  data-toggle="modal" data-target="#exampleModal" class="btn btn-link write-msg main-btn" style="margin-top: -1rem;margin-left: 10px;">إرسال شكوى</a>--}}
                    
                  @endif
                  <h3 class="sub-title">الدعم التقني</h3>
				  
				  
				  
                    <p>
                      للتواصل مع فريق الدعم التقني يرجى التواصل على:
					  <br />
						📧: <a href="mailto:Support@zefaaf.net">Support@zefaaf.net </a>
						<br />
						 <img src="{{url('/')}}/social_icons/telegram.png" alt="star" width="20">: <a href="https://t.me/zefaaf" target="_blank">https://t.me/zefaaf</a>
                    </p>
                
                  
               </div>
            </div>
            <!-- End contact us form -->






@endsection		
