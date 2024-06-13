@if($collection)

@foreach ($collection as $item)

@php
    $userId1 = isset($item['userId'])? $item['userId']: ""; 
    $userName1 = isset($item['name'])?$item['name']:$item['name']; 
    $url1 = url('/admin/users')."/".$item['userId'];
	$url11 = url('/admin/users')."?q=$userName1";

    
@endphp

                                <tr>
                                    <td>{{ $item['name'] }} </td>
                                    <td>{{ $item['nameAr'] }}</td>
                                    <td>
                                        @if ($item['mobileType'] == 1)
                                            اندرويد 
                                        @elseif($item['mobileType'] == 2)
                                            ايفون
                                        @else
                                            غير معروف
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['payMethod'] == 1)
                                            Android 
                                        @elseif($item['payMethod'] == 2)
                                            Paypal
                                        @else
                                            Apple
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item['purchaseDayTime'])->addHours(3) }}</td>
                                    {{-- <td>{{ $item['title'] }}</td>
                                    <td>{{ $item['mobile'] }}</td>
									<td>{{ $item['gender'] == 1 ? "أنثى" : "ذكر" }}</td> --}}
                                    
                                    @if(Session::get('admin')['type'] ==1 || array_search(10, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                    <td><a href="{{ $url11 }}"> 
                                        <button class="btn btn-primary"> تفاصيل العضو </button>
                                        </a>
                                    </td>
                                    @endif
                                    {{-- <td>{{ $item[''] }}</td> --}}
                                    {{-- <td>{{ $item[''] }}</td> --}}
                                    
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="6" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif