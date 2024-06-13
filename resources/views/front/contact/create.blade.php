@extends('front.layouts.app')
@section('content')


            <!-- Start contact us form -->
            <div class="main-form p-5 min-height-footer">
               <div class="container">

                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style">
                      <li class="breadcrumb-item"><a href="{{ url('/contact-us') }}">إتصل بنا</a></li>
                      <li class="breadcrumb-item active" aria-current="page">كتابة رسالة</li>
                    </ol>
                  </nav>

                  <form method="post" action="{{ url('/contact-us') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <select class="form-control" name="reasonId">
                        <option value="">نوع الرسالة</option>
                        <option value="0" {{ $type==0?"selected":"" }} >سؤال</option>
                        <option value="1" {{ $type==1?"selected":"" }} >شكوى</option>
                        <option value="2" {{ $type==2?"selected":"" }}>اقتراح</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="title" class="form-control" placeholder="العنوان">
                      <input type="hidden" name="otherId" value=" {{ $otherId }} ">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="message" rows="7" placeholder="المحتوى"></textarea>
                    </div>

                    <div class="form-group">
                      <input type="button" id="loadFileXml" value="إختر صورة" onclick="document.getElementById('imgInp').click();" />
                      <input class="form-control" type="file" name="file" value="Upload" id="imgInp" style="display: none" />
                    </div>
                    <div class="form-group">
                      <img src="" id="image_file" width="300" height="300" style="display:none;">
                    </div>

                    <button class="btn btn-primary main-btn" type="submit">إرسال</button>
                  </form>
                
               </div>
            </div>
            <!-- End contact us form -->


@endsection		

