@extends('front.layouts.app')
@section('content')


<div class="p-5 min-height-footer">
  <div class="container">
    <h3 class="sub-title">الإشعارات</h3>

    <!-- two tabs -->
    <ul class="nav nav-tabs members-tabs mb-3" id="membersTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link {{ !request()->show ? "active" :"" }}" id="all-tab" data-toggle="tab" href="#all" 
        role="tab" aria-controls="all" aria-selected="true">الكل</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="notificate-tab" data-toggle="tab" href="#notificate"
         role="tab" aria-controls="notificate" aria-selected="false">عام</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->show && request()->show=="visitor"? "active" :"" }}" id="visitor-tab" data-toggle="tab" href="#visitor"
         role="tab" aria-controls="visitor" aria-selected="false">شاهد حسابي </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" id="addfav-tab" data-toggle="tab" href="#addfav"
         role="tab" aria-controls="addfav" aria-selected="false">تم إضافتي لقائمة الإهتمام</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected"
         role="tab" aria-controls="rejected" aria-selected="false">تم إضافتي لقائمة التجاهل</a>
      </li> --}}
     
      
      <li class="nav-item">
        <a class="nav-link {{ request()->show && request()->show=="interest"? "active" :"" }}" id="interest-tab" data-toggle="tab" href="#interest"
         role="tab" aria-controls="interest" aria-selected="false">أبدوا إعجابهم</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="see-profileImg-tab" data-toggle="tab" href="#see-profileImg"
         role="tab" aria-controls="see-profileImg" aria-selected="false">طلبات مشاهدة صورتي</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="addfav-tab" data-toggle="tab" href="#addfav"
         role="tab" aria-controls="addfav" aria-selected="false">طلبات مشاهدتي للصور</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" id="see-profileMobile-tab" data-toggle="tab" href="#see-profileMobile"
         role="tab" aria-controls="see-profileMobile" aria-selected="false">  طلبات عرض رقم هاتفي</a>
      </li>
    </ul>

    <div class="tab-content" id="nav-tabContent">
      @php $count = 8; @endphp
      @for($i=0;$i<$count;$i++)
        @php
          $tab="all";
          $cat = -1;
          switch ($i) {
              case 1:
                  $tab = 'notificate';
                  $cat = 0;
                  break;
              case 2:
                  $tab = 'visitor';
                  $cat = 1;
                  break;
              case 3:
                  $tab = 'addfav';
                  $cat = 4;
                  break;
              case 4:
                  $tab = 'rejected';
                  $cat = 5;
                  break;
              case 5:
                  $tab = 'interest';
                  $cat = 2;
                  break;
              case 6:
                  $tab = 'see-profileImg';
                  $cat = 3;
                  break;
			  case 7:
                  $tab = 'see-profileMobile';
                  $cat = 7;
                  break;
              default:
                $tab = 'all';
                $cat = -1;
          }
          $visitor= false;
          $interest= false;
          $first= false;

          if (request()->show && request()->show=="visitor")
          {
            if($tab== "visitor")
            {
              $visitor= true;
            }
          }
          elseif (request()->show && request()->show=="interest")
          {
            if($tab== "interest")
            {
              $interest= true;
            }
          }
          if (!request()->show && $i==0)
          {
            $first= true;
          }
        @endphp
        <div class="tab-pane fade show {{ $visitor?'active':'' }} {{ $interest?'active':'' }} {{ $first?'active':'' }}"  id="{{$tab}}" role="tabpanel" aria-labelledby="{{$tab}}-tab">
          <div class="notificate-list" data-page="1" data-cat="{{ $cat }}">
            @if(($cat == -1 && $list) || ($cat >= 0 && $list && isset($countNotify[$cat]) && $countNotify[$cat] > 0))
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
					case 7:
                        $message = " قام  ".$item['userName']." بطلب عرض رقم هاتفك ";
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
                  @if ($item['notiType'] > 0 && $item['notiType'] < 12)
                      <a href="{{ url('members/details/') }}/{{ $item['userId'] }}"> 
                  @elseif($item['notiType'] == 12)
				  <a href="{{ url('contact-us') }}"> 
				  @endif	  
                  @if ($item['notiType'] > 0 && $item['notiType'] < 12)
                    @if($item['gender'] == 1)
                      <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="item">
                    @else
                      <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="item">
                    @endif
                  @else
                    <img class="mr-3" src="{{url('/')}}/front/new_imgs/icon app.jpg" alt="item">
                  @endif
                  @if ($item['notiType'] > 0  && $item['notiType'] < 12)
                    @if($item['packageId'] > 0)
                      <span class="status-badge" style="background-color:{{ $status_color }};">
                        
                        @if($item['gender'] == 1 )
                          <img src="{{url('/')}}/front/imgs/king.png" alt="crown">
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
                  @if ($item['notiType'] > 0  && $item['notiType'] < 12)
                      </a>
                  @elseif($item['notiType'] == 12)
				 </a>
				  @endif
                </div>

                <div class="media-body">
					@if ($item['notiType'] > 0 && $item['notiType'] < 12)
                      <a href="{{ url('members/details/') }}/{{ $item['userId'] }}"> 
					@elseif($item['notiType'] == 12)
						<a href="{{ url('contact-us') }}"> 
					@endif	
                  <h5>
                    {{ $item['notiType']==0?$item['title']:"تنبيه من ".$item['userName'] }} 
                    {{-- <span>{{ FormateDate($item['publishDateTime']) }} {{ arabictime(\Carbon\Carbon::parse($item['publishDateTime'])->addHours(2)) }} </span></h5> --}}
                    <span>{{ FormateDate($item['publishDateTime']) }} {{ arabictime($item['publishDateTime'],Session::get('timeZone')) }} </span></h5>
                  <p>{{ $message }}  </p>
                  @if ($item['notiType'] == 3)
                    {{-- <a href="{{ url('notifications/replyPhoto') }}?status=4&otherId={{ $item['userId'] }}" class="btn btn-block" id="ApproveRequest"> موافقة  </a>
                    <a href="{{ url('notifications/replyPhoto') }}?status=5&otherId={{ $item['userId'] }}" class="btn btn-block" id="RejectRequest"> رفض  </a> --}}
                  @endif
				  @if ($item['notiType'] == 7)
                    {{-- <a href="{{ url('members/replyMobile') }}?status=4&otherId={{ $item['userId'] }}" class="btn btn-block" id="ApproveRequest"> موافقة  </a>
                    <a href="{{ url('notifications/replyPhoto') }}?status=5&otherId={{ $item['userId'] }}" class="btn btn-block" id="RejectRequest"> رفض  </a> --}}
                  @endif
				  @if ($item['notiType'] > 0  && $item['notiType'] < 12)
                      </a>
				  @elseif($item['notiType'] == 12)
				 </a>
				  @endif
                </div>
              </div>
              @endif
              @endforeach
              @else
              <div class="col-md-10">
                <img src="{{url('/')}}/front/new_imgs/Artboard 5.png" style="width: 75%;height: 100%;opacity: unset;">
              </div>
              @endif
          </div>
        </div>
      @endfor
      </div>

  </div>
</div>
@push('script')
<script>
                    
$(document).ready(function(){
  $(window).scroll(function(){
    var page = $("#nav-tabContent .active .notificate-list").data('page');
    var cat = $("#nav-tabContent .active .notificate-list").data('cat');
    var position = $(window).scrollTop();
    var bottom = $(document).height() - $(window).height();
    if( position == bottom ){
                        
      $.ajax({
          url: '{{ url("notifications/load/more") }}',
          type: 'get',
          data: {page:page,cat:cat},
          success: function(response){
            $("#nav-tabContent .active .notificate-list").append(response);
            page = page+1;
            $('#nav-tabContent .active .notificate-list').data('page', page);
          }
      });
  }
            
  });
              
});
</script>
@endpush



@endsection		

