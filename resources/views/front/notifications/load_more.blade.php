@foreach($list as $key=>$item)
@php
  $message = $item['message'];
  switch ($item['notiType']) {
      case 0:
          $message = $item['message'];
          break;
      case 1:
          $message = " قام  ".$item['userName']." بمشاهدة ملفك الشخصي ";
          break;
      case 2:
          $message = " قام  ".$item['userName']." بإضافتك إلى قائمة إعجابه ";
          break;
      case 3:
          $message = " قام  ".$item['userName']." بطلب مشاهدة صورتك الشخصية ";
          break;
      case 4:
          $message = " قام  ".$item['userName']." بالموافقة على مشاهدة صورته الشخصية ";
          break;
      case 5:
          break;
      default:
      $message= $message;
  }
@endphp
@php 
  $status_color = $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") 
@endphp
@if($cat == -1 || $cat == $item['notiType'])
<div class="media">
  <div class="item-img" style="position: relative;">
    @if ($item['notiType'] > 0)
        <a href="{{ url('members/details/') }}/{{ $item['userId'] }}"> 
    @elseif($item['notiType'] == 12)
		<a href="{{ url('contact-us') }}"> 
	@endif	
    @if ($item['notiType'] > 0)
      @if($item['gender'] == 1)
      <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="item">
      @else
      <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="item">
      @endif
    @else
      <img class="mr-3" src="{{url('/')}}/front/new_imgs/icon app.jpg" alt="item">
    @endif  
    @if ($item['notiType'] > 0)
      @if($item['packageId'] > 0)
        <span class="status-badge" style="background-color: {{ $status_color }};">
        
          @if($item['gender'] == 1 )
            <img src="{{url('/')}}/front/imgs/king.png" alt="crown" >
          @else
            @if($item['packageLevel'] == 4)	
										<img src="{{url('/')}}/platinum.png" alt="crown" > 
									@elseif($item['packageLevel'] == 5)	
										<img src="{{url('/')}}/mass.png" alt="crown" > 
									@else
										<img src="{{url('/')}}/front/imgs/man_star.png" alt="crown" > 
									@endif	
          @endif
        
        </span>
      @else
        <span class="status-badge" style="background:{{ $status_color }}"></span>
      @endif
    @endif
    @if ($item['notiType'] > 0)
        </a>
    @endif
  </div>

  <div class="media-body">
	@if ($item['notiType'] > 0)
        <a href="{{ url('members/details/') }}/{{ $item['userId'] }}"> 
    @endif
    <h5>
      {{ $item['notiType']==0?$item['title']:"تنبيه من ".$item['userName'] }} 
      <span>{{ FormateDate($item['publishDateTime']) }} {{ arabictime($item['publishDateTime'],Session::get('timeZone')) }} </span></h5>
    <p>{{ $message }} </p>
    @if ($item['notiType'] == 3)
                    {{-- <a href="{{ url('notifications/replyPhoto') }}?status=4&otherId={{ $item['userId'] }}" class="btn btn-block" id="ApproveRequest"> موافقة  </a>
                    <a href="{{ url('notifications/replyPhoto') }}?status=5&otherId={{ $item['userId'] }}" class="btn btn-block" id="RejectRequest"> رفض  </a> --}}
                  @endif
    @if ($item['notiType'] > 0)
        </a>
    @endif					
  </div>
</div>
@endif
@endforeach
