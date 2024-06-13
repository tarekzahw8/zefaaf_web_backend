


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

            @if (isset(request()->userId))
            <div class="form-group m-form__group row ">
                <label for="name" class="col-2 col-form-label"> بحث عن عضو  </label>
                <div class="col-9">
                    <input type="text" {{ isset($show)?$show:"" }}  class="form-control m-input" disabled value="{{ request()->user_name }}">
                    <input type="hidden" {{ isset($show)?$show:"" }} name="userId" class="form-control m-input" value="{{ request()->userId }}">
                </div>
            </div>
            @else
            <div class="form-group m-form__group row ">
               <!-- <label for="name" class="col-2 col-form-label"> العضو  </label>
                <div class="col-5">
                    <input type="text" {{ isset($show)?$show:"" }} id="search" class="form-control m-input"
                            placeholder="بحث باسم العضو" value="">
                </div>-->
				<label for="name" class="col-2 col-form-label"> دولة الاقامة  </label>
				<div class="col-9">
                    <span id="load-users">
                        <select name="country" {{ isset($show)?$show:"" }} class="form-control m-input">
                            <option value="all"> الكل</option>
							 @foreach($countries as $key=>$value)
								
								<option value="{{ $value['id'] }}" > {{ $value['nameAr'] }} </option>
							@endforeach 
                        </select>
                    </span>
                    
                </div>
				</div>
				<div class="form-group m-form__group row ">
               
					<label for="name" class="col-2 col-form-label"> النوع  </label>
					<div class="col-9">
						<span id="load-users">
							<select name="gender" {{ isset($show)?$show:"" }} class="form-control m-input">
								<option value="all">إرسال للكل</option>
								<option value="man">رجال</option>
								<option value="woman">نساء</option>
							</select>
						</span>
						
					</div>
                {!! $errors->first('topic', '<span class="form-control-feedback">:message</span>') !!}
				</div>
            @endif
            
            
                <div class="form-group m-form__group row {{ $errors->has('title') ? 'has-danger' : ''}}">
                    <label for="name" class="col-2 col-form-label"> العنوان  </label>
                    <div class="col-9" >
                        <input type="text" {{ isset($show)?$show:"" }} name="title" class="form-control m-input"
                                placeholder="العنوان" value="{{ (isset($row) && $row['title'])? $row['title']: old('title') }}">
                        {!! $errors->first('title', '<span class="form-control-feedback">:message</span>') !!}
                    </div>
                </div>
            
                <div class="form-group m-form__group row {{ $errors->has('post') ? 'has-danger' : ''}}">
                    <label for="name" class="col-2 col-form-label"> التفاصيل  </label>
                    <!--style="max-width: 100% !important;flex: 0 0 100% !important;"-->
                    <div class="col-9" >
                        <textarea {{ isset($show)?$show:"" }} name="message" class="form-control m-input" rows="10" placeholder="التفاصيل" >{{ (isset($row) && $row['post'])? $row['post']: old('post') }}</textarea>
                        {!! $errors->first('post', '<span class="form-control-feedback">:message</span>') !!}
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
    $("#search").on('input', function() {
        let search = this.value;
        let length = this.value.length;
        if(length >= 6)
        {
            $.get( "{{url('/admin/user/load/users')}}", { search: search,type:'notification' } )
            .done(function( data ) {
                $("#load-users").html(data);
            });
        }
    });
</script>
@endpush            