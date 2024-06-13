@extends('front.layouts.app')
@section('content')


            <!-- Start contact us form -->
            <div class="main-form p-5 min-height-footer">
               <div class="container">

                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style">
                      <li class="breadcrumb-item"><a href="{{ url('/sucsses/stories') }}">قصص النجاح</a></li>
                      <li class="breadcrumb-item active" aria-current="page">أضف قصتك  </li>
                    </ol>
                  </nav>

                  <form method="post" action="{{ url('/add/sucsses/story') }}" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                      <input type="text" name="otherUserName" class="form-control" placeholder="اسم العضو">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="story" rows="7" placeholder="قصتك"></textarea>
                    </div>

                   

                    <button class="btn btn-primary main-btn" type="submit">إرسال</button>
                  </form>
                
               </div>
            </div>
            <!-- End contact us form -->


@endsection		

