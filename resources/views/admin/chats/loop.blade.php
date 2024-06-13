@if($collection)

@foreach ($collection as $item)
@php
    $userId1 = isset($item['otherId'])? $item['otherId']: $item['userId1']; 
    $userName1 = isset($item['otherName'])?$item['otherName']:$item['userName1']; 
    $url1 = url('/admin/notifications')."?userId=$userId1&user_name=$userName1";
	$url11 = url('/admin/users')."?q=$userName1";

    $userId2 = isset(request()->userId)? request()->userId: $item['userId2']; 
    $userName2 = isset(request()->userName)?request()->userName:$item['userName2']; 
    $url2 = url('/admin/notifications')."?userId=$userId2&user_name=$userName2";
	$url22 = url('/admin/users')."?q=$userName2";
@endphp
                                <tr>
                                    <th scope="row">
                                    <a href="{{ $url11 }}">
                                        {{ isset($item['otherName'])?$item['otherName']:$item['userName1'] }}
                                    </a>
                                    </th>
                                    <th scope="row">
                                        <a href="{{ $url22 }}">
                                        {{ isset(request()->userName)?request()->userName:$item['userName2'] }}
                                        </a>
                                    </th>
                                    <th scope="row">{{ $item['lastMessage'] }}</th>
                                    <td>{{ isset($item['detectedCountry'])?$item['detectedCountry']:$item['usersDetectedCountry1'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['lastMessagetime'])->addHours(3) }}</td>
                                    <td>{{ $item['readed']==1? "مقروءة" : "غير مقروءة" }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a type="button" href="{{url('/admin/'.$route)}}/{{ $item['id'] }}{{ (isset(request()->userId))? "?userId=".request()->userId."&userName=".request()->userName:'' }}" class="m-btn m-btn m-btn--square btn btn-secondary">
                                                <i class="fa fa-eye m--font-primary"></i>
                                            </a>
                                            
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="6" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif