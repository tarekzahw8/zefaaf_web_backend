@extends('front.layouts.app')
@section('content')

@php 
$mariageStatues = isset($user['mariageStatues']) ? array_search($user['mariageStatues'], array_column($allFixedData, 'id')):-1;

$mariageKind = isset($user['mariageKind']) ? array_search($user['mariageKind'], array_column($allFixedData, 'id')):-1;

$skinColor = isset($user['skinColor']) ? array_search($user['skinColor'], array_column($allFixedData, 'id')):-1;
$helath = isset($user['helath']) ? array_search($user['helath'], array_column($allFixedData, 'id')):-1;
$education = isset($user['education']) ? array_search($user['education'], array_column($allFixedData, 'id')):-1;
$financial = isset($user['financial']) ? array_search($user['financial'], array_column($allFixedData, 'id')):-1;
$workField = isset($user['workField']) ? array_search($user['workField'], array_column($allFixedData, 'id')):-1;
$job = isset($user['job']) ? array_search($user['job'], array_column($allFixedData, 'id')):-1;
$income = isset($user['income']) ? array_search($user['income'], array_column($allFixedData, 'id')):-1;
$prayer = isset($user['prayer']) ? array_search($user['prayer'], array_column($allFixedData, 'id')):-1;
$smoking = isset($user['smoking']) ? array_search($user['smoking'], array_column($allFixedData, 'id')):-1;

$veil = isset($user['veil']) ? array_search($user['veil'], array_column($allFixedData, 'id')):-1;
@endphp

            <!-- Start profile data -->
            <div class="profile-data p-5 min-height-footer">
               <div class="container">
                 <h3 class="sub-title">حسابي</h3>

                 <div class="row">
                   <div class="col-sm-6">
                     <div class="data-block mb-4">
                       <h5>البيانات الشخصية</h5>
                       <div>
                         <p>الجنسية<span> {{ $user['nationalityCountryName'] }}</span></p>
                         <p>الإسم بالكامل<span>{{ $user['name'] }}</span></p>
                         <p>الإقامة<span> {{ $user['residentCountryName'] }} </span></p>
                         <p>المدينة<span> {{ $user['cityName'] }} </span></p>
                         <p>البريد الإلكتروني<span>{{ $user['email'] }}</span></p>
                       </div>
                     </div>

                     <div class="data-block mb-4">
                      <h5>المواصفات الجسدية</h5>
                      <div>
                        <p>الوزن<span>{{ $user['weight'] }} </span></p>
                        <p>الطول<span>{{ $user['height'] }} </span></p>
                        <p>لون البشرة<span>{{ $allFixedData[$skinColor]['title']  }}</span></p>
                        <!-- <p>بنية الجسم<span>{{ $user['weight'] }}</span></p> -->
                        <p>الحالة الصحية<span>{{ $allFixedData[$helath]['title'] }} </span></p>
                      </div>
                    </div>

                    <div class="data-block mb-4">
                      <h5>الدراسة و العمل</h5>
                      <div>
                        <p>المؤهل التعليمي <span>{{ $allFixedData[$education]['title'] }}</span></p>
                        <p>الوضع المادي<span>{{ $allFixedData[$financial]['title'] }} </span></p>
                        <p>مجال العمل<span>{{ $allFixedData[$workField]['title'] }} </span></p>
                        <p>الوظيفة<span>{{ $allFixedData[$job]['title']  }}</span></p>
                        <p>مستوى الدخل الشهري<span> {{ $allFixedData[$income]['title'] }}  </span></p>
                      </div>
                    </div>
                   </div>
                   <div class="col-sm-6">
                    <div class="data-block mb-4">
                      <h5>الحالة الإجتماعية</h5>
                      <div>
                        <p>العمر<span>{{ $user['age'] }}</span></p>
                        <p>الحالة الإجتماعية<span>{{ $allFixedData[$mariageStatues]['title']  }} </span></p>
                        @if ($user['mariageStatues'] > 1)
                        
                        <p>نوع الزواج<span>{{ $user['mariageKind'] ? $allFixedData[$mariageKind]['title'] : "" }} </span></p>
                        <p> عدد الاطفال<span>{{ $user['kids'] ? $user['kids'] : "" }} </span></p> 
                        @endif
                        <!-- <p>نوع الزواج<span>{{ $user['weight'] }}</span></p> -->
                      </div>
                    </div>

                    <div class="data-block mb-4">
                      <h5>الإلتزام الديني</h5>
                      <div>
                        {{-- <p>مستوى التدين<span>{{ $user['religiosity'] }}</span></p> --}}
                        <p> الصلاة<span>{{ $allFixedData[$prayer]['title'] }}  </span></p>
                        @if ($user['gender'] == 1)
                        <p> الحجاب<span>{{ $allFixedData[$veil]['title'] }}  </span></p>    
                        @endif
                        
                        {{-- <p>التدخين<span>{{ $allFixedData[$smoking]['title'] }} </span></p> --}}
                        <p>التدخين<span>{{ isset($user['smoking']) && $user['smoking'] == 1 ? "نعم" : "لا" }} </span></p>
                        <!-- <p>اللحية<span></span>{{ $user['weight'] }}</p> -->
                      </div>
                    </div>
                    <div class="data-block mb-4">
                      <h5>عن نفسي </h5>
                      <div>
                        <p>
                        {{ $user['aboutMe'] }}
                        </p>
                      </div>
                    </div>
                    <div class="data-block mb-4">
                      <h5>عن شريك الحياة </h5>
                      <div>
                        <p>
                            {{ $user['aboutOther'] }}
                        </p>
                      </div>
                    </div>
                   
                   </div>
                 </div>
               </div>
            </div>
            <!-- End profile data -->

@endsection		

