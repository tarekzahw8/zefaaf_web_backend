@extends('front.layouts.app')
@section('content')
@push('style')
<style>
.notificate-list .media {
  margin-bottom: 50px;
}
</style>
@endpush

  <!-- Start messages list -->
  <div class="messages-list p-5">
    <div class="container">
		@if($collection)
		<a href="javascript::;" class="btn btn-link write-msg main-btn delete-chat-messages" id="marriage_btn">
	حذف جميع المحادثات 
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg>
		</a>
		@endif
      <h3 class="sub-title">الرسائل</h3>

      <div class="search-input input-group mb-4">
        <input type="text" id="filter" class="form-control" placeholder="بحث.." aria-describedby="search">
        <div class="input-group-append">
          <span class="input-group-text" id="search"><i class="fas fa-search"></i></span>
        </div>
      </div>
   
        <div class="notificate-list">
            @if($collection)
          
            @foreach ($collection as $item)
			
                    @php 
					
                        $status_color = $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") 
                    @endphp
                <a href="{{ url('/chats/details/') }}/{{ $item['otherId'] }}" class="media chat-users" data-name="{{ $item['otherName'] }}">
                
                    <div class="item-img" style="position: relative;">
                        @if($item['userImage'] !='')
                            <img class="mr-3" src="{{Config::get('app.image_url')}}/{{ $item['userImage'] }}" alt="item">
                        @else
                            @if(Session::get('user')['gender'] == 1)
                                <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="member img">
                            @else
                                <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="member img">
                            @endif
                        @endif
                        <span class="status-badge" style="background:{{ $status_color }};width: 15px;
                        height: 15px;position: absolute;margin-top: -4px;margin-right: -2px;">
						@if($item['packageId'] > 0)
							@if(Session::get('user')['gender'] == 1 )
								<img src="{{url('/')}}/front/imgs/man_star.png" alt="crown" >
							@else
								<img src="{{url('/')}}/front/imgs/king.png" alt="crown" >
							@endif
						@endif
						</span>
						
                    </div>

                    <div class="media-body">
                        <h5>{{ $item['otherName'] }}
                            <span>
                                @if($item['new'])
                                    <span style="background:green;width: 15px;height: 15px;position: absolute;border: 1px solid #fff;border-radius: 50%;margin-right: -20px;"></span>
                                @endif
                                {{ FormateDate($item['lastMessagetime']) }} {{ arabictime($item['lastMessagetime'],Session::get('timeZone')) }}
                                
                            </span>
                        </h5>
                        <p>{{ $item['lastMessage'] }}
                        </p>
                    </div>
                    
                </a>
				<button data-name="{{ $item['otherName'] }}" class="btn btn-link write-msg main-btn delete-single-chat-messages" data-id="{{$item['id']}}">
	حذف المحادثة
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg>
		</button>
            @endforeach 
            @else
                <div class="col-md-10">
                    <img src="{{url('/')}}/front/new_imgs/Artboard 1.png" style="width: 75%;height: auto;opacity: unset;">
                </div>
            @endif    
            

        </div>
    </div>

  </div>
  <!-- End messages list -->

@push('script')

<script>

$("#filter").keyup(function(){
    var selectSize = $(this).val();
    filter(selectSize);
});

function filter(e) {
    var regex = new RegExp('\\b\\w*' + e + '\\w*\\b');
    $('.chat-users').hide().filter(function () {
        return regex.test($(this).data('name'))
    }).show();
	
	$('.delete-single-chat-messages').hide().filter(function () {
        return regex.test($(this).data('name'))
    }).show();
}


$(".not_available").click(function (e) { 
    e.preventDefault();
    toastr.error('يجب ترقية الباقة. هذه الخدمة لأصحاب الباقة الفضية ');
});

</script>

@endpush  

@endsection		

