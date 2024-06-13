
@if ($type=="notification")
    <select name="userId" {{ isset($show)?$show:"" }} class="form-control m-input">
        <option value="-1">إرسال للكل</option>
        @foreach ($users as $key=>$item)
            <option value="{{ $item['id'] }}" > {{ $item['userName'] }} </option>
        @endforeach
    </select>
@elseif($type=="wife")
<select name="wifId" {{ isset($show)?$show:"" }} class="form-control m-input">
    <option value="">اختر الزوجة</option>
    @foreach ($users as $key=>$item)
        <option value="{{ $item['id'] }}" > {{ $item['userName'] }}</option> 
    @endforeach
    
</select>
@elseif($type=="husband")
    <select name="husId" {{ isset($show)?$show:"" }} class="form-control m-input">
        <option value="">اختر الزوج</option>
        @foreach ($users as $key=>$item)
            <option value="{{ $item['id'] }}" > {{ $item['userName'] }}</option> 
        @endforeach
        
    </select>
@endif
