@extends('front.layouts.app')
@section('content')

 <!-- Start contact us form -->
 <div class="p-5 min-height-footer">
               <div class="container">
                  <h3 class="sub-title">المقالات</h3>
                  <!-- two tabs -->
                <ul class="nav nav-tabs members-tabs mb-3" id="membersTab" role="tablist">
                  @foreach($categories as $key=>$item)  
                  <li class="nav-item">
                    <a class="nav-link {{ $key==0?'active' :'' }}" id="article{{$key}}-tab" data-toggle="tab" href="#article{{$key}}" 
                    role="tab" aria-controls="article{{$key}}" aria-selected="true">{{ $item['title'] }}</a>
                  </li>
                  @endforeach
                 
                  
                </ul>

                <div class="tab-content" id="nav-tabContent">
                  @foreach($categories as $key=>$item)  
                  <div class="tab-pane fade show {{ $key==0?'active' :'' }}"  id="article{{$key}}" role="tabpanel" aria-labelledby="article{{$key}}-tab">
                    <div class="articles-list" data-page="1" data-cat="{{ $item['id'] }}">
                      @if($posts[$key])
                      @foreach($posts[$key] as $key=>$item)
                      <div class="media p-0">
                        @if ($item['featureImage'])
                          <img class="mr-3" src="{{Config::get('app.image_url')}}/{{ $item['featureImage'] }}" alt="article">   
                        @else
                          <img class="mr-3" src="{{url('/')}}/front/imgs/article1.png" alt="article">    
                        @endif

                        <div class="media-body">
                          <p class="title">{{ $item['title'] }}</p>
                          <p class="date">{{ FormateDate($item['postDateTime']) }} {{ arabictime($item['postDateTime'],Session::get('timeZone')) }}</p>
                          <p>
                            {!! strip_tags($item['post']) !!}
                            </p>
                          <a href="{{ url('/') }}/{{ $type }}/details/{{ $item['id'] }}/{{ $item['catId'] }}" class="btn btn-link">التفاصيل</a>
                        </div>
                      </div>
                      @endforeach
                      @else
                      <div class="col-md-10">
                        <img src="{{url('/')}}/front/new_imgs/Artboard 8.png" style="width: 75%;height: 100%;opacity: unset;">
                      </div>
                      @endif
                    </div>

                 

                    
                  </div>
                  @endforeach
                </div>
               </div>
            </div>
            <!-- End contact us form -->
@push('script')
<script>
                    
$(document).ready(function(){
  $(window).scroll(function(){
    var page = $("#nav-tabContent .active .articles-list").data('page');
    var cat = $("#nav-tabContent .active .articles-list").data('cat');
    console.log(cat,page);
    var position = $(window).scrollTop();
    var bottom = $(document).height() - $(window).height();
    if( position == bottom ){
                        
      $.ajax({
          url: '{{ url("posts/load/more") }}',
          type: 'get',
          data: {page:page,cat:cat},
          success: function(response){
            $("#nav-tabContent .active .articles-list").append(response);
            page = page+1;
            $('#nav-tabContent .active .articles-list').data('page', page);
          }
      });
  }
            
  });
              
});
</script>
@endpush



@endsection		

