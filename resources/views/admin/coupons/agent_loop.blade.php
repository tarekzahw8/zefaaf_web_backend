@if($collection)

@foreach ($collection as $item)
@php
    $userName1 = $item['copounUser']; 
	$url11 = url('/admin/users')."?q=$userName1";

   
@endphp

                                <tr>
                                    <th scope="row">{{ $item['copoun'] }}</th>
                                    <td>{{ $item['addedDate'] }}</td>
                                    <td>{{ $item['usedDate'] }}</td>
                                    <td>
									@if(Session::get('admin'))
									<a href="{{ $url11 }}">
									@endif
									{{ $item['copounUser'] }}
									@if(Session::get('admin')) </a>@endif
									</td>
                                    <td>
                                        @foreach ($packages as $row)
                                            @if ($item['packageId'] == $row['id'])
                                                {{ $row['title'] }}
                                            @endif
                                        @endforeach
                                    </td>
                                    
                                    {{-- <td>{{ $item['agentName'] }}</td> --}}
                                   
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            @if (!$item['copounUser'])
                                                <a type="button"  data-package_id="{{ $item['packageId'] }}" data-id = "{{ $item['id'] }}"  class="m-btn m-btn m-btn--square btn btn-primary _add_user_coupons primary">
                                                    تخصيص 
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