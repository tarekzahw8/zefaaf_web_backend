@foreach($list as $key=>$item) 
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
                            <p><i class="fas fa-map-marker-alt"></i>{{ $item['cityName'] }}/ {{ $item['nationalityCountryName'] }}</p>
                            @php
                              $key = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;
                            @endphp
                            <p>{{ isset($item['age'])?$item['age']:'' }} سنة/ 
                              {{ isset($item['mariageStatues']) ? $allFixedData[$key]['title'] : '' }}
                            </p>
                            <a href="{{ url('members/details/') }}/{{ $item['id'] }}" class="btn btn-primary btn-sm">التفاصيل  </a>
                          </div>
                        </div>
                      </div>
                      @endforeach

