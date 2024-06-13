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

  <!-- Start messages list -->
  <div class="messages-list p-5">
    <div class="container">
      <h3 class="sub-title">وكلاء زفاف</h3>

      {{-- <div class="search-input input-group mb-4">
        <input type="text" id="filter" class="form-control" placeholder="بحث.." aria-describedby="search">
        <div class="input-group-append">
          <span class="input-group-text" id="search"><i class="fas fa-search"></i></span>
        </div>
      </div> --}}
	  
      
        <div class="notificate-list">
            @if($collection)
            @foreach ($collection as $item)
                    
                <a href="javascript:;" class="media chat-users">
                    <div class="item-img" style="position: relative;">
                            
                    </div>

                    <div class="media-body">
                        <h5> 
                            <img src="{{url('/')}}/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 7.png': 'Artboard 1.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;"> 
                            {{ $item['name'] }}
							@if(isset($item['countryName']))
                            <span>
                                <img src="{{url('/')}}/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 10.png': 'Artboard 4.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;"> 
                                {{ $item['countryName'] }}
                            </span>
							@endif
                        </h5>
                        {{-- <h5 style="float: left;margin-top: -58px;margin-left: 50px;">
                            
                        </h5> --}}
                        {{-- <p>
                            <img src="{{url('/')}}/front/imgs/email.png" alt="contact" style="width: 30px;height: 30px;border-radius: unset;">  
                            <span onclick="window.location.href = 'mailto:{{ $item['email'] }}'" > 
                                {{ $item['email'] }} 
                            </span> 
                        </p>
                        <p>
                            <span>
                                <img src="{{url('/')}}/public/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 8.png': 'Artboard 2.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;">  
                                <span onclick="window.location.href = 'mailto:{{ $item['email'] }}'" style="display: inline-block;"> 
                                    {{ $item['email'] }} 
                                </span> 
                            </span> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>
                                <img src="{{url('/')}}/public/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 11.png': 'Artboard 5.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;">  
                                <span style="display: inline-block;">
                                    {{ $item['mobile'] }} 
                                </span> 
                            </span> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>
                                <img onclick='window.location.href = "https://wa.me/{{ $item['whats'] }}"'  src="{{url('/')}}/public/social_icons/whatsapp.png" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;cursor:pointer">  
                                <!--<span onclick='window.location.href = "https://api.whatsapp.com/send?phone={{ $item['whats'] }}"' style="display: inline-block;">
                                    {{ $item['whats'] }} 
                                </span> -->
								<span onclick='window.location.href = "https://wa.me/{{ $item['whats'] }}"' style="display: inline-block;">
                                    {{ $item['whats'] }} 
                                </span> 
                            </span>                                
                            
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>
                                <img src="{{url('/')}}/public/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 12.png': 'Artboard 6.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;">  
                                <span style="display: inline-block;">
                                    {{ $item['localValue'] }} 
                                </span> 
                            </span>                                
                        </p> --}}
						
						
						<div class="row no-gutters"> 
<div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
<p>
 <img src="{{url('/')}}/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 8.png': 'Artboard 2.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;">  
 <span onclick="window.location.href = 'mailto:{{ $item['email'] }}'" style="display: inline-block;"> 
                                    {{ $item['email'] }} 
                                </span> 
</p>
</div>

<div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
<p>
 <img src="{{url('/')}}/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 11.png': 'Artboard 5.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;">  
<span style="display: inline-block;">
                                    {{ $item['mobile'] }} 
                                </span> 
</p>
</div>

<div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
<p>
 <img onclick='window.location.href = "https://wa.me/{{ $item['whats'] }}"'  src="{{url('/')}}/social_icons/whatsapp.png" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;cursor:pointer">   
<span onclick='window.location.href = "https://wa.me/{{ $item['whats'] }}"' style="display: inline-block;">
                                    {{ $item['whats'] }} 
                                </span> 
</p>
</div>
@if(isset($item['localValue']))
<div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
<p>
 <img src="{{url('/')}}/front/imgs/agents/{{ Session::get('user') && Session::get('user')['gender'] == 1 ? 'Artboard 12.png': 'Artboard 6.png' }}" alt="contact" style="width: 30px;height: 30px;border-radius: unset;object-fit: contain;">  
<span style="display: inline-block;">
                                    {{ $item['localValue'] }} 
                                </span> 
</p>
</div>
@endif




</div>
                        
                    </div>
                    
                </a>
            @endforeach 
            @else
                <div class="col-md-10">
                    <img src="{{url('/')}}/front/new_imgs/Artboard 1.png" style="width: 75%;height: auto;opacity: unset;">
                </div>
            @endif    
            

        </div>
		
		
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
		

        <!--<div class="text-right">
            <a class="btn btn-primary main-btn" href="{{ url('/add/agent') }}">انضم إلي وكلائنا</a>
        </div>-->

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
}

</script>

@endpush  

@endsection		

