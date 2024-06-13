<select name="cityId" {{ isset($show)?$show:"" }} class="form-control m-input">
    <option value=""> اختر المدينة </option>
    @if(isset($cities))
        @foreach($cities as $key=>$value)
            <option value="{{ $value['id'] }}" {{ (isset($row) && $row['cityId'] == $value['id'])? "selected" : "" }} > {{ $value['nameAr'] }} </option>
        @endforeach 
    @endif 
</select>