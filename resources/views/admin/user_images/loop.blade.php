@if($collection)

@foreach ($collection as $item)
@php
    $userName1 = $item['userName']; 
	$url11 = url('/admin/users')."?q=$userName1";

  
@endphp
                                <tr>
                                    <th scope="row"><a href="{{ $url11 }}"> {{ $item['userName'] }}</a></th>
                                    <td>{{ $item['gender'] == 1 ? "أنثى" : "ذكر" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['photoUploadeDate'])->addHours(3) }}</td>
                                    <td>
                                        <a href="{{Config::get('app.image_url')}}/{{ $item['tempProfileImage'] }}" target="_blank">
                                            <img src="{{Config::get('app.image_url')}}/{{ $item['tempProfileImage'] }}" id="image_file" width="100" height="100" >
                                        </a>
                                    </td>
                                    <td>
                                        @if(isset($item['residentCountryName']))
                                            {{ $item['residentCountryName'] }}
                                        @else
                                           -
                                        @endif
                                    

                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a type="button" href="{{url('/admin/image/user/request')}}?id={{$item['id']}}&userId={{$item['id']}}&success=1" data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-success" id="accept_image">
                                                موافقة على عرض الصورة
                                            </a>
                                            
                                        </div>
                                        
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            
                                            <a type="button" href="{{url('/admin/image/user/request')}}?id={{$item['id']}}&userId={{$item['id']}}&success=0" data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-danger" id="refuse_image">
                                                رفض عرض الصورة
                                            </a>
                                        </div>
                                    </td>
                                    
                                    
                            </tr>
                            @endforeach
@else

<tr>
    <td colspan="7" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif