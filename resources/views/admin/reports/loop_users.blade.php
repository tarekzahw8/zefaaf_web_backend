@if($collection)

@foreach ($collection as $item)
                                <tr>
                                    <th scope="row">{{ $item['userName']? $item['userName'] : "" }}</th>
                                    <th scope="row">{{ $item['gender']==1? "أنثى" : "ذكر" }}</th>
                                    <th scope="row">{{ $item['age'] }}</th>
                                    <th scope="row">{{ $item['packageId']==0? "مجانى" : "مدفوع" }}</th>
                                    <th scope="row">{{ $item['nationalityCountryName'] }}</th>
                                    <th scope="row">{{ $item['cityName'] }}</th>
                                    <th scope="row">{{ $item['lastAccess'] }}</th>
                                    
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="6" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif