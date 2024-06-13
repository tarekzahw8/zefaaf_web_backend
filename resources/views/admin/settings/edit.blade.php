@extends('admin.layouts.index_layout',['title' => __('admin.settings') ])

@section('content')

@if( session('status') )
<div class="m-alert m-alert--icon m-alert--air alert alert-success alert-dismissible fade show" role="alert">
    {{-- <div class="m-alert__icon">
        <i class="la la-warning"></i>
    </div> --}}
    <div class="m-alert__text">
        <strong>{{ session('status') }} </strong>
    </div>
    <div class="m-alert__close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
</div>
@endif

<!--begin::Portlet-->
<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-name">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                   {{ __('admin.edit') }} | {{ __('admin.Settings') }}
                </h3>
            </div>
        </div>
    </div>


    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid" style="margin-top: 20px;">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-9">
                    <a href="{{url('/admin/setting/deleteAdminNotifications')}}" class="btn btn-danger" id="deleteAdminNotifications">حذف اشعارات الادمن</a>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form class="m-form" action="{{url('/admin/'.$route)}}/edit/{{ $row['id'] }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
            {{ method_field('PATCH') }}
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




            
            <div class="form-group m-form__group row {{ $errors->has('mobile') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> حالة الموقع </label>
                <div class="col-9">
                    <select name="websiteStatues" class="form-control m-input">
                        <option value="1" {{ (isset($row) && $row['websiteStatues'] == 1)? "selected" : "" }} >مفعل</option>
                        <option value="0" {{ (isset($row) && $row['websiteStatues'] == 0)? "selected" : "" }}>موقوف</option>
                        
                    </select>
                    
                    {!! $errors->first('websiteStatues', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('websiteOffMessage') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> رسالة الايقاف </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input"  name="websiteOffMessage" value="{{ $row['websiteOffMessage'] }}">
                    {!! $errors->first('websiteOffMessage', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('seoTitle') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> عنوان الموقع </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input"  name="seoTitle" value="{{ $row['seoTitle'] }}">
                    {!! $errors->first('seoTitle', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>

            <div class="form-group m-form__group row {{ $errors->has('seoDescription') ? 'has-danger' : ''}}">
                <label for="name" class="col-2 col-form-label"> الوصف   </label>
                <div class="col-9">
                    <textarea {{ isset($show)?$show:"" }} name="seoDescription" class="form-control m-input" rows="10" >{{ (isset($row) && $row['seoDescription'])? $row['seoDescription']: old('seoDescription') }}</textarea>
                    {!! $errors->first('seoDescription', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('seoMeta') ? 'has-danger' : ''}}">
                <label for="name" class="col-2 col-form-label"> الكلمات الدليلية   </label>
                <div class="col-9">
                    <textarea {{ isset($show)?$show:"" }} name="seoMeta" class="form-control m-input" rows="10" >{{ (isset($row) && $row['seoMeta'])? $row['seoMeta']: old('seoMeta') }}</textarea>
                    {!! $errors->first('seoMeta', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('websiteSuccessStories') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> 
                    عدد قصص النجاح المطلوب ظهورهم بالرئيسية    
                </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input"  name="websiteSuccessStories" value="{{ $row['websiteSuccessStories'] }}">
                    {!! $errors->first('websiteSuccessStories', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('websiteHomeUsers') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label">
                     عدد الأعضاء المطلوب ظهورهم بالرئيسية
                </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input"  name="websiteHomeUsers" value="{{ $row['websiteHomeUsers'] }}">
                    {!! $errors->first('websiteHomeUsers', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('approveNewUsers') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> ظهور الأعضاء الجدد أوتوماتيكياً ؟ </label>
                <div class="col-9">
                    <select name="approveNewUsers" class="form-control m-input">
                        <option value="1" {{ (isset($row) && $row['approveNewUsers'] == 1)? "selected" : "" }} >نعم</option>
                        <option value="0" {{ (isset($row) && $row['approveNewUsers'] == 0)? "selected" : "" }}>لا</option>
                        
                    </select>
                    
                    {!! $errors->first('approveNewUsers', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>

            <div class="form-group m-form__group row {{ $errors->has('abuseKeywords') ? 'has-danger' : ''}}">
                <label for="name" class="col-2 col-form-label"> الكلمات النابية   </label>
                <div class="col-9">
                    <textarea {{ isset($show)?$show:"" }} name="abuseKeywords" class="form-control m-input" rows="10" id="abuseKeywords" >{{ (isset($row) && $row['abuseKeywords'])? $row['abuseKeywords']: old('abuseKeywords') }}</textarea>
                    {!! $errors->first('abuseKeywords', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>

               
            <div class="form-group m-form__group row {{ $errors->has('websiteLink') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> ڤيديو تعريفي  </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input" placeholder="websiteLink" name="websiteLink" value="{{ $row['websiteLink'] }}">
                    {!! $errors->first('websiteLink', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('mobile') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> رقم الموبايل </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input"  name="mobile" value="{{ $row['mobile'] }}">
                    {!! $errors->first('mobile', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('Whatsapp') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> رقم الواتس  </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input" placeholder="{{ __('admin.coins No') }}" name="Whatsapp" value="{{ $row['Whatsapp'] }}">
                    {!! $errors->first('Whatsapp', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('Facebook') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> FaceBook </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input" placeholder="FaceBook" name="Facebook" value="{{ $row['Facebook'] }}">
                    {!! $errors->first('Facebook', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('Instagram') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> Instagram </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input" placeholder="Instagram" name="Instagram" value="{{ $row['Instagram'] }}">
                    {!! $errors->first('Instagram', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
			
            
            <div class="form-group m-form__group row {{ $errors->has('IphoneLink') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> Itunes  </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input" placeholder="{{ __('admin.snap_link') }}" name="IphoneLink" value="{{ $row['IphoneLink'] }}">
                    {!! $errors->first('IphoneLink', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
            
            <div class="form-group m-form__group row {{ $errors->has('AndroidLink') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> google play  </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input" placeholder="{{ __('admin.youtube_link') }}" name="AndroidLink" value="{{ $row['AndroidLink'] }}">
                    {!! $errors->first('AndroidLink', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>
			
            <div class="form-group m-form__group row {{ $errors->has('displayLiveUsers') ? 'has-danger' : ''}}">
                <label for="example-text-input" class="col-2 col-form-label"> المتواجدين حاليا بالموقع  </label>
                <div class="col-9">
                    <input type="text" class="form-control m-input"  name="displayLiveUsers" value="{{ $row['displayLiveUsers'] }}">
                    {!! $errors->first('displayLiveUsers', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>


            <div class="form-group m-form__group row {{ $errors->has('backageDesc') ? 'has-danger' : ''}}">
                <label for="name" class="col-1 col-form-label"> تفاصيل الباقات المدفوعة  </label>
                <div class="col-9">
                    <textarea {{ isset($show)?$show:"" }} id="kt-ckeditor-5" name="backageDesc" class="form-control m-input" rows="10" placeholder="تفاصيل الباقات المدفوعة" >{{ (isset($row) && $row['backageDesc'])? $row['backageDesc']: old('backageDesc') }}</textarea>
                    {!! $errors->first('backageDesc', '<span class="form-control-feedback">:message</span>') !!}
                </div>
            </div>




        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <button type="submit" class="btn btn-brand">{{ __('admin.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->

@push('script')

<script>
    $('#abuseKeywords').bind('keyup keypress blur', function() 
    {  

        var myStr = $(this).val();
        myStr=myStr.replace(/\s+/g, "-");
        $('#abuseKeywords').val(myStr); 
    });
$('#deleteAdminNotifications').on('click', function(e) 
{ 
    e.preventDefault();
    swal({   
            title: 'هل أنت متأكد من حذف الاشعارات ؟',
		  confirmButtonText:  'نعم',
		  cancelButtonText:  'لا',
		  showCancelButton: true,
		  showCloseButton: true,
          target: document.getElementById('rtl-container')
        }).then((result) => {
		  if (result.value) {
            var href = $(this).attr('href');
            window.location.href = href;
          }
        });

});
</script>

@endpush

@endsection
