@if($collection)

@foreach ($collection as $item)
                                <tr>
                                    <th scope="row">{{ request()->userName?request()->userName:$item['userId'] }}</th>
                                    <th scope="row">{{ $item['userName'] }}</th>
                                    <th scope="row">{{ $item['listDateTime'] }}</th>
                                    
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="6" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif