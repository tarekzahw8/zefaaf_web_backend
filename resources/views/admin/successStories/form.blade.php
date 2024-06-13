


        <div class="m-portlet__body">

            @if($errors->any())
                <div class="m-alert m-alert--icon alert alert-danger" role="alert" id="m_form_1_msg">
                    <div class="m-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        {{ __('admin.fix_errors') }}
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-close="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            @endif

                <div class="form-group m-form__group row {{ $errors->has('husId') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label"> الزوج  </label>
                    <div class="col-3">
                        <input type="text" {{ isset($show)?$show:"" }} id="search_husb" class="form-control m-input"
                                placeholder="بحث باسم الزوج" value="">
                    </div>
                    <div class="col-6">
                        <span id="load-husbands">
                            <select name="husId" {{ isset($show)?$show:"" }} class="form-control m-input">
                                <option value="">اختر الزوج</option>
                                @if($husbands)
                                @foreach ($husbands as $key=>$item)
                                    <option value="{{ $item['id'] }}" 
                                    {{ (isset($row) && $row['husId'] == $item['id'])? "selected" : "" }}
                                    > {{ $item['userName'] }}</option> 
                                @endforeach
                                @endif
                            </select>
                        </span>
                    </div>
                    {!! $errors->first('husId', '<span class="form-control-feedback">:message</span>') !!}
                </div>


                <div class="form-group m-form__group row {{ $errors->has('wifId') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label">   الزوجة  </label>
                    <div class="col-3">
                        <input type="text" {{ isset($show)?$show:"" }} id="search_wife" class="form-control m-input"
                                placeholder="بحث باسم الزوجة" value="">
                    </div>
                    <div class="col-6">
                        <span id="load-wifes">
                            <select name="wifId" {{ isset($show)?$show:"" }} class="form-control m-input">
                                <option value="">اختر الزوجة</option>
                                @if($wifes)
                                @foreach ($wifes as $key=>$item)
                                    <option value="{{ $item['id'] }}"
                                    {{ (isset($row) && $row['wifId'] == $item['id'])? "selected" : "" }}
                                    > {{ $item['userName'] }}</option> 
                                @endforeach
                                @endif
                            </select>
                        </span>
                    </div>
                    {!! $errors->first('wifId', '<span class="form-control-feedback">:message</span>') !!}
                </div>

               
                <div class="form-group m-form__group row {{ $errors->has('story') ? 'has-danger' : ''}}">
                    <label for="name" class="col-1 col-form-label"> محتوى القصة  </label>
                    <div class="col-9">
                        <textarea {{ isset($show)?$show:"" }} name="story" class="form-control m-input" rows="10" placeholder="محتوى القصة" >{{ (isset($row) && $row['story'])? $row['story']: old('story') }}</textarea>
                        {!! $errors->first('story', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            
            
                        <div class="form-group m-form__group row {{ $errors->has('active') ? 'has-danger' : ''}}">
                            <label for="active" class="col-1 col-form-label">{{ __('admin.status') }}</label>
                             <div class="col-9">
                            <select name="active" {{ isset($show)?$show:"" }} class="form-control m-input">
                            <option value="1" {{ (isset($row) && $row['active'] == 1)? "selected" : "" }}> فعال</option>
                            <option value="0" {{ (isset($row) && $row['active'] == 0)? "selected" : "" }}> غير فعال</option>
                            </select>
                                {!! $errors->first('active', '<span class="form-control-feedback">:message</span>') !!}
                            </div>
                        </div>
            
            
            
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-9">
                            @if(!isset($show))
                            <button type="submit" class="btn btn-brand">{{ __('admin.Submit') }}</button>
                            @endif
                            <a type="reset" href="{{url("admin/$route")}}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
@push('script')
<script>
    $("#search_husb").on('input', function() {
        let search = this.value;
        let length = this.value.length;
        if(length >= 6)
        {
            LoadUsers(search,'husband');
        }
    });
    $("#search_wife").on('input', function() {
        let search = this.value;
        let length = this.value.length;
        if(length >= 6)
        {
            LoadUsers(search,'wife');
        }
    });
    function LoadUsers(search,type)
    {
        $.get( "{{url('/admin/user/load/users')}}", { search: search,type:type } )
            .done(function( data ) {
                
                if(type =="husband")
                {
                    $("#load-husbands").html(data);  
                }
                else
                {
                    $("#load-wifes").html(data);
                } 
                
        });
    }    
</script>
@endpush             