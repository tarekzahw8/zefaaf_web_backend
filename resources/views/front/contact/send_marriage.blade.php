@extends('front.layouts.app')
@section('content')


            <!-- Start contact us form -->
            <div class="main-form p-5 min-height-footer">
               <div class="container">

                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style">
                      <li class="breadcrumb-item"><a href="{{ url('/contact-us') }}">طلبات الزواج</a></li>
                      <li class="breadcrumb-item active" aria-current="page">طلب زواج</li>
                    </ol>
                  </nav>

                  <form method="post" action="{{ url('/contact-us/store/marriage') }}" enctype="multipart/form-data">
                    @csrf
                  
					<div class="form-group">
                      <input type="text" name="realName" class="form-control" placeholder="إسمك الأول "/>
                    </div>
					
					<div class="form-group">
                      <input type="text" name="age" class="form-control" placeholder="عمرك"/>
                    </div>

					
					<div class="form-group">
                      <input type="text" name="whats" class="form-control" placeholder="رقم الواتس اب"/>
                    </div>
					
					<div class="form-group">
                                    <select class="form-control" name="mariageStatues" id="marriageStatus">
                                      <option value=""> حالتك الإجتماعية</option>
                                      @foreach ($fixedData['marriageStatus'] as $key=>$item)
                                        <option value="{{ $item['id'] }}" data-gender="{{ $item['gender'] }}">{{ $item['title'] }}</option>    
                                      @endforeach
                                      
                                    </select>
                                  </div>
								  
									<div class="form-group">
                                      <select class="form-control" name="mariageKind">
                                        <option value="">نوع الزواج</option>
                                        @foreach ($fixedData['mariageKind'] as $key=>$item)
                                          <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>    
                                        @endforeach
                                        {{-- <option value="0">أعزب</option>
                                        <option value="1">متزوج</option>
                                        <option value="2">مطلق</option>
                                        <option value="3">أرمل</option> --}}
                                      </select>
                                    </div>									
					
                    <div class="form-group">
                      <textarea class="form-control" name="aboutMe" rows="7" placeholder="مواصفاتك بإختصار"></textarea>
                    </div>
					@php
					if(Session::get('user')['gender'] == 1 )
					{
						$aboutOther_place= "مواصفات زوجي على زفاف";
						$thanksMessage_place= "وجهي كلمة شكر لفريق العمل";
					}
					else
					{
						$aboutOther_place= "مواصفات زوجتي على زفاف";
						$thanksMessage_place= "وجه كلمة شكر لفريق العمل";
					}
					@endphp
					<div class="form-group">
                      <textarea class="form-control" name="aboutOther" rows="7" placeholder="{{$aboutOther_place}}"></textarea>
                    </div>
					
					<div class="form-group">
                      <textarea class="form-control" name="thanksMessage" rows="7" placeholder="{{$thanksMessage_place}}"></textarea>
                    </div>

                   

                    <button class="btn btn-primary main-btn" type="submit">إرسال طلبك </button>
                  </form>
                
               </div>
            </div>
            <!-- End contact us form -->


@endsection		

