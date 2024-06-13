@if($collection)

@foreach ($collection as $item)

@php
    $userId1 = isset($item['userId'])? $item['userId']: ""; 
    $userName1 = isset($item['name'])?$item['name']:$item['name']; 
    $url1 = url('/admin/users')."/".$item['userId'];
	$url11 = url('/admin/users')."?q=$userName1";

    
@endphp

                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item['purchaseDateTime'])->addHours(3) }}</td>
                                    <td>{{ $item['title'] }} </td>
                                    <td>{{ $item['paymentValue'] }}</td>
									<td>
									@if($item['paymentRefrence'] == "Agent")
										<a href="{{url('/admin/agents')}}/{{ $item['agentId'] }}"> {{ $item['paymentRefrence'] }} </a>
									@else
										{{ $item['paymentRefrence'] }}
									@endif											
									</td>
                                    <td>
                                            {{ $item['name'] }} 
                                    </td>
                                    <td>{{ $item['nameAr'] }}</td>
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