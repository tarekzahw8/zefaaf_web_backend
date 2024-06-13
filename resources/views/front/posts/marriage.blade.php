@extends('front.layouts.app')
@section('content')

 <!-- Start contact us form -->
 <div class="p-5 min-height-footer">
               <div class="container">
                
                  <!-- two tabs -->
                <ul class="nav nav-tabs members-tabs mb-3" id="membersTab" role="tablist">
                  
                  <li class="nav-item">
                    <a class="nav-link active" id="article0-tab" data-toggle="tab" href="#article0" 
                    role="tab" aria-controls="article0" aria-selected="true">الزواج في ضوء السنه</a>
                  </li>
                  
                </ul>

                <div class="tab-content" id="nav-tabContent">

                  <div class="tab-pane fade show active"  id="article0" role="tabpanel" aria-labelledby="article0-tab">
                    <div class="articles-list" data-page="1">
                      @foreach($posts as $key=>$item)
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

                    </div>

                  </div>
                </div>
               </div>
            </div>
            <!-- End contact us form -->
@push('script')
<script>
        
  $(document).ready(function(){
      
      $(window).scroll(function(){
          var page = $(".articles-list").data('page');
          console.log(page);
          var position = $(window).scrollTop();
          var bottom = $(document).height() - $(window).height();
          let loader = `<div class="loader"></div>`;
          //$( ".loader" ).remove();
          //$(".articles-list").append(loader);
          if( position == bottom ){
            
              $.ajax({
                      url: '{{ url("posts/load/more") }}',
                      type: 'get',
                      data: {page:page,cat:1},
                      success: function(response){
                          //$( ".loader" ).remove();
                          $(".articles-list").append(response);
                          page = page+1;
                          $('.articles-list').data('page', page);
                      }
                  });
          }

      });
  
  });
  </script>
@endpush

@endsection		

