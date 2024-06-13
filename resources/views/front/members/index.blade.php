@extends('front.layouts.app')
@section('content')


            <!-- Start members list -->
            <div class="latest-subscribers p-5 min-height-footer">
              <div class="container">
                <h3 class="sub-title">قوائم الأعضاء</h3>
 
                <!-- two tabs -->
                <ul class="nav nav-tabs members-tabs mb-3" id="membersTab" role="tablist">
                  
                  <li class="nav-item">
                    <a class="nav-link active" id="interest-tab" data-toggle="tab" href="#interest" 
                    role="tab" aria-controls="interest" aria-selected="true">قائمة الإعجاب </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject"
                     role="tab" aria-controls="reject" aria-selected="false">قائمة التجاهل</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="view-tab" data-toggle="tab" href="#view"
                     role="tab" aria-controls="view" aria-selected="false">قائمة مشاهدة الصورة</a>
                  </li>
				  
				  <li class="nav-item">
                    <a class="nav-link" id="view-tab" data-toggle="tab" href="#mobile"
                     role="tab" aria-controls="view" aria-selected="false">مشاهدة رقم موبايلي</a>
                  </li>
				  
                </ul>

                <div class="tab-content" id="nav-tabContent">
                  

                  <div class="tab-pane fade show active"  id="interest" role="tabpanel" aria-labelledby="interest-tab">
                    <div class="row subscribers-list" data-page="1" data-cat="1">
                      @if($fav)
                    @foreach($fav as $key=>$item) 
					
                        @php 
                          $status_color = isset($item['available']) && $item['available']==1?"green":(isset($item['available']) && $item['available']==2 ?"#FF4E4E" : "gray") 
                        @endphp
                      <div class="col-md-6">
                        <div class="media">
                          <div class="item-img">
                            @if($item['gender'] == 1)
                            <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="item">
                            @else
                            <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="item">
                            @endif
                            @if($item['packageId'] > 0)
                            <span class="status-badge" style="background-color:{{ $status_color }};">
                              
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
                            <p><i class="fas fa-map-marker-alt"></i>{{ isset($item['cityName'])?$item['cityName']:'' }}/ {{ isset($item['nationalityCountryName'])?$item['nationalityCountryName']:'' }}</p>
                            @php
                              $key = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;
                            @endphp
                            <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) ? $allFixedData[$key]['title'] : '' }}
                            </p>
                            <a href="{{ url('members/details/') }}/{{ $item['otherId'] }}" class="btn btn-primary btn-sm">التفاصيل</a>
                            <a href="{{ url('members/remove/') }}/{{ $item['otherId'] }}/1" class="btn btn-sm btn-danger remBtn btn-sm" >حذف من القائمة</a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @else
                      <div class="col-md-10">
                        @if(Session::get('user')['gender'] == 1 )
                          <img src="{{url('/')}}/front/new_imgs/Artboard 2.png" style="width: 75%;height: 100%;opacity: unset;">
                        @else
                          <img src="{{url('/')}}/front/new_imgs/Artboard 3.png" style="width: 75%;height: 100%;opacity: unset;">
                        @endif
                      </div>
                      @endif
                    </div>
                  </div>

                  <div class="tab-pane fade show"  id="reject" role="tabpanel" aria-labelledby="reject-tab">
                    <div class="row subscribers-list" data-page="1" data-cat="0">
                    @if ($ignor)
                    @foreach($ignor as $key=>$item) 
                        @php 
                          $status_color = $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") 
                        @endphp
                      <div class="col-md-6">
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
                            <p><i class="fas fa-map-marker-alt"></i>{{ isset($item['cityName'])?$item['cityName']:'' }}/ {{ isset($item['nationalityCountryName'])?$item['nationalityCountryName']:'' }}</p>
                            @php
                              $key = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;
                            @endphp
                            <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) ? $allFixedData[$key]['title'] : '' }}
                            </p>
                            <a href="{{ url('members/details/') }}/{{ $item['otherId'] }}" class="btn btn-primary btn-sm">التفاصيل</a>
                            <a href="{{ url('members/remove/') }}/{{ $item['otherId'] }}/0" class="btn btn-primary btn-sm remove-fav remBtn btn-sm" >حذف من القائمة</a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @else
                      <div class="col-md-10">
                        @if(Session::get('user')['gender'] == 1 )
                          <img src="{{url('/')}}/front/new_imgs/Artboard 2.png" style="width: 75%;height: 100%;opacity: unset;">
                        @else
                          <img src="{{url('/')}}/front/new_imgs/Artboard 3.png" style="width: 75%;height: 100%;opacity: unset;">
                        @endif
                      </div>
                      @endif
                    </div>
                  </div>


                  <div class="tab-pane fade show"  id="view" role="tabpanel" aria-labelledby="view-tab">
                    <div class="row subscribers-list" data-page="1" data-cat="2">
                    @if($list)
                    @foreach($list as $key=>$item) 
                        @php 
                          $status_color = $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") 
                        @endphp
                      <div class="col-md-6">
                        <div class="media">
                          <div class="item-img">
                            @if(isset($item['userImage']) && $item['userImage'] !='')
                              <img src="{{Config::get('app.image_url')}}/{{ $item['userImage'] }}" alt="member img">
                            @else
                              @if($item['gender'] == 1)
                                <img class="mr-3" src="{{url('/')}}/front/imgs/woman.png" alt="item">
                              @else
                                <img class="mr-3" src="{{url('/')}}/front/imgs/man2.png" alt="item">
                              @endif
                            @endif
                            @if($item['packageId'] > 0)
                            <span class="status-badge" style="background-color: {{ $status_color }}">
                              
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
                            <p><i class="fas fa-map-marker-alt"></i>{{ isset($item['cityName'])?$item['cityName']:'' }}/ {{ isset($item['nationalityCountryName'])?$item['nationalityCountryName']:'' }}</p>
                            @php
                              $key = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;
                            @endphp
                            <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) ? $allFixedData[$key]['title'] : '' }}
                            </p>
                            <a href="{{ url('members/details/') }}/{{ $item['otherId'] }}" class="btn btn-primary btn-sm">التفاصيل</a>
                            <a href="{{ url('members/remove/') }}/{{ $item['otherId'] }}/2" class="btn btn-primary btn-sm remove-fav remBtn btn-sm" >حذف من القائمة</a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @else
                      <div class="col-md-10">
                        @if(Session::get('user')['gender'] == 1 )
                          <img src="{{url('/')}}/front/new_imgs/Artboard 2.png" style="width: 75%;height: 100%;opacity: unset;">
                        @else
                          <img src="{{url('/')}}/front/new_imgs/Artboard 3.png" style="width: 75%;height: 100%;opacity: unset;">
                        @endif
                      </div>
                      @endif
                    </div>
                  </div>
				  
				  
				  <div class="tab-pane fade show"  id="mobile" role="tabpanel" aria-labelledby="mobile-tab">
                    <div class="row subscribers-list" data-page="1" data-cat="8">
                    @if ($mobile)
                    @foreach($mobile as $key=>$item) 
				
                        @php 
                          $status_color = $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") 
                        @endphp
                      <div class="col-md-6">
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
                            <p><i class="fas fa-map-marker-alt"></i>{{ isset($item['cityName'])?$item['cityName']:'' }}/ {{ isset($item['nationalityCountryName'])?$item['nationalityCountryName']:'' }}</p>
                            @php
                              $key = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;
                            @endphp
                            <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) ? $allFixedData[$key]['title'] : '' }}
                            </p>
                            <a href="{{ url('members/details/') }}/{{ $item['otherId'] }}" class="btn btn-primary btn-sm">التفاصيل</a>
                            <a href="{{ url('members/remove/') }}/{{ $item['otherId'] }}/0" class="btn btn-primary btn-sm remove-fav remBtn btn-sm" >حذف من القائمة</a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @else
                      <div class="col-md-10">
                        @if(Session::get('user')['gender'] == 1 )
                          <img src="{{url('/')}}/front/new_imgs/Artboard 2.png" style="width: 75%;height: 100%;opacity: unset;">
                        @else
                          <img src="{{url('/')}}/front/new_imgs/Artboard 3.png" style="width: 75%;height: 100%;opacity: unset;">
                        @endif
                      </div>
                      @endif
                    </div>
                  </div>

                </div>

              </div>
            </div>
            <!-- End members list -->



            @push('script')
            <script>
                                
            $(document).ready(function(){
              $(window).scroll(function(){
                var page = $("#nav-tabContent .active .subscribers-list").data('page');
                var cat = $("#nav-tabContent .active .subscribers-list").data('cat');
                console.log(cat,page);
                var position = $(window).scrollTop();
                var bottom = $(document).height() - $(window).height();
                if( position == bottom ){
                                    
                  $.ajax({
                      url: '{{ url("members/load/more") }}',
                      type: 'get',
                      data: {page:page,cat:cat},
                      success: function(response){
                        $("#nav-tabContent .active .subscribers-list").append(response);
                        page = page+1;
                        $('#nav-tabContent .active .subscribers-list').data('page', page);
                      }
                  });
              }
                        
              });
                          
            });
            </script>
            @endpush
            
@endsection		

