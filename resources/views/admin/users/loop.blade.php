@if($collection)

@foreach ($collection as $item)
                                <tr>
                                    <th scope="row">{{ $item['userName'] }}</th>
                                    <td>{{ $item['gender'] == 1 ? "أنثى" : "ذكر" }}</td>
                                    <td style="text-align: center;">{{ $item['age'] }}</td>

                                    <td>{{ $item['nationalityCountryName'] }}</td>

                                    <td>{{ $item['residentCountryName'] }}</td>
                                    <td>
                                    @if(isset($item['detectedCountry']))
                                        {{ $item['detectedCountry'] }}
                                    @else
                                            -
                                    @endif
                                   </td>
                                   
                                    {{--<td>{{ $item['detectedCountry'] }}</td>--}}
                                    <td>
                                        @if ($item['mobileType'] == 1)
                                            Android 
                                        @elseif($item['mobileType'] == 2)
                                            Iphone 
                                        @else
                                         غير معروف
                                        @endif
                                    </td>
                                    <td colspan="3" style="white-space: nowrap;overflow: hidden;">
                                        {{ \Carbon\Carbon::parse($item['lastAccess'])->addHours(3) }}
                                        <br />
                                        <br />
                                        {{ \Carbon\Carbon::parse($item['creationDate'])->addHours(3) }}
                                    </td>

                                    @if(Session::get('admin')['type'] ==1 || array_search(12, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                    <td>
                                        <a type="button" 
                                        href="{{url('/admin/notifications')}}?userId={{ $item['id'] }}&user_name={{ $item['userName'] }}" 
                                        class="m-btn m-btn m-btn--square btn btn-secondary">
                                        إرسال إشعار
                                        </a>
                                    </td>
                                    @endif

                                    <td>
                                        @if (isset($item['susbended']) && $item['susbended'] == 1)
                                            <a type="button"  data-id = "{{ $item['id'] }}" 
                                            class="m-btn m-btn m-btn--square btn btn-warning _activate warning" >
                                                تم حظر العضو
                                            </a>
                                        @else
                                            @if (isset($item['active']) && $item['active'] == 1)
                                                <a type="button"  data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-success _ban success" >
                                                    مفعل
                                                </a>
                                                
                                            @elseif(isset($item['active']) && $item['active'] == 0)
                                                
                                                <a type="button"  data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-danger _activate danger" >
                                                    موقوف
                                                </a>
                                                
                                            @else
                                                <a type="button"  data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-dark _activate dark" >
                                                    محذوف
                                                </a>
                                            @endif  
                                        @endif

                                        <br />
                                        <br />
                                        <a type="button"  data-id = "{{ $item['id'] }}" 
                                        class="m-btn m-btn m-btn--square btn btn-primary _suspend">
                                            حظر العضو
                                        </a>
                                        
                                    </td>


                                    <td>
										@if($item['packageId'] >0)
											<a href="{{url('/admin/subscriptions')}}?q={{ $item['id'] }}"> مدفوع </a>
										@else
											مجاني
										@endif											
                                        <br />
                                        <br />
                                        @if(Session::get('admin')['type'] ==1 || array_search(11, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                            <a type="button"  data-id = "{{ $item['id'] }}" 
                                                class="m-btn m-btn m-btn--square btn btn-primary _subscribe primary">
                                                إشتراك فى باقة
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" 
                                        href="{{url('/admin/favs')}}?userId={{ $item['id'] }}&userName={{$item['userName']}}" 
                                        class="btn btn-secondary">
                                        قائمة الإعجاب
                                        </a>
                                        <a type="button" 
                                        href="{{url('/admin/ignors')}}?userId={{ $item['id'] }}&userName={{$item['userName']}}" 
                                        class="btn btn-secondary">
                                        قائمة الحظر
                                        </a>
                                        <a type="button" 
                                        href="{{url('/admin/photos')}}?userId={{ $item['id'] }}&userName={{$item['userName']}}" 
                                        class="btn btn-secondary">
                                        قائمة مشاهدة الصور
                                        </a>
                                    </td>

                                    <td>
                                        <a type="button" 
                                        href="{{url('/admin/chats')}}?userId={{ $item['id'] }}&userName={{$item['userName']}}" 
                                        class="m-btn m-btn m-btn--square btn btn-secondary">
                                        المحادثات
                                        </a>
                                        @if(Session::get('admin')['type'] ==1 || array_search(15, array_column(Session::get('privlages'), 'moduleId')) !== FALSE)
                                        <a type="button" 
                                        href="{{url('/admin/messages')}}?userId={{ $item['id'] }}&user_name={{ $item['userName'] }}" 
                                        class="m-btn m-btn m-btn--square btn btn-secondary">
                                            الرسائل
                                        </a>
                                        @endif
                                        
                                    </td>

                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            @if(Session::get('admin')['type'] ==1 || $filtered_Read)
                                            <a type="button" href="{{url('/admin/'.$route)}}/{{ $item['id'] }}" class="m-btn m-btn m-btn--square btn btn-secondary">
                                                <i class="fa fa-eye m--font-primary"></i>
                                            </a>
                                            @endif
                                            @if(Session::get('admin')['type'] ==1 || $filtered_Write)
                                            <a type="button" 
                                            href="{{url('admin/users')}}/{{ $item['id'] }}/edit" 
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
    <td colspan="7" style="text-align:center"> {{ __('admin.no_items') }} </td>                                   
</tr>

@endif