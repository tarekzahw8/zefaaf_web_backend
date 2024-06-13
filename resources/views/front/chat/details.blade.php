@extends('front.layouts.app')
@section('content')

@include("front.chat.chatStyle")

@php 
$status_color = isset($user) && $user['available']==1?"green":(isset($user) && $user['available']==2 ?"#FF4E4E" : "gray") ;
//dd(Session::get('user')) 'mmmmmmmmmmmmm';
@endphp

 <!-- Start chat -->
 <div class="chat pb-5 p-md-5">
    <div class="container">
{{-- 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style">
          <li class="breadcrumb-item"><a href="{{ url('chats') }}">الرسائل</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $user['userName'] }}</li>
        </ol>
       </nav> --}}

       <div class="notificate-list mb-5" id="chat-list">
          <div class="media">
            <div class="item-img" style="position: relative">
                <a href="{{ url('/members/details') }}/{{ $user['id'] }}">@if($user['userImage'] !='')
                    <img class="mr-3" src="{{Config::get('app.image_url')}}/{{ $user['userImage'] }}" alt="item">
                @else
                    @if(Session::get('user')['gender'] == 1)
                        <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="member img">
                    @else
                        <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="member img">
                    @endif
                @endif </a>
                <span class="status-badge" id="status-badge" style="background:{{ $status_color }};top:0px">
				@if($user['packageId'] > 0)
							@if(Session::get('user')['gender'] == 1 )
								@if($user['packageLevel'] == 4)	
										<img src="{{url('/')}}/platinum.png" alt="crown" > 
									@elseif($user['packageLevel'] == 5)	
										<img src="{{url('/')}}/mass.png" alt="crown" > 
									@else
										<img src="{{url('/')}}/front/imgs/man_star.png" alt="crown" > 
									@endif	
							@else
								<img src="{{url('/')}}/front/imgs/king.png" alt="crown" >
							@endif
						@endif
				</span>
            </div>

            <div class="media-body">
              <h5><a href="{{ url('/members/details') }}/{{ $user['id'] }}"> {{ $user['userName'] }}</a><span><i class="fas fa-ellipsis-v dropdown-toggle" data-toggle="dropdown" aria-expanded="true"></i>

                <div class="dropdown-menu">
                  <a class="dropdown-item chat-block" href="javascript:;">حظر العضو</a>
                  <a class="dropdown-item" href="{{ url('/hide/chat/') }}/{{ $chatId }}">إخفاء المحادثة</a>
                  <!--<a class="dropdown-item" href="{{ url('/support')}}?other={{ $user['id'] }}">إرسال شكوى</a>-->
                  <a class="dropdown-item" href="javascript:;"  data-toggle="modal" data-target="#exampleModal">إرسال شكوى</a>
                </div>
              </span></h5>
              
              @if($user['detectedCountry'] !="")
                <span style="color:#ff0018;font-size: 14px;">{{ $user['detectedCountry'] }}</span>
              @endif
              <p><i class="fas fa-map-marker-alt pr-2"></i>{{ $user['cityName'] }}/ {{ $user['nationalityCountryName'] }}</p>
              @if ($user['available'] == 1)
                <p style="color:green" id="available"> متصل الآن </p>    
              @else
                <p id="available" style="font-size: .7rem;color: #366FDF;padding: 5px 20px;border-radius: 5px;opacity: unset;"> آخر ظهور : {{ (isset($user['lastAccess']))?str_replace("pm","م",str_replace("am" ,"ص",\Carbon\Carbon::parse($user['lastAccess'])->addHours(2)->format('Y-m-d h:i a'))) : ""  }} </p>    
              @endif
              <span id="type-record-message"></span>
            </div>
          </div>
          @if (Session::get('user')['gender'] == 1)
            <div id="ad-message">
              <img src="{{url('/')}}/front/new_imgs/va.png">
            </div>    
          @endif
		  @php
			if(Session::get('va_img') == 1)
			{
				session()->put('va_img',2);
			}
		  @endphp
          
          
      </div>

      <div class="chat-box" data-page="1" data-chat="">

        {{-- <div class="chat-date">
          <span>11 ديسمبر 2020</span>
        </div> --}}
        @foreach ($collection as $item)
          @if($item['owner'] < 0)
          @php
              $date = \Carbon\Carbon::parse($item['messageDate']);
              $isToday = $date->isToday();
              $isYesterday = $date->isYesterday();
              $day =  $date->diffInDays();
          @endphp   
            <div class="chat-date">
              
              @if ($isToday)
                <span>اليوم</span>
              @elseif($isYesterday)
                <span> أمس </span>
              @elseif($day < 7)
              <span> {{ arabicDay($date) }} </span> 
              @else
                <span>{{ arabicDate($item['messageDate']) }} </span>
              @endif
              
            </div>
          @else

          @php
              $style='';
              $class= ($item['owner'] == 1)? "chat-l" : "chat-r";
              if($item['type'] == 3) $style="style=width:300px";
          @endphp
              <div class="{{ $class }} d-flex">
                  @if ($item['owner'] == 1)
                      <div class="sp"></div>
                  @endif
                  <div class="mess {{ $item['owner'] == 1? "" : "mess-r"}}" {{ $style }}>
                    @if ($item['parent'])
                      <span class="parent"> <span class="parent-message">
                        @if ($item['parentType'] == 2)
                           <img  src="{{Config::get('app.uploaded_url')}}/{{ $item['parentMessage'] }}" title="" width="100" height="100">
                        @elseif($item['parentType'] == 3)
                        <audio controls style="width: 100%;">
                          <source src="{{Config::get('app.uploaded_url')}}/{{ $item['parentMessage'] }}" type="audio/ogg">
                          <source src="{{Config::get('app.uploaded_url')}}/{{ $item['parentMessage'] }}" type="audio/mpeg">
						  <source src="{{Config::get('app.uploaded_url')}}/{{ $item['parentMessage'] }}" type="audio/mp4">
                          Your browser does not support the audio element.
                          </audio>
                        @elseif($item['parentType'] == 1)
                          <img  src="{{Config::get('app.uploaded_url')}}/{{$item['parentMessage']}}" title="" width="100" height="100">
                        @else
                          {{ $item['parentMessage'] }}
                        @endif
                        
                      </span>
                    @endif
                    
                      <p>
                        @if ($item['owner'] != 1)
                            @if ($item['type'] == 3 && $item['played'] == 1)
                            <img src="{{url('/')}}/front/new_imgs/blue_mic.png" alt="check">
                            @else
                            <img src="{{url('/')}}/front/imgs/arrow.png" alt="check">
                            @endif
                        @endif
                        @if($item['type'] == 2)
                            <img  src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" title="" width="100" height="100" class="sticker-message">
                        @elseif($item['type'] == 3)
                            <audio controls style="width: 100%;">
                            <source src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" type="audio/ogg">
                            <source src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" type="audio/mpeg">
							<source src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" type="audio/mp4">
                            Your browser does not support the audio element.
                            </audio>
                        @elseif($item['type'] == 1)
                      <img  src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" title="" width="100" height="100" class="sticker-message">
                            @else
                                {{$item['message']}}
                            @endif
						</p> 
						@if ($item['owner'] != 1)
						<span class="svg-icon svg-icon-primary svg-icon-2x delete-message" data-id="{{ $item['id'] }}" style="cursor:pointer"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36px" height="36px" viewBox="0 0 36 36" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="36" height="36"/>
        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
