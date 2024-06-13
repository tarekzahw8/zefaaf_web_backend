@extends('front.layouts.app')
@section('content')


<div class="contact-us p-5 min-height-footer">
               <div class="container">

                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item"><a href="{{ url('/contact-us') }}"> طلب زواج</a></li>
                    
                  </ol>
                </nav>

                <div class="msgs-list">
                  <div class="row new-msg">
                    <div class="col-md-12">
                      <!--<h3><img src="{{url('/')}}/public/front/imgs/call-missed.png" alt="message">{{ $item['reasonId']==1 ? "شكوى" : ($item['reasonId']==2 ? "سؤال" : "اقتراح") }}</h3>-->
                      <span class="date">{{ FormateDate($item['messageDateTime']) }} {{ arabictime($item['messageDateTime'],Session::get('timeZone')) }}</span>
                    </div>
                    <!--<div class="col-md-8">
                      <p>
                        {!! $item['message'] !!}
                      </p>
                    </div>-->
                  </div>

                  <div class="msg-content">
                    <p>
                    {!! $item['message'] !!}
                    </p>
                    
                  </div>
				  @if($item['reply'])
                  <div class="msg-content">
                  
                    <p>
                    الرد : {{ $item['reply'] }}
                    </p>
					<br />
					@if(isset($item['adminImage']) !='')
						<img src="{{Config::get('app.image_url')}}/{{ $item['adminImage'] }}" id="image_file" width="100" height="100" >
					@endif
                  </div>
				  @endif
                 
                  </div>
                  
               </div>
            </div>

@endsection		

