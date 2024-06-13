@extends('front.layouts.app')
@section('content')


            <!-- Start contact us form -->
            <div class="main-form p-5 min-height-footer">
               <div class="container">

                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style">
                      
                      <li class="breadcrumb-item active" aria-current="page">انضم إلي وكلائنا</li>
                    </ol>
                  </nav>

                  <form method="post" action="{{ url('/add/agent') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <select class="form-control" name="countryId">
                            @foreach($countries as $key=>$value)
                                <option value="{{ $value['id'] }}"> {{ $value['nameAr'] }} </option>
                            @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" placeholder="الاسم">
                    </div>
                    
                    <div class="form-group">
                      <input type="text" name="email" class="form-control" placeholder="البريد الالكتروني">
                    </div>
                    
                    <div class="form-group">
                      <input type="text" name="mobile" class="form-control" placeholder="رقم الهاتف">
                    </div>
                    
                    <div class="form-group">
                      <input type="text" name="whats" class="form-control" placeholder="رقم الواتس">
                    </div>
                    
                    {{-- <div class="form-group">
                      <input type="text" name="paypalAccount" class="form-control" placeholder="حساب باي بال">
                    </div> --}}

                    
                    <div class="form-group">
                      <input type="button" id="loadFileXml" value="إختر صورة الهوية/جواز السفر" onclick="document.getElementById('imgInp').click();" />
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

