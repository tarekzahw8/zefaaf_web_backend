@if($collection)

@foreach ($collection as $item)
                                <tr>
                                    <th scope="row">{{ $item['name'] }}</th>
                                    <th scope="row">{{ $item['mobile'] }}</th>
                                    <th scope="row">{{ $item['gender']==1? "أنثى" : "ذكر" }}</th>
                                    <th scope="row">{{ $item['title'] }}</th>
                                    <th scope="row">{{ $item['nameAr'] }}</th>
                                    <th scope="row">{{ $item['purchaseDateTime'] }}</th>
                                    <th scope="row">{{ $item['paymentValue'] }}</th>
                                    <th scope="row">{{ $item['paymentRefrence'] }}</th>
                                    
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="6" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif