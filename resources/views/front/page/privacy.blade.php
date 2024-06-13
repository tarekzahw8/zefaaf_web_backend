@extends('front.layouts.app')
@section('content')


            <!-- Start our mission-->
            <div class="p-5 min-height-footer">
               <div class="container">
                 <h3 class="sub-title">سياسة الخصوصية</h3>

                 <div class="main-content">
                    {!! $settings['privacy'] !!}
                 </div>
               </div>
            </div>
            <!-- End our mission -->

@endsection		

