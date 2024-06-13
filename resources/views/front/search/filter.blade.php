@extends('front.layouts.app')
@section('content')
@php
    $nationalityCountryId = isset($collection) && !empty($collection['nationalityCountryId'])? explode(',', $collection['nationalityCountryId']) : null;

    $residentCountryId = isset($collection) && !empty($collection['residentCountryId'])? explode(',', $collection['residentCountryId']) : null;
    
    $mariageStatues = isset($collection) && !empty($collection['mariageStatues'])? explode(',', $collection['mariageStatues']) : null;
    
    $mariageKind = isset($collection) && !empty($collection['mariageKind'])? explode(',', $collection['mariageKind']) : null;
    
    $prayer = isset($collection) && !empty($collection['prayer'])? explode(',', $collection['prayer']) : null;
    
    $smoking = isset($collection) && !empty($collection['smoking'])? explode(',', $collection['smoking']) : null;

    $financial = isset($collection) && !empty($collection['financial'])? explode(',', $collection['financial']) : null;
    
    $education = isset($collection) && !empty($collection['education'])? explode(',', $collection['education']) : null;
    
    $workField = isset($collection) && !empty($collection['workField'])? explode(',', $collection['workField']) : null;
    
    $skinColor = isset($collection) && !empty($collection['skinColor'])? explode(',', $collection['skinColor']) : null;

    $income = isset($collection) && !empty($collection['income'])? explode(',', $collection['income']) : null;

    $helath = isset($collection) && !empty($collection['helath'])? explode(',', $collection['helath']) : null;

    $veil = isset($collection) && !empty($collection['veil'])? explode(',', $collection['veil']) : null;
@endphp
 <!-- Start search form -->
 <div class="search-form main-form p-5 min-height-footer">
 
    <div class="container">
        <form  method="post" action="{{ url('/automated-search/filter/store') }}">
                @csrf
                  <h3 class="sub-title">البحث الالى</h3>
                 
                  <div class="form-group">
                    <label> الجنسية </label>
                    <select class="form-control js-example-basic-multiple"
                    data-placeholder="الجنسية"  name="nationalityCountryId[]" multiple>
                            @foreach($countries as $key=>$item)
                                <option value="{{ $item['id'] }}"
                                {{ isset($collection) && isset($nationalityCountryId) && in_array($item['id'], $nationalityCountryId) ? "selected" : "" }}
                                > {{ $item['nameAr'] }} </option>
                            @endforeach
                    </select>
                  </div>
  
                  <div class="form-group">
                    <label> مكان الإقامة </label>
                    <select class="form-control js-example-basic-multiple"
                    data-placeholder="مكان الإقامة" name="residentCountryId[]" id="residentCountryId" multiple>
                                @foreach($countries as $key=>$item)
                                <option value="{{ $item['id'] }}"
                                {{ isset($collection) && isset($residentCountryId) && in_array($item['id'], $residentCountryId)? "selected" : "" }}
                                > {{ $item['nameAr'] }} </option>
                                @endforeach
                    </select>
                  </div>

                  {{-- <div class="form-group">
                    <span id="load_cities">
                      <select class="form-control" name="cityId">
                          <option value="">المدينة</option>
                      </select>
                    </span>
                  </div> --}}
  
                    <div class="form-group">
                        <label> الحالة الإجتماعية </label>
                        <select class="form-control js-example-basic-multiple" name="mariageStatues[]" multiple id="marriageStatus">
                            {{-- <option value="-1"> الكل </option> --}}
                            @foreach ($fixedData['marriageStatus'] as $key=>$item)
                              @if(Session::get('user')['gender'] != $item['gender'] )
                                <option value="{{ $item['id'] }}"
                                {{ isset($collection) && isset($mariageStatues) && in_array($item['id'], $mariageStatues) ? "selected" : "" }}
                                >{{ $item['title'] }}</option>    
                              @endif
                            @endforeach
                            
                        </select>
                    </div>
                    {{-- <span id="check-marriageStatus" style="display: none"> --}}
                        <div class="form-group">
                          <label> نوع الزواج </label>
                          <select class="form-control js-example-basic-multiple" name="mariageKind[]" multiple>
                            {{-- <option value="-1"> الكل </option> --}}
                            
                            @foreach ($fixedData['mariageKind'] as $key=>$item)
                             
                                <option value="{{ $item['id'] }}"
                                {{ isset($collection) && isset($mariageKind) && in_array($item['id'], $mariageKind) ? "selected" : "" }}
                                >{{ $item['title'] }}</option>    
                            @endforeach
                            {{-- <option value="0">أعزب</option>
                            <option value="1">متزوج</option>
                            <option value="2">مطلق</option>
                            <option value="3">أرمل</option> --}}
                          </select>
                        </div>

                    {{-- </span> --}}

                    <div class="form-group">
                        <label> الصلاة </label>
                        <select class="form-control js-example-basic-multiple" name="prayer[]" multiple>
                          {{-- <option value="-1"> الكل </option> --}}
                          @foreach ($fixedData['prayStatus'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($prayer) && in_array($item['id'], $prayer) ? "selected" : "" }}
                            >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label> التدخين </label>
                        <select class="form-control js-example-basic-multiple" name="smoking[]" multiple>
                          {{-- <option value="-1"> الكل </option> --}}
                          <option value="1" {{ isset($collection) && in_array(1, $smoking) ? "selected" : "" }} >نعم</option>
                          <option value="0" {{ isset($collection) && in_array(0, $smoking) ? "selected" : "" }} >لا</option>
                          
                        </select>
                    </div>

                    <div class="form-group">
                        <label> الوضع المادي </label>
                        <select class="form-control js-example-basic-multiple"
                        data-placeholder="الوضع المادي" name="financial[]" multiple >
                            @foreach ($fixedData['moneyStatus'] as $key=>$item)
                              <option value="{{ $item['id'] }}"
                              {{ isset($collection) && isset($financial) && in_array($item['id'], $financial)? "selected" : "" }}
                              >{{ $item['title'] }}</option>    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label> المؤهل التعليمي </label>
                        <select class="form-control js-example-basic-multiple"
                        data-placeholder="المؤهل التعليمي" multiple name="education[]">
                          @foreach ($fixedData['study'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($education) && in_array($item['id'], $education)? "selected" : "" }}
                             >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label> مجال العمل </label>
                        <select class="form-control js-example-basic-multiple"
                        data-placeholder="مجال العمل" multiple name="workField[]">
                          @foreach ($fixedData['job'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($workField) && in_array($item['id'], $workField)? "selected" : "" }}
                            >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label> لون البشرة </label>
                        <select class="form-control js-example-basic-multiple" 
                        data-placeholder="لون البشرة"
                        multiple name="skinColor[]">
                          @foreach ($fixedData['color'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($skinColor) && in_array($item['id'], $skinColor)? "selected" : "" }}
                             >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label> مستوى الدخل الشهري </label>
                        <select class="form-control js-example-basic-multiple"
                        data-placeholder="مستوى الدخل الشهري" multiple name="income[]">
                          @foreach ($fixedData['financeStatus'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($income) && in_array($item['id'], $income)? "selected" : "" }}
                            >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label> الحالة الصحية </label>
                        <select class="form-control js-example-basic-multiple" data-placeholder="الحالة الصحية" multiple name="helath[]">
                          @foreach ($fixedData['medicalStatus'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($helath) && in_array($item['id'], $helath)? "selected" : "" }}
                            >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>
                    @if(Session::get('user')['gender'] !=1)
                    <div class="form-group">
                      <label> الحجاب </label>
                        <select class="form-control js-example-basic-multiple" data-placeholder="الحجاب" multiple name="veil[]">
                          @foreach ($fixedData['veil'] as $key=>$item)
                            <option value="{{ $item['id'] }}"
                            {{ isset($collection) && isset($veil) && in_array($item['id'], $veil)? "selected" : "" }}
                            >{{ $item['title'] }}</option>    
                          @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="form-group groups">
                        <label for="customRange1">العمر</label>
                        <div class="groups">
                        <select class="form-control" name="agesFrom" >
                          <option value="">  من </option>
                          @for ($i = 18; $i < 66; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}" 
                              {{ isset($collection) && $collection['ageFrom']==$i ? "selected" : "" }}
                              > {{ $i }} </option>
                          @endfor
                          
                        </select>

                        <select class="form-control" name="agesTo" >
                          <option value="">  الى </option>
                          @for ($i = 18; $i < 66; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}" 
                              {{ isset($collection) && $collection['ageTo']==$i ? "selected" : "" }}
                              > {{ $i }} </option>
                          @endfor
                          
                        </select>
                        {{-- <div id="slider"></div>   
                        <input type="hidden" name="agesFrom" id="agesFrom" 
                        value="{{ isset($collection)? $collection['ageFrom'] : "" }}" />                
                        <input type="hidden" name="agesTo" id="agesTo" value="{{ isset($collection)? $collection['ageTo'] : "" }}" />                     --}}
                      </div>
                    </div>
                    <div class="form-group groups">
                        <label for="customRange2">الوزن</label>
                        <div class="groups">
                        <select class="form-control" name="weightFrom" >
                          <option value="">  من </option>
                          @for ($i = 40; $i < 201; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}" 
                              {{ isset($collection) && $collection['weightFrom']==$i ? "selected" : "" }}
                              > {{ $i }} </option>
                          @endfor
                          
                        </select>

                        <select class="form-control" name="weightTo" >
                          <option value="">  الى </option>
                          @for ($i = 40; $i < 201; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}" 
                              {{ isset($collection) && $collection['weightTo']==$i ? "selected" : "" }}
                              > {{ $i }} </option>
                          @endfor
                          
                        </select>
                        {{-- <div id="slider2"></div>   
                        <input type="hidden" name="weightFrom" id="weightFrom" 
                        value="{{ isset($collection)? $collection['weightFrom'] : "" }}" />                
                        <input type="hidden" name="weightTo" id="weightTo" value="{{ isset($collection)? $collection['weightTo'] : "" }}" />                     --}}
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="customRange3">الطول</label>
                        <div class="groups">
                        <select class="form-control" name="heightFrom" >
                          <option value="">  من </option>
                          @for ($i = 130; $i < 231; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}" 
                              {{ isset($collection) && $collection['heightFrom']==$i ? "selected" : "" }}
                              > {{ $i }} </option>
                          @endfor
                          
                        </select>

                        <select class="form-control" name="heightTo" >
                          <option value="">  الى </option>
                          @for ($i = 130; $i < 231; $i++)
                          @php
                            $x=  ($i==120)? $i: $i+10;
                          @endphp
                              <option value="{{ $i }}" 
                              {{ isset($collection) && $collection['heightTo']==$i ? "selected" : "" }}
                              > {{ $i }} </option>
                          @endfor
                          
                        </select>
                        {{-- <div id="slider3"></div>   
                        <input type="hidden" name="heightFrom" id="heightFrom" 
                        value="{{ isset($collection)? $collection['heightFrom'] : "" }}" />                
                        <input type="hidden" name="heightTo" id="heightTo" value="{{ isset($collection)? $collection['heightTo'] : "" }}" />                     --}}
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

                  {{-- <div class="form-group">
                    <select class="form-control" name="weightFrom">
                      <option value=""> الوزن من </option>
                      @for ($i = 40; $i < 130; $i+=10)
                      @php
                        $x=  ($i==120)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}" 
                          {{ isset($collection) && $collection['weightFrom']==$i ? "selected" : "" }}
                          > {{ ($i==120)? $i.">".$x: $i."-".$x }} </option>
                      @endfor
                      
                    </select>
                                     
                  </div>
                  
                  <div class="form-group">
                    <select class="form-control" name="weightTo">
                      <option value=""> الوزن الى </option>
                      @for ($i = 40; $i < 130; $i+=10)
                      @php
                        $x=  ($i==120)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}" 
                          {{ isset($collection) && $collection['weightTo']==$i ? "selected" : "" }}
                          > {{ ($i==120)? $i.">".$x: $i."-".$x }} </option>
                      @endfor
                      
                    </select>
                                     
                  </div>
                  
                  <div class="form-group">
                    <select class="form-control" name="heightFrom">
                      <option value=""> الطول من </option>
                      @for ($i = 140; $i < 210; $i+=10)
                      @php
                        $x=  ($i==200)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}" {{ isset($collection) && $collection['heightFrom']==$i ? "selected" : "" }} > {{ ($i==200)? ">".$x: $i."-".$x }} </option>
                      @endfor
                    </select>                  
                  </div>
                  
                  <div class="form-group">
                    <select class="form-control" name="heightTo">
                      <option value=""> الطول الى </option>
                      @for ($i = 140; $i < 210; $i+=10)
                      @php
                        $x=  ($i==200)? $i: $i+10;
                      @endphp
                          <option value="{{ $i }}" {{ isset($collection) && $collection['heightTo']==$i ? "selected" : "" }} > {{ ($i==200)? ">".$x: $i."-".$x }} </option>
                      @endfor
                    </select>                  
                  </div> --}}

               

                  <button type="submit" class="btn btn-primary main-btn">بحث</button>
        </form>
    </div>
</div>
            <!-- End search form  -->


@endsection		

@push('script')
<script>
$(document).ready(function () {
    var slider  = document.getElementById('slider');
    var slider2 = document.getElementById('slider2');
    var slider3 = document.getElementById('slider3');

    var agesFrom = "{{ isset($collection) && $collection['ageFrom']?$collection['ageFrom']:18 }}";
    var agesTo = "{{ isset($collection) && $collection['ageTo']?$collection['ageTo']:65 }}";
    
    var weightFrom = "{{ isset($collection) && $collection['weightFrom']?$collection['weightFrom']:40 }}";
    var weightTo = "{{ isset($collection) && $collection['weightTo']?$collection['weightTo']:200 }}";
    
    var heightFrom = "{{ isset($collection) && $collection['heightFrom']?$collection['heightFrom']:130 }}";
    var heightTo = "{{ isset($collection) && $collection['heightTo']?$collection['heightTo']:230 }}";

    noUiSlider.create(slider, {
        start: [agesFrom, agesTo],
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

    noUiSlider.create(slider2, {
        start: [weightFrom, weightTo],
        connect: true,
        range: {
            'min': 40,
            'max': 200
        },
        tooltips: true,
        format: wNumb({
            decimals: 0
        })
    });

    noUiSlider.create(slider3, {
        start: [heightFrom, heightTo],
        connect: true,
        range: {
            'min': 130,
            'max': 230
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

    slider2.noUiSlider.on('slide', function(values, handle) {
        $("#weightFrom").val(values[0]);
        $("#weightTo").val(values[1]);
    });
    
    slider3.noUiSlider.on('slide', function(values, handle) {
        $("#heightFrom").val(values[0]);
        $("#heightTo").val(values[1]);
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