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
                            {!! html_entity_decode($item['post']) !!}
                            </p>
                          <a href="{{ url('/') }}/{{ $type }}/details/{{ $item['id'] }}/{{ $item['catId'] }}" class="btn btn-link">التفاصيل</a>
                        </div>
                      </div>
@endforeach