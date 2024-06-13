@extends('front.layouts.app')
@section('content')



            <!-- Start contact us form -->
            <div class="contact-us p-5 min-height-footer">
               <div class="container">
				@if(Session::get('token'))
					@if(Session::get('user')['packageLevel'] > 3)
						<a href="{{ url('/contact-us/send/marriage') }}" class="btn btn-link write-msg main-btn" id="marriage_btn">أضف طلب زواج 💌</a>
					@else
						<a href="javascript::;" class="btn btn-link write-msg main-btn invalid_marriage_btn" id="marriage_btn">أضف طلب زواج 💌</a>
					@endif		
                    
                  @endif
                  <h3 class="sub-title">طلبات الزواج</h3>
				  
				  
				  
                    
                  <div class="msgs-list">
                    @if($list)
                    @foreach($list as $key=>$item)
                        <a href="{{ url('/contact-us/message/details') }}/{{ $item['id'] }}" class="row {{ $key % 2 == 0 ? 'new-msg' : '' }}">
                        <div class="col-md-4">
                            <h3>
                              @if ($item['owner'] == 1)
                              <img src="{{url('/')}}/front/new_imgs/redarrow.png" alt="message">
                              @else
                              <img src="{{url('/')}}/front/imgs/call-missed.png" alt="message">
                              @endif    
                              
                              
							  </h3>
                            <span class="date">{{ FormateDate($item['messageDateTime']) }} {{ arabictime($item['messageDateTime'],Session::get('timeZone')) }}</span>
                        </div>
                        <div class="col-md-8">
                            <p>
                            {{ $item['title'] ? $item['title'] : strip_tags($item['message']) }}
                            </p>
                            @if ($item['reply'])
                                <p style="color:red"> يوجد رد </p>
                            @endif
                        </div>
                        </a>
                    @endforeach
                    @else
                    <div class="col-md-10">
                      <img src="{{url('/')}}/front/new_imgs/Artboard 1.png" style="width: 75%;opacity: unset;">
                    </div>
                    @endif

                    @if(Session::get('token'))
                    <!--<a href="{{ url('/contact-us/send/message') }}" class="btn btn-link write-msg main-btn">كتابة رسالة</a>-->
                    @endif
                  </div>
                  
               </div>
            </div>
            <!-- End contact us form -->


@endsection		