@endif
                    @if ($item['parent'])                        
                      </span>  
                    @endif
                  
                  <div class="check">
                      <span> {{ arabictime($item['messageTime'],Session::get('timeZone')) }} </span>
                  </div>
                  </div>
                    @if ($item['owner'] != 1)
                      <div class="sp"></div>
				    @endif
                  
              </div>
          @endif
        @endforeach
        

        
      </div>

      <div class="chat-footer d-flex">
        @if (Session::get('user')['packageLevel'] > 1)
          <div class="mic" id="audio-record" data-clicks="0">    
        @else
          <div class="mic" id="audio-record-error-message">
        @endif
          <i class="fas fa-microphone"></i>
        </div>
		@if(Session::get('user')['packageLevel'] > 0)
        <div class="send" id="send-chat-message">
          <i class="fas fa-paper-plane"></i>
        </div>
		@else
			<div class="send has-no-permission-level1">
				<i class="fas fa-paper-plane"></i>
			</div>
		@endif	
        <div class="txt-input d-flex">
          <div class="emoji">
            <img src="{{url('/')}}/front/new_imgs/sticker-icon.png" data-toggle="modal" data-target="#modelId" style="width: 20px;">
			
            {{-- <i class="fas fa-heart" data-toggle="modal" data-target="#modelId"></i> --}}
          </div>
          <textarea id="chatTxt" placeholder="اكتب هنا" rows="4"></textarea>
          <div class="message-box" style="display: none"><span class="onair"><span class="icon icon-recording"></span> جاري التسجيل:</span> <span class="timer"></span> 
            <a href="javascript:;" id="StopRecord" style="display: none"> إيقاف </a>
          </div>
          <div class="message-box-text" style="display: none"><span class="onair"><span class="icon icon-recording"></span> جاري الإرسال </span> </div>
          <div class="message-box-stop" style="display: none"><span class="onair"><span class="icon icon-recording"></span> جاري التحميل  </span> </div>

          <div class="message-box-audio" style="display: none"><span class="onair"><span class="icon icon-recording"></span>التسجيل:</span> 
            {{-- <span class="timer-audio"></span>  --}}
            <a href="javascript:;" onclick="sendAudioFile()"> إرسال <i class="fas fa-paper-plane"></i></a>
            <a href="javascript:;" onclick="deleteAudio()"> تراجع <i class="fas fa-trash"></i></a>
            <input type="hidden" name="base64" id="base64" />
            <input type="hidden" name="url" id="url" />
            <input type="hidden" name="duration" id="duration" />
          </div>
          {{-- <div class="add-img" >
            <input type="file" name="chat_image" id="ChatImage" style="display: none;">
            <i class="fas fa-image" id="ChatImageModal"></i>
          </div> --}}
        </div>
      </div>

    </div>
  </div>
  <!-- End chat -->

  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body pl-5 mt-3">
                
                <div class="row justify-content-center">
                    @foreach ($stickers as $key=>$item)
                    <div class="col-auto example-block text-center">
                      <label class="radio-inline"> 
                        <input type="radio" name="emotion" data-dir="{{ $stickersDir }}" data-img="stickers{{$key}}" id="sad" class="input-hidden emoji-radio" value="{{$stickersDir}}/{{$item}}" />
                        <img class="emoji-img" id="stickers{{$key}}" src="{{Config::get('app.uploaded_url')}}/{{ $stickersDir }}/{{$item}}" width="35" height="35">
                      </label>
                    </div>
                    @endforeach
                    @foreach ($zefaafStickers as $key=>$item)
                    <div class="col-auto example-block text-center">
                      <label class="radio-inline"> 
                        <input type="radio" name="emotion" data-dir="{{ $zefaafStickersDir }}" id="sad" data-img="zefstickers{{$key}}" class="input-hidden emoji-radio" value="{{$zefaafStickersDir}}/{{$item}}" />
                        <img class="emoji-img" id="zefstickers{{$key}}" src="{{Config::get('app.uploaded_url')}}/{{ $zefaafStickersDir }}/{{$item}}" width="35" height="35">
                      </label>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            <div class="modal-footer justify-content-between" style="display:none">
                 <button type="button" class="btn btn-primary" id="SubmitEmojy" data-dismiss="modal">إرسال</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">إرسال شكوى</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="chat-contact-from" action="{{ url('/contact-us') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">العنوان:</label>
            <input type="text" class="form-control" name="title" id="recipient-name">
            <input type="hidden" name="otherId" value=" {{ $user['id'] }} ">
            <input type="hidden" name="reasonId" value=" 1 ">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">المحتوى:</label>
            <textarea class="form-control" id="message-text" name="message" rows="7" placeholder="المحتوى"></textarea>
          </div>
          <div class="form-group">
            <input type="button" id="loadFileXml" value="ارفع صورة" onclick="document.getElementById('imgInp').click();" />
            <input class="form-control" type="file" name="file" value="Upload" id="imgInp" style="display: none" />
          </div>
          <div class="form-group">
            <img src="" id="image_file" width="300" height="300" style="display:none;">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
        <button type="submit" id="SubmitExample" class="btn btn-primary">إرسال</button>
      </div>
    </div>
  </div>
</div>


    
@include("front.chat.chatScript")





@endsection		

