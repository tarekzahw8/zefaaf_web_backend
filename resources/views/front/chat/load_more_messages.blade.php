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
    $class= ($item['owner'] == 1)? "chat-l" : "chat-r";
@endphp
    <div class="{{ $class }} d-flex">
        @if ($item['owner'] == 1)
            <div class="sp"></div>
        @endif
        <div class="mess {{ $item['owner'] == 1? "" : "mess-r"}}">
          @if ($item['parent'])
            <span class="parent"> <span class="parent-message">{{ $item['parentMessage'] }}</span>
          @endif
          
            <p>
              @if ($item['owner'] != 1)
                  <img src="{{url('/')}}/public/front/imgs/arrow.png" alt="check">
              @endif
              @if($item['type'] == 2)
                  <img  src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" title="" width="100" height="100">
              @elseif($item['type'] == 3)
                  <audio controls style="width: 100%;">
                  <source src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" type="audio/ogg">
                  <source src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" type="audio/mpeg">
                  Your browser does not support the audio element.
                  </audio>
              @elseif($item['type'] == 1)
            <img  src="{{Config::get('app.uploaded_url')}}/{{$item['message']}}" title="" width="100" height="100">
                  @else
                      {{$item['message']}}
                  @endif
              </p>
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