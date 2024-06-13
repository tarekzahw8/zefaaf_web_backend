@extends('front.layouts.app')
@section('content')

@php
$contactsNationality = explode(',',$user["contactsNationality"]);
$contactResident = explode(',',$user["contactResident"]);
@endphp


            <!-- Start settings -->
            <div class="settings p-5 min-height-footer">
               <div class="container">
                <form action="{{ url('/settings') }}" method="post">
                   @csrf
                  <h3 class="sub-title">الإعدادات</h3>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="notifications" class="custom-control-input" id="notifications" value="1" {{ $user["receiveNotification"] == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="notifications">الإشعارات</label>
                  </div>

                  <!-- <div class="form-group">
                    <select class="form-control">
                      <option>حجم الخط</option>
                      <option>كبير</option>
                      <option>صغير</option>
                    </select>
                  </div> -->
  
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="nightMood">
                    <label class="custom-control-label" for="nightMood">الوضع الليلي</label>
                  </div> -->

                  <div class="allow-them mt-4">
                    <h5>المسموح لهم بمراسلتي</h5>
                    <div class="form-group">
                      <label for="customRange1">الجنسية </label>
                      <select class="form-control js-example-basic-multiple-default" name="nationalities[]" multiple="multiple">
                            @foreach($countries as $key=>$value)
                                <option value="{{ $value['id'] }}" {{ (in_array( $value['id'], $contactsNationality))? 'selected' : '' }}> {{ $value['nameAr'] }} </option>
                            @endforeach
                        
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="customRange1">دولة الاقامة</label>
                      <select class="form-control js-example-basic-multiple-default" name="residents[]" multiple="multiple">
                            @foreach($countries as $key=>$value)
                                <option value="{{ $value['id'] }}" {{ (in_array( $value['id'], $contactResident))? 'selected' : '' }}> {{ $value['nameAr'] }} </option>
                            @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="customRange1">العمر</label>
                      <div class="groups">
                      <select class="form-control" name="agesFrom" >
                        <option value="">  من </option>
                        @for ($i = 18; $i < 66; $i++)
                        @php
                          $x=  ($i==120)? $i: $i+10;
                        @endphp
                            <option value="{{ $i }}" 
                            {{ isset($user) && $user['contactAgesFrom']==$i ? "selected" : "" }}
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
                            {{ isset($user) && $user['contactAgesTo']==$i ? "selected" : "" }}
                            > {{ $i }} </option>
                        @endfor
                        
                      </select>
                      {{-- <div id="slider"></div>  
                      <input type="hidden" name="agesFrom" id="agesFrom" value="{{ $user['contactAgesFrom'] }}" />                
                      <input type="hidden" name="agesTo" id="agesTo" value="{{ $user['contactAgesTo'] }}" />                 --}}
                      </div>
                    </div>
                  </div>

                  <button class="btn btn-primary main-btn" type="submit">حفظ</button>
                </form>
               </div>
            </div>
            <!-- End settings -->

@endsection		

@push('script')
<script>
$(document).ready(function () {
    var slider = document.getElementById('slider');
    var agesFrom = "{{ $user['contactAgesFrom']?$user['contactAgesFrom']:18 }}";
    var agesTo = "{{ $user['contactAgesTo']?$user['contactAgesTo']:65 }}";

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
    slider.noUiSlider.on('slide', function(values, handle) {
        $("#agesFrom").val(values[0]);
        $("#agesTo").val(values[1]);
    });
    
});
</script>
@endpush