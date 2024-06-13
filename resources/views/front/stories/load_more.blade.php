@foreach($stories as $key=>$item)  
<div class="col-md-6">
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

    <!-- <h3 class="package-type"><span>مده الاشتراك 9 اشهر</span></h3> -->
    <span class="date">{{ FormateDate($item['storyDate']) }} {{ arabictime($item['storyDate'],Session::get('timeZone')) }}</span>
    <p>
      {{ $item['story'] }}
    </p>
    
  </div>
</div>
@endforeach