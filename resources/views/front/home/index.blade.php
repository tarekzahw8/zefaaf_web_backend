@extends('front.layouts.app')
@section('content')

            <!-- Start Latest subscribers -->
            <div class="latest-subscribers p-5 min-height-footer">
              <div class="container">
                <h3 class="main-title mb-4">
				@if(Session::has('token'))
					المتواجدون في بلدك
				@else	
				أحدث المشتركين
				@endif
				<a href="{{ url('/members/search') }}">المزيد<i class="fas fa-arrow-left pl-2"></i></a>
				</h3>
                <div class="row subscribers-list">
                  @foreach($list['latestUsers'] as $key=>$item) 
                        @php 
                          $status_color = $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") 
                        @endphp
                  <div class="col-md-6  wow fadeInDown" data-wow-offset="170">
                    <div class="media">
                      <div class="item-img">
                      @if($item['gender'] == 1)
                            <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="item">
                            @else
                            <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="item">
                            @endif
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
                            
                      </div>

                      <div class="media-body">
                            <h5 class="mt-1"> {{ $item['userName'] }} </h5>
                            <p><i class="fas fa-map-marker-alt"></i>{{ $item['cityName'] }}/ {{ $item['nationalityCountryName'] }}</p>
                            {{-- <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) && $item['mariageStatues']==3 ? "أرمل" : (isset($item['mariageStatues']) && $item['mariageStatues']==2 ?"مطلق" : (isset($item['mariageStatues']) && $item['mariageStatues']==1 ?"متزوج" : "أعزب") ) }}
                            </p> --}}
                            @php
                              $key = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;
                            @endphp
                            <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) ? $allFixedData[$key]['title'] : '' }}
                            </p>
                            <a href="{{ url('members/details/') }}/{{ $item['id'] }}" class="btn btn-primary btn-sm">التفاصيل</a>
                          </div>
                    </div>
                  </div>
                  @endforeach

                  


                </div>
              </div>
            </div>
            <!-- End Latest subscribers -->

            <!-- Start sucsses stories -->
            <div class="sucsses-stories p-5">
              <div class="container">
                <h3 class="main-title mb-4">قصص نجاح<a href="{{ url('/sucsses/stories') }}">المزيد<i class="fas fa-arrow-left pl-2"></i></a></h3>

                <div class="row  stories-item">
                  @foreach($list['successStories'] as $key=>$item)  
                  <div class="col-md-6  wow fadeInDown" data-wow-offset="250">
                    <div class="story-block">
                      <div class="media">
                        <img class="mr-5" src="{{url('/')}}/front/new_imgs/success_story.png" alt="item">
                          
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

                      <span class="date">{{ FormateDate($item['storyDate']) }} {{ arabictime($item['storyDate'],Session::get('timeZone')) }}</span>
                      <p>
                        {{ $item['story'] }}
                      </p>
                    </div>
                  </div>
                  @endforeach


                </div>
              </div>
            </div>
            <!-- End sucsses stories -->
           
           
@endsection		