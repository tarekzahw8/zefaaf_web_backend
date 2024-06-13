<select class="form-control" name="cityId">
    <option>المدينة </option>
    @foreach($cities as $key=>$value)
    <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
    @endforeach 
</select>