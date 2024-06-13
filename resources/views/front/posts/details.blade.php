@extends('front.layouts.app')
@section('content')


            <!-- Start article details -->
            <div class="p-5 min-height-footer">
               <div class="container">
                
                 <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-style">
                    @if($item['catId'] == 1)
                    <li class="breadcrumb-item"><a href="{{ url('/marriage') }}">الزواج في ضوء السُنّة</a></li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ url('/articles') }}">المقالات</a></li>    
                    @endif
                    
                    <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
                  </ol>
                 </nav>

                 <div class="main-content">
                    <p class="title">{{ $item['title'] }}</p>
                    <p class="date">{{ FormateDate($item['postDateTime']) }} {{ arabictime($item['postDateTime'],Session::get('timeZone')) }}</p>
                   <div class="article-img">
                    @if ($item['featureImage'])
                      <img src="{{Config::get('app.image_url')}}/{{ $item['featureImage'] }}" alt="article">   
                    @else
                      <img src="{{url('/')}}/front/imgs/article1.png" alt="article">    
                    @endif
                     
                     
                   </div>

                   <p>
                       {!! html_entity_decode($item['post']) !!}
                   </p>
                 </div>
               </div>
            </div>
            <!-- End article details -->


@endsection		

