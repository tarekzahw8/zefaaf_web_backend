@if($collection)

@foreach ($collection as $item)
                                <tr>
                                    <th scope="row">{{ isset($types[$item['type']])?$types[$item['type']]:'' }}</th>
                                    <td>{{ $item['title'] }}</td>
                                    <td>
                                        @if ($item['active'] == 1)
                                            <a type="button"  data-id = "{{ $item['id'] }}" 
                                            class="m-btn m-btn m-btn--square btn btn-danger _ban">
                                                ايقاف
                                            </a>
                                        @else
                                            <a type="button"  data-id = "{{ $item['id'] }}" 
                                            class="m-btn m-btn m-btn--square btn btn-success _activate">
                                                تفعيل
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