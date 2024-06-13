@extends('admin.layouts.index_layout' , ['title' => __("admin.$route") ,'route' => $route])

@section('content')

<div class="m-portlet m-portlet--full-height">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
					المحادثة 
				</h3>
			</div>
		</div>

	</div>
	<div class="m-portlet__body">
		<div class="tab-content">
			<div class="tab-pane active show" id="m_widget2_tab1_content" aria-expanded="true">
				<!--begin:Timeline 1-->
				<div class="m-timeline-1 m-timeline-1--fixed">
					<div class="m-timeline-1__items">
						<div class="m-timeline-1__marker"></div>
						{{-- <div class="m-timeline-1__item m-timeline-1__item--left m-timeline-1__item--first">
							<div class="m-timeline-1__item-circle"><div class="m--bg-danger"></div></div>
							<div class="m-timeline-1__item-arrow"></div>
							<span class="m-timeline-1__item-time m--font-brand">11:35<span>AM</span></span>
							<div class="m-timeline-1__item-content">
							 	<div class="m-timeline-1__item-title">
				 					Users Joined Today
				 				</div>
				 				<div class="m-timeline-1__item-body">
					 				<div class="m-list-pics">
	                                    <a href="#"><img src="assets/app/media/img/users/100_4.jpg" title=""></a>
	                                    <a href="#"><img src="assets/app/media/img/users/100_13.jpg" title=""></a>
	                                    <a href="#"><img src="assets/app/media/img/users/100_11.jpg" title=""></a>
	                                    <a href="#"><img src="assets/app/media/img/users/100_14.jpg" title=""></a>
	                                    <a href="#"><img src="assets/app/media/img/users/100_7.jpg" title=""></a>
	                                    <a href="#"><img src="assets/app/media/img/users/100_3.jpg" title=""></a>
	                                </div>
	                                <div class="m-timeline-1__item-body m--margin-top-15">
	                                	Lorem ipsum dolor sit amit,consectetur eiusmdd<br>
	                                	tempors labore et dolore.
	                                </div>
	                            </div>
							</div>
                        </div>	 --}}
                        @php
                         $i=0;
						 $last_sender_id = null;
						 $old_dir = null;
						 $dir = "right";
                        @endphp
                        @foreach ($collection as $row)
						@php
							if($last_sender_id == null)
							{
								$dir = "right";
							}
							elseif($last_sender_id == $row['senderId']) {
								$dir == $old_dir;
							}
							else {
								$dir = ($dir == "right")?"left":"right";
							}

							//$dir = ( && $last_sender_id != $row['senderId'])? "right" : "left";
						@endphp
                    <div class="m-timeline-1__item m-timeline-1__item--{{ $dir }} {{ ($i==0)? "m-timeline-1__item--first" : "" }}">
                                <div class="m-timeline-1__item-circle"><div class="m--bg-danger"></div></div>
                                <div class="m-timeline-1__item-arrow"></div>
                                <span class="m-timeline-1__item-time m--font-brand">
                                {{ $row['messageTime'] }} &nbsp;</span>
								<div class="m-timeline-1__item-content" style="margin-bottom: 100px;">
									<div class="media">
                                        
                                        <div class="media-body" style="word-break: break-all;">
                                            <div class="m-timeline-1__item-title m--margin-top-10  ">
                                                {{$row['userName']}}
                                            </div>
                                            <div class="m-timeline-1__item-body">
                                                @if($row['type'] == 2)
                                                    <img  src="{{Config::get('app.uploaded_url')}}/{{$row['message']}}" title="" width="100" height="100">
                                                @elseif($row['type'] == 3)
                                                    <audio controls>
                                                        <source src="{{Config::get('app.uploaded_url')}}/{{$row['message']}}" type="audio/ogg">
                                                        <source src="{{Config::get('app.uploaded_url')}}/{{$row['message']}}" type="audio/mpeg">
														<source src="{{Config::get('app.uploaded_url')}}/{{$row['message']}}" type="audio/mp4">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @elseif($row['type'] == 1)
												<img  src="{{Config::get('app.uploaded_url')}}/{{$row['message']}}" title="" width="100" height="100">
                                                @else
                                                {{$row['message']}}
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @php
                            $i++;
							$last_sender_id = $row['senderId']; 
							$old_dir = $dir; 
                        @endphp
                        @endforeach



					</div>
				</div>
				<div class="row">
					<div class="col m--align-center">
						<a type="reset" href="{{url('/admin/'.$route)}}{{ (isset(request()->userId))? "?userId=".request()->userId.'&userName='.request()->userName:'' }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
					</div>
				</div>
				<!--End:Timeline 1-->
			</div>

		</div>
	</div>
</div>

@endsection