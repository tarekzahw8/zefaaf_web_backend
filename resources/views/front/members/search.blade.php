@extends('front.layouts.app')
@section('content')

 <!-- Start search form -->
 <div class="search-form main-form p-5 min-height-footer">
 
    <div class="container">
               <form  method="post" action="{{ url('/members/search') }}">
                @csrf
                  <h3 class="sub-title">بحث</h3>
                 
                  <div class="form-group">
                  <select class="form-control" name="nationalityCountryId">
                    <option value="">الجنسية</option>
                            @foreach($countries as $key=>$value)
                              <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                            @endforeach
                  </select>
                  </div>
  
                  <div class="form-group">
                    <select class="form-control" name="residentCountryId" id="residentCountryId">
                        <option value="">مكان الإقامة</option>
                                @foreach($countries as $key=>$value)
                                <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                                @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <span id="load_cities">
                      <select class="form-control" name="cityId">
                          <option value="">المدينة</option>
                      </select>
                    </span>
                  </div>
  
                  <div class="form-group">
                    <select class="form-control" name="mariageStatues">
                        <option value="">الحالة الإجتماعية</option>
                        @foreach ($fixedData['marriageStatus'] as $key=>$item)
                          @if(Session::get('user')['gender'] != $item['gender'] )
                            <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>    
                          @endif
                        @endforeach
                        
                    </select>
                  </div>
				  
				  <div class="form-group">
                          <label> نوع الزواج </label>
                          <select class="form-control" name="mariageKind">
                             <option value=""> نوع الزواج</option>
                            @foreach ($fixedData['mariageKind'] as $key=>$item)
                             
                                <option value="{{ $item['id'] }}"
                                {{ isset($collection) && isset($mariageKind) && in_array($item['id'], $mariageKind) ? "selected" : "" }}
                                >{{ $item['title'] }}</option>    
                            @endforeach
                           
                          </select>
                        </div>
                  @if(Session::get('user')['gender'] !=1)
                  <div class="form-group">
                    <label> الحجاب </label>
                      <select class="form-control"  name="veil">
                        <option value="">الحجاب</option>
                        @foreach ($fixedData['veil'] as $key=>$item)
                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>    
                        @endforeach
                      </select>
                  </div>
                  @endif

                  <div class="form-group">
                    <label for="customRange1">العمر</label>
                    <div class="groups">
                    <select class="form-control" name="agesFrom">
                      <option value="">  من </option>
                      @for ($i = 18; $i < 66; $i++)
                      @php
                        $x=  ($i==120)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}"  > {{ $i }} </option>
                      @endfor
                      
                    </select>

                    <select class="form-control" name="agesTo" >
                      <option value="">  الى </option>
                      @for ($i = 18; $i < 66; $i++)
                      @php
                        $x=  ($i==120)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}"  > {{ $i }} </option>
                      @endfor
                      
                    </select>
                    {{-- <div id="slider"></div>   
                    <input type="hidden" name="agesFrom" id="agesFrom" value="" />                
                    <input type="hidden" name="agesTo" id="agesTo" value="" />                     --}}
                    </div>
                  </div>
<!-- 
                  <div class="form-group">
                    <select class="form-control">
                      <option>نوع الزواج</option>
                      <option>مطلق</option>
                      <option>متزوج</option>
                    </select>
                  </div> -->

                  <div class="form-group">
                    <label for="customRange2">الوزن</label>
                      <div class="groups">
                        <select class="form-control" name="weight" >
                          <option value="">  من </option>
                          @for ($i = 40; $i < 201; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}"> {{ $i }} </option>
                          @endfor
                          
                        </select>

                        <select class="form-control" >
                          <option value="">  الى </option>
                          @for ($i = 40; $i < 201; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}"> {{ $i }} </option>
                          @endfor
                          
                        </select>
                    {{-- <select class="form-control" name="weight">
                      <option value=""> الوزن </option>
                      @for ($i = 40; $i < 130; $i+=10)
                      @php
                        $x=  ($i==120)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}" > {{ ($i==120)? $i.">".$x: $i."-".$x }} </option>
                      @endfor
                      
                    </select> --}}
                                     
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="customRange3">الطول</label>
                      <div class="groups">
                        <select class="form-control" name="height" >
                          <option value="">  من </option>
                          @for ($i = 130; $i < 231; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}"> {{ $i }} </option>
                          @endfor
                          
                        </select>

                        <select class="form-control" >
                          <option value="">  الى </option>
                          @for ($i = 130; $i < 231; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}"> {{ $i }} </option>
                          @endfor
                          
                        </select>
                      </div>
                    {{-- <select class="form-control" name="height">
                      <option value=""> الطول </option>
                      @for ($i = 140; $i < 210; $i+=10)
                      @php
                        $x=  ($i==200)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}" > {{ ($i==200)? ">".$x: $i."-".$x }} </option>
                      @endfor
                    </select>                   --}}
                  </div>

                  {{-- <div class="row">
                    <div class="col-sm-6 form-group">
                      <input type="number" name="weight" class="form-control" placeholder="الوزن">
                    </div>
                    <div class="col-sm-6 form-group">
                      <input type="number" name="height" class="form-control" placeholder="الطول">
                    </div>
                  </div> --}}

                  <div class="form-group">
                  <select class="form-control" name="education">
                                        <option value="">المؤهل التعليمي</option>
                                        @foreach ($fixedData['study'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>    
                                        @endforeach
                                      </select>
                  </div>
                  <div class="form-group">
                            <select class="form-control" name="financial">
                                      <option value="">الوضع المادي</option>
                                        @foreach ($fixedData['moneyStatus'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>    
                                        @endforeach
                                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary main-btn">بحث</button>
                  </from>
                </div>
            </div>
            <!-- End search form  -->


@endsection		

@push('script')
<script>
$(document).ready(function () {
    var slider = document.getElementById('slider');
    var slider2 = document.getElementById('slider2');
    var slider3 = document.getElementById('slider3');

    noUiSlider.create(slider, {
        start: [18, 65],
        connect: true,
        range: {
            'min': 18,
            'max': 65
        },
        tooltips: true,
        format: wNumb({
            decimals: 0
        })
    });
    
    slider.noUiSlider.on('slide', function(values, handle) {
        $("#agesFrom").val(values[0]);
        $("#agesTo").val(values[1]);
    });
    
    
});

$("#residentCountryId").change(function(){
  let country_id = this.value;
  $.get( "{{url('country/load/cities')}}", { country_id: country_id } )
    .done(function( data ) {
      $("#load_cities").html(data);
  });
});
</script>
@endpush