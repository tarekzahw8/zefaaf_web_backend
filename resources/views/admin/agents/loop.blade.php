@if($collection)

@foreach ($collection as $item)

                                <tr>
                                    <th scope="row">{{ $item['name'] }}</th>
                                    <td>{{ $item['countryName'] }}</td>
                                    <td style="direction: ltr;">{{ $item['mobile'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td>{{ ($item['active'] == 1) ? "مفعل" : "موقوف " }}</td>
                                   
                                    <td>
                                        <a type="button"  data-id = "{{ $item['id'] }}" 
                                            class="m-btn m-btn m-btn--square btn btn-primary _add_coupons primary">
                                            اضافة كوبونات  
                                        </a>
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
                                            href="{{url('/admin/'.$route)}}/{{ $item['id'] }}/edit" 
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