@if($collection)

@foreach ($collection as $item)

@php
    $userName1 = isset(request()->user_name) ? request()->user_name : (isset($item['userName']) ? $item['userName'] : ''); 
	$url11 = url('/admin/users')."?q=$userName1";

  
@endphp

                                <tr>
                                    <th scope="row"><a href="{{ $url11 }}"> {{ isset(request()->user_name) ? request()->user_name : (isset($item['userName']) ? $item['userName'] : '') }} </a></th>
                                    <td>{{ isset($reasons[$item['reasonId']])?$reasons[$item['reasonId']]:'' }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td>{{ $item['readed'] == 1 ? "مقروءة" : "غير مقروءة" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['messageDateTime'])->addHours(3) }}</td>
                                    
                                    
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a type="button" 
                                            href="{{url('/admin/'.$OtherRoute)}}/hide/{{ $item['id'] }}" 
                                            class="m-btn m-btn m-btn--square btn btn-secondary _hide_message">
                                            اخفاء الرسالة
                                            </a>
                                            @if(Session::get('admin')['type'] ==1 || $filtered_Write)
                                            <a type="button" 
                                            href="{{url('/admin/'.$route)}}/{{ $item['id'] }}/edit?message=all" 
                                            class="m-btn m-btn m-btn--square btn btn-secondary">
                                            <i class="fa fa-edit m--font-info"></i>
                                            </a>
                                            @endif
                                            @if(Session::get('admin')['type'] ==1 || $filtered_Delete)
                                            <a type="button"  data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-secondary _remove">
                                                <i class="flaticon-delete-1 m--font-danger"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="6" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif