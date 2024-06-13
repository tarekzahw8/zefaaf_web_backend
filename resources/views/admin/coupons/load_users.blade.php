
<select name="userId" class="form-control m-input">
    @foreach ($users as $key=>$item)
        <option value="{{ $item['id'] }}" > {{ $item['userName'] }} </option>
    @endforeach
</select>

