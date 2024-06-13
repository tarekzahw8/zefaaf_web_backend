@extends('front.layouts.app')
@section('content')




            <!-- Start forgot password form -->
            <div class="forgot-form p-5 min-height-footer">
               <div class="container">
                  {{-- <h3 class="sub-title"><img src="{{url('/')}}/public/front/imgs/secure.png" alt="secure">تغيير كلمة المرور</h3> --}}
                  <!-- <h5><img src="imgs/secure.png" alt="secure">تغير كلمة المرور</h5> -->
                  <div class="imgTitCover">
                    <img src="{{url('/')}}/front/imgs/changePass.png" alt="lockImg">
                  </div>
                  <form action="{{ url('user/change/password') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label>أدخل كلمة سر جديدة</label>
                      <input type="password" name="password" class="form-control" placeholder="أدخل كلمة سر جديدة">
                      <span style="color:red"> كلمة المرور يجب ان تكون من 8 الى 12 حرف </span>
                    </div>
                    <div class="form-group">
                      <label>إعادة إدخال كلمة السر</label>
                      <input type="password" name="confirmation_password" class="form-control" placeholder="إعادة إدخال كلمة السر">
                    </div>

                    <button class="btn btn-primary main-btn" type="submit">تأكيد</button>
                  </form>
               </div>
            </div>
            <!-- End forgot password form -->

@endsection		

