@extends('front.layouts.app')
@section('content')

            <!-- Start members list -->
            <div class="latest-subscribers p-5 min-height-footer">
              <div class="container">
                <h3 class="sub-title">نتائج البحث </h3>
 
                <!-- two tabs -->
                {{-- <ul class="nav nav-tabs members-tabs mb-3" id="membersTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" 
                    role="tab" aria-controls="all" aria-selected="true">كل الأعضاء </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="interest-tab" data-toggle="tab" href="#interest" 
                    role="tab" aria-controls="interest" aria-selected="true">قائمة الإهتمام</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject"
                     role="tab" aria-controls="reject" aria-selected="false">قائمة التجاهل</a>
                  </li>
                </ul> --}}

                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active"  id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row subscribers-list members-search-result" data-page="1">
                       @if($list)
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
                            <p><i class="fas fa-map-marker-alt"></i>{{ $item['cityName'] }}/ {{ $item['nationalityCountryName'] }}</p>
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
                      @else
                      <div class="col-md-10">
                       
                          <img src="{{url('/')}}/front/new_imgs/Artboard 4.png" style="width: 75%;height: 100%;opacity: unset;">
                      </div>
                      @endif

                      

                    </div>
                  </div>
                  @if ($rowsCount >= 40)
                    <div id="loadMore" style="">
                      <a href="#" id="MoreBtn">عرض المزيد</a>
                    </div>
                  @endif
                  
                
                </div>

              </div>
            </div>
            <!-- End members list -->

@push('script')

<script>
  $("#loadMore").on('click', function (e) {
      var page = $(".members-search-result").data('page');
			e.preventDefault();
      $.ajax({
        url: "{{ url()->current().'?'.http_build_query(array_merge(request()->all(),[])) }}",
        type: 'get',
        data: {page:page},
        success: function(response){
            if(response.rowsCount < 40) $("#loadMore").hide();
            $(".members-search-result").append(response.view);
            page = page+1;
            $('.members-search-result').data('page', page);
          }
      });
	});
  
    
</script>

@endpush


@endsection		

