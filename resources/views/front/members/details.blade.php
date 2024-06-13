@extends('front.layouts.app')
@section('content')
@push('style')
    <style>
      .cancel-request-photo:hover{
        text-decoration: none;
        color: #fff;
      }
      .cancel-request-photo{
        background: #ff0018;
        color: #fff;
        height: 38px;
        min-width: 100px;
        font-size: .8rem;
        padding: 4px 15px !important;
        line-height: 30px;
        margin: 3px;
        border-radius: 25px;
        border: none;
        display: inline-block;
        width: auto !important;
      }
    </style>
@endpush
@php 
$status_color = isset($item['available']) && $item['available']==1?"green":($item['available']==2 ?"#FF4E4E" : "gray") ;
$mariageStatues = isset($item['mariageStatues']) ? array_search($item['mariageStatues'], array_column($allFixedData, 'id')):-1;

$mariageKind = isset($item['mariageKind']) ? array_search($item['mariageKind'], array_column($allFixedData, 'id')):-1;

$skinColor = isset($item['skinColor']) ? array_search($item['skinColor'], array_column($allFixedData, 'id')):-1;
$helath = isset($item['helath']) ? array_search($item['helath'], array_column($allFixedData, 'id')):-1;
$education = isset($item['education']) ? array_search($item['education'], array_column($allFixedData, 'id')):-1;
$financial = isset($item['financial']) ? array_search($item['financial'], array_column($allFixedData, 'id')):-1;
$workField = isset($item['workField']) ? array_search($item['workField'], array_column($allFixedData, 'id')):-1;
$job = isset($item['job']) ? array_search($item['job'], array_column($allFixedData, 'id')):-1;
$income = isset($item['income']) ? array_search($item['income'], array_column($allFixedData, 'id')):-1;
$prayer = isset($item['prayer']) ? array_search($item['prayer'], array_column($allFixedData, 'id')):-1;
$religiosity = isset($item['religiosity']) ? array_search($item['religiosity'], array_column($allFixedData, 'id')):-1;
$smoking = isset($item['smoking']) ? array_search($item['smoking'], array_column($allFixedData, 'id')):-1;

$veil = isset($item['veil']) ? array_search($item['veil'], array_column($allFixedData, 'id')):-1;
@endphp
<!-- Start member details -->
<div class="p-5 min-height-footer">
              <div class="container">
 
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">تفاصيل العضو</li>
                    {{-- @if ($item['ignoreList'] == 1)
                    <li class="breadcrumb-item"><a href="{{ url('/members') }}">قائمة التجاهل</a></li>
                    @elseif ($item['interestList'])
                    <li class="breadcrumb-item"><a href="{{ url('/members') }}">قائمة الإهتمام</a></li>
                    @elseif ($item['allowImage'])
                    <li class="breadcrumb-item"><a href="{{ url('/members') }}">قائمة عرض الصوره</a></li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ url('/members') }}">قوائم الأعضاء</a></li>    
                    @endif   --}}
                    <li class="breadcrumb-item active" aria-current="page">{{ $item['userName'] }}</li>
                    
                   
                  </ol>
                </nav>
                
                <div class="text-center">
                  @if (!$item['available'])
                    <span class="last-seen" id="member-last-seen">آخر ظهور : {{ FormateDate($item['lastAccess']) }} {{ arabictime($item['lastAccess'],Session::get('timeZone')) }} </span>    
                  @else
                  <span class="last-seen" id="member-last-seen" style="background-color: green">متصل الآن</span>  
                  @endif
                  

                  <div class="member-img item-img">
                  @if($item['allowImage'] ==1)
                    @if($item['userImage'] !='')
                    <a class="fancybox" rel="group" href="{{Config::get('app.image_url')}}/{{ $item['userImage'] }}">
                      <img src="{{Config::get('app.image_url')}}/{{ $item['userImage'] }}" alt="member img">
                    </a>
                    @else
                    @if(isset($item['gender']) && $item['gender'] == 1)
                          <a class="fancybox" rel="group" href="{{url('/')}}/front/imgs/woman.png">
                            <img src="{{url('/')}}/front/imgs/woman.png" alt="member img">
                          </a>
                    @else
                        <a class="fancybox" rel="group" href="{{url('/')}}/front/imgs/man2.png">
                            <img src="{{url('/')}}/front/imgs/man2.png" alt="member img">
                        </a>
                    @endif
                    @endif
                  @else
                    @if(isset($item['gender']) && $item['gender'] == 1)
                              <img src="{{url('/')}}/front/imgs/woman.png" alt="member img">
                              @else
                              <img src="{{url('/')}}/front/imgs/man2.png" alt="member img">
                              @endif
                    @endif
                    <!-- <span class="status-badge" style="background:{{ $status_color }}"></span> -->
                    @if($item['packageId'] > 0)
                            <span class="status-badge" style="background-color: {{ $status_color }}">
                              
                                @if(isset($item['gender']) && $item['gender'] == 1)
                                  <img src="{{url('/')}}/front/imgs/king.png" alt="crown" style="width: 18px;height: 18px">
                                @else
									@if($item['packageLevel'] == 4)	
										<img src="{{url('/')}}/platinum.png" alt="crown"  style="width: 18px;height: 18px">
									@elseif($item['packageLevel'] == 5)	
										<img src="{{url('/')}}/mass.png" alt="crown"  style="width: 18px;height: 18px">
									@else
										<img src="{{url('/')}}/front/imgs/man_star.png" alt="crown"  style="width: 18px;height: 18px">
									@endif	
                                @endif
                              
                            </span>
                            @else
                            <span class="status-badge" style="background:{{ $status_color }}"></span>
                            @endif
                    @if($item['allowImage'] !=1)
                    @if(Session::get('user')['packageLevel'] > 1)
                      @if($item['requestImage'] == 0)
                        <button type="button" class="btn btn-dark request-photo">طلب عرض الصورة</button>
                      @else
                        <button type="button" class="btn btn-dark" style="height: 50px;">في إنتظار الموافقة على عرض الصورة</button>
                      @endif
                    @else
                    <!--<a href="{{ url('/packages') }}" class="btn btn-dark request-photo" style="height: 50px;">قم بترقية حسابك لطلب عرض الصورة</a>-->
				<button type="button" class="btn btn-dark has-no-permission-level1">طلب عرض الصورة</button>
                    @endif
                    
                    @endif
                  </div>

                  <div class="member-info">
                    <h5>{{ $item['userName'] }}</h5>
                    
                    <p><i class="fas fa-map-marker-alt mr-2"></i>{{ $item['cityName'] }}/ {{ $item['nationalityCountryName'] }}</p>
                    <p class="note">{{ $item['age'] }} سنة/ {{ $item['mariageStatues']?$allFixedData[$mariageStatues]['title'] : ""  }}</p>
                    <p >عضو منذ : {{ \Carbon\Carbon::parse($item['creationDate'])->format('Y-m-d')  }}</p>
                  </div>

                  <div class="actions-btn my-4">
                    @if($item['interestList'] ==1)
                    <button type="button" class="btn btn-primary remove-fav"><img src="{{url('/')}}/front/imgs/add-friend2.png" alt="icon">إلغاء الإعجاب</button>
                    @else
                    <button type="button" class="btn btn-primary add-fav"><img src="{{url('/')}}/front/imgs/add-friend2.png" alt="icon">إعجاب</button>
                    @endif
                    
                    
                    @if($item['ignoreList'] ==1)
                    <button type="button" class="btn btn-primary remove-ignor"><img src="{{url('/')}}/front/imgs/signal.png" alt="icon">إلغاء التجاهل</button>
                    @else
                    <button type="button" class="btn btn-primary block"><img src="{{url('/')}}/front/imgs/signal.png" alt="icon">تجاهل</button>
                    @endif
                    {{-- <a href="{{ url('/chats/details/') }}/{{ $item['id'] }}" type="button" class="btn btn-primary chatbtn"><img src="{{url('/')}}/front/imgs/chat1.png" alt="icon">محادثة</a> --}}
                    <a href="{{ url('/chats/details/') }}/{{ $item['id'] }}" type="button" class="btn btn-primary"><img src="{{url('/')}}/front/imgs/chat1.png" alt="icon">محادثة</a>
                   
                    
                    
                    {{-- <a type="button" class="btn btn-primary report" href="{{ url('/contact-us/send/message') }}?type=1&other={{ $item['id'] }}" style="text-align: center;padding: 10px;">شكوى</a> --}}
                    <button onclick="location.href = '{{ url('/support')}}';" class="btn btn-primary report" style="text-align: center;padding: 10px;">شكوى</button>
						{{--<button onclick="location.href = '{{ url('/contact-us/send/message') }}?type=1&other={{ $item['id'] }}';" class="btn btn-primary report" style="text-align: center;padding: 10px;">شكوى</button>--}}
                    @if($item['requestMyImage'] && !$item['viewMyImage'])  
                    {{-- <a href="{{ url('notifications/replyPhoto') }}?status=4&otherId={{ $item['id'] }}" class="btn btn-block report" id="ApproveRequest" style="text-align: center; --}}
                    <button onclick="location.href = '{{ url('notifications/replyPhoto') }}?status=4&otherId={{ $item['id'] }}';" class="btn btn-block report" id="ApproveRequest" style="text-align: center;
                    padding: 10px;" type="button"> موافقة على عرض صورتي  </a>
                    @endif
                    @if($item['viewMyImage'])  
                    {{-- <a href="{{ url('notifications/replyPhoto') }}?status=5&otherId={{ $item['id'] }}" class="btn btn-block report" id="RejectRequest" style="text-align: center;padding: 10px;" type="button"> إلغاء عرض صورتي  </a> --}}
                    <button onclick="location.href = '{{ url('notifications/replyPhoto') }}?status=5&otherId={{ $item['id'] }}';" class="btn btn-block report" id="RejectRequest" style="text-align: center;padding: 10px;" type="button"> إلغاء عرض صورتي  </a>
                    @endif
                    @if($item['allowImage'] !=1)
                    @if(Session::get('user')['packageId'] > 0)
                    @if($item['requestImage'] != 0)
                    <button class="btn btn-block cancel-request-photo">إلغاء طلب عرض الصورة</button>
                    @endif  
                    @endif  
                    @endif  
					
					@if($item['requestMyMobile'] && !$item['viewMyMobile'])  
                    <button onclick="location.href = '{{ url('members/replyMobile') }}?status=4&otherId={{ $item['id'] }}';" class="btn btn-block report" id="ApproveRequest" style="text-align: center;
                    padding: 10px;" type="button"> موافقة على عرض رقم هاتفي  </a>
                    @endif
                  </div>

                  <div class="member-details">
                    <h5>عن نفسي</h5>
                    <p class="m-0">
                     {{ $item['aboutMe'] }}
                    </p>
                  </div>
                </div>

                <div class="profile-data mt-4">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="data-block mb-4">
                        <h5>البيانات الشخصية</h5>
                        <div>
                        <p>الجنسية<span>{{ $item['nationalityCountryName'] }}</span></p>
                         {{-- <p>الإسم بالكامل<span>{{ $item['userName'] }}</span></p> --}}
                         <p>الإقامة<span>{{ $item['residentCountryName'] }}</span></p>
                         <p>المدينة<span>{{ $item['cityName'] }}</span></p>
					
                        <p>رقم الهاتف
						@if($item['allowMobile'] !=1)
						@if(Session::get('user')['packageLevel'] > 3)
						  @if($item['requestMobile'] == 0)
							  @if ($item['gender'] == 1)
							<button type="button" class="btn btn-dark request-mobile"   style="background-color: #fc9090;">طلب عرض رقم الهاتف 
							<img src="{{url('/')}}/mobile-request-icon.png" width="25" >
							</button>
							@else
								<button type="button" class="btn btn-dark request-mobile" style="background-color: #2E5EBF;">طلب عرض رقم الهاتف 
							<img src="{{url('/')}}/mobile-request-icon.png" width="25" >
							</button>
							@endif
						  @else
							<button type="button" class="btn btn-dark" style="font-size: 13px;">
							في إنتظار الموافقة على عرض رقم الهاتف
							<img src="{{url('/')}}/mobile-request-icon.png" width="25" >
							</button>
							<img src="{{url('/')}}/front/imgs/failed.png" class="cancel-request-mobile" width="25" style="cursor:pointer">
						  @endif
						@else
							<!--<a href="{{ url('/packages') }}" class="btn btn-dark request-mobile" style="height: 50px;">
							يجب الترقيه للباقة البلاتينية
							</a>-->
							@if ($item['gender'] == 1)
								<button type="button" class="btn btn-dark has-no-permission-level2" style="background-color: #fc9090;">طلب عرض رقم الهاتف <img src="{{url('/')}}/mobile-request-icon.png" width="25"></button>
							@else
								<button type="button" class="btn btn-dark has-no-permission-level2"  style="background-color: #2E5EBF;">طلب عرض رقم الهاتف <img src="{{url('/')}}/mobile-request-icon.png" width="25"></button>
							@endif								
							
						@endif
						@else
						    @if(isset($item['gender']) && $item['gender'] == 1)
                                <span style="color:#fc9090;">
                            @else
                                <span style="color:#007bff;">
						    @endif
						 {{ $item['mobile'] ? $item['mobile'] : "" }}
						        </span>
						        
						@endif
						
						</p>
                        </div>
                      </div>
 
                      <div class="data-block mb-4">
                       <h5>المواصفات الجسدية</h5>
                       <div>
                        <p>الوزن<span>{{ (isset($item['weight']))?$item['weight']:'' }} </span></p>
                        <p>الطول<span>{{ (isset($item['height']))?$item['height']:'' }} </span></p>
                        {{-- <p>لون البشرة<span>{{ isset($item['skinColor'])?$item['skinColor']:'' }}</span></p> --}}
                        {{-- <p>الحالة الصحية<span>{{ (isset($item['helath']))?$item['helath']:'' }} </span></p> --}}
                        <p>لون البشرة<span>{{ isset($item['skinColor'])?$allFixedData[$skinColor]['title'] : ''}}</span></p>
                        <p>الحالة الصحية<span>{{ (isset($item['helath']))?$allFixedData[$helath]['title']:'' }} </span></p>
                       </div>
                     </div>
 
                     <div class="data-block mb-4">
                       <h5>الدراسة و العمل</h5>
                       <div>
                       <p>المؤهل التعليمي<span>{{ $item['education'] ? $allFixedData[$education]['title'] : ""}}</span></p>
                        <p>الوضع المادي<span>{{ $item['financial'] ? $allFixedData[$financial]['title'] : "" }} </span></p>
                        <p>مجال العمل<span>{{ $item['workField'] ? $allFixedData[$workField]['title'] : ""}} </span></p>
                        <p>الوظيفة<span>{{ $allFixedData[$job]['title']  }}</span></p>
                        <p>مستوى الدخل الشهري<span> {{ $item['income'] ? $allFixedData[$income]['title'] : "" }}  </span></p>
                       </div>
                     </div>
                    </div>
                    <div class="col-sm-6">
                     <div class="data-block mb-4">
                       <h5>الحالة الإجتماعية</h5>
                       <div>
                       <p>العمر<span>{{ $item['age'] }}</span></p>
                        <p>الحالة الإجتماعية<span>{{ $item['mariageStatues'] ? $allFixedData[$mariageStatues]['title'] : "" }} </span></p>

                        @if ($item['mariageStatues'] > 1)
                        
                        <p>نوع الزواج<span>{{ $item['mariageKind'] ? $allFixedData[$mariageKind]['title'] : "" }} </span></p>
                        <p> عدد الاطفال<span>{{ $item['kids'] ? $item['kids'] : "" }} </span></p> 
                        @endif

                       </div>
                     </div>
 
                     <div class="data-block mb-4">
                       <h5>الإلتزام الديني</h5>
                       <div>
                       {{-- <p>مستوى التدين<span>{{ $item['religiosity'] }}</span></p> --}}
                       {{-- <p>مستوى التدين<span>{{ $item['religiosity']? $allFixedData[$religiosity]['title'] : ""}}  </span></p> --}}
                        <p> الصلاة<span>{{ $item['prayer']? $allFixedData[$prayer]['title'] : ""}}  </span></p>
                        @if ($item['gender'] == 1)
                        <p> الحجاب<span>{{ $allFixedData[$veil]['title'] }}  </span></p>    
                        @endif
                        <p>التدخين<span>{{ $item['smoking'] ==1 ? "نعم" : "لا" }} </span></p>
                       </div>
                     </div>
 
                     <div class="data-block mb-4">
                       <h5>مواصفات شريك حياتك</h5>
                       <div>
                         <p>
                            {{ $item['aboutOther'] }}
                         </p>
                       </div>
                     </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End member details -->
            

@endsection		

@push('script')

<script> 

$(".add-fav").click(function(){
  let listtype = 1;
  let action = 'add';
  SendRequest(listtype,action);
});
$(".remove-fav").click(function(){
  let listtype = 1;
  let action = 'remove';
  SendRequest(listtype,action);
});
$(".remove-ignor").click(function(){
  let listtype = 0;
  let action = 'remove';
  SendRequest(listtype,action);
});
$(".block").click(function(){
  let listtype = 0;
  let action = 'add';
  SendRequest(listtype,action);
});

function SendRequest(listtype,action){
  let otherId = "{{ $item['id'] }}";          
          $.ajax({
            type:'POST',
            url:base_url+"/add/to/fav",
            data:{listType:listtype,otherId:otherId,"action":action},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message);   
                window.setTimeout(function() {
                    location.reload();
                }, 5000);
              }
            }
          });
}

$(".request-photo").click(function(){
  let otherId = "{{ $item['id'] }}";          
          $.ajax({
            type:'POST',
            url:base_url+"/request/photo",
            data:{otherId:otherId},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message);   
                window.setTimeout(function() {
                    location.reload();
                }, 2000);
              }
            }
          });
});

$(".cancel-request-photo").click(function(){
  let otherId = "{{ $item['id'] }}";          
          $.ajax({
            type:'POST',
            url:base_url+"/cancel/request/photo",
            data:{otherId:otherId},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message); 
                window.setTimeout(function() {
                    location.reload();
                }, 2000);  
              }
            }
          });
});

$("#SendChatBtn").click(function(){
  toastr.error("هذه الخدمة لأصحاب الباقة الفضية ");
});

$(".request-mobile").click(function(){
  let otherId = "{{ $item['id'] }}";          
          $.ajax({
            type:'POST',
            url:base_url+"/request/mobile",
            data:{otherId:otherId},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message);   
                window.setTimeout(function() {
                    location.reload();
                }, 2000);
              }
            }
          });
});

$(".cancel-request-mobile").click(function(){
  let otherId = "{{ $item['id'] }}";          
          $.ajax({
            type:'POST',
            url:base_url+"/cancel/request/mobile",
            data:{otherId:otherId},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message); 
                window.setTimeout(function() {
                    location.reload();
                }, 2000);  
              }
            }
          });
});
</script>

@endpush