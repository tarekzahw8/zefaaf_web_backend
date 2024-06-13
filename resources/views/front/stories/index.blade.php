@extends('front.layouts.app')
@section('content')


 <!-- Start sucsses stories -->
 <div class="sucsses-stories stories-list p-5 min-height-footer">
              <div class="container">
                <h3 class="sub-title">قصص نجاح</h3>

                <div class="row  stories-item" data-page="1">
                  @foreach($stories as $key=>$item)  
                  <div class="col-md-6">
                    <div class="story-block">
                      <div class="media">
                        {{-- <a href="{{ url('/sucsses/stories/details/') }}/{{ isset($item['id'])?$item['id']:1 }}"> --}}
                          <img class="mr-5" src="{{url('/')}}/front/new_imgs/success_story.png" alt="item">
                        {{-- </a> --}}
                        <div class="media-body">
                          <div class="d-flex">
                            <img src="{{url('/')}}/front/imgs/man2.png" alt="mr">
                            <p><span>اسم الزوج</span>{{ $item['husName'] }}</p>
                          </div>

                          <div class="d-flex">
                            <img src="{{url('/')}}/front/imgs/woman.png" alt="mr">
                            <p><span>اسم الزوجة</span>{{ $item['wifName'] }}</p>
                          </div>
                        </div>
                      </div>

                      <!-- <h3 class="package-type"><span>مده الاشتراك 9 اشهر</span></h3> -->
                      <span class="date">{{ FormateDate($item['storyDate']) }} {{ arabictime($item['storyDate'],Session::get('timeZone')) }}</span>
                      <p>
                        {{ $item['story'] }}
                      </p>
                      
                    </div>
                  </div>
                  @endforeach

                </div>

                <div class="text-right">
                  <a class="btn btn-primary main-btn" href="{{ url('/sucsses/stories/add') }}">أضف قصتك</a>
                </div>
              </div>
            </div>
            <!-- End sucsses stories -->
           
            @push('script')
            <script>
                    
              $(document).ready(function(){
                  
                  $(window).scroll(function(){
                      var page = $(".stories-item").data('page');
                      console.log(page);
                      var position = $(window).scrollTop();
                      var bottom = $(document).height() - $(window).height();
                      let loader = `<div class="loader"></div>`;
                      //$( ".loader" ).remove();
                      //$(".articles-list").append(loader);
                      if( position == bottom ){
                        
                          $.ajax({
                                  url: '{{ url("sucsses/stories/load/more") }}',
                                  type: 'get',
                                  data: {page:page},
                                  success: function(response){
                                      //$( ".loader" ).remove();
                                      $(".stories-item").append(response);
                                      page = page+1;
                                      $('.stories-item').data('page', page);
                                  }
                              });
                      }
            
                  });
              
              });
              </script>
            @endpush

@endsection		

