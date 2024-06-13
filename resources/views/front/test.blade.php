@extends('front.layouts.app')
@section('content')

@push('style')
    <style>


.demo h1 {
	text-align:center;
}

.messages, 
.messages .message, 
.new-message {
	width:100%;
	float:left;
	padding:10px;
	box-sizing:border-box;
	margin:0 0 10px 0;
	position:relative;
}

.new-message {
	margin-top:50px;
}

.message {
	background:none #fff;
}


.new-message button {
	position:absolute;
	right:10px;
	top:10px;
	width:50px;
	height:50px;
	line-height:50px;
	text-align:center;
	border:0 none;
	background:none #2f9a8a;
	color:#fff;
	font-size:160%;
	cursor:pointer;
}

.new-message button:hover {
	background:none #1d7e6f;
}

.new-message button.recording {
	background:none #d00;
}

.new-message button,
.new-message .message-box,
.messages .message {
	-webkit-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);
	-moz-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);
	box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);
}

.new-message button,
.new-message .message-box,
.audio-control .playtoggle {
	outline:none;
}

.new-message .message-box {
	width:60%;
	float:left;
	box-sizing:border-box;
	padding:12px;
	margin:0;
	border:0 none;
	background:none #fff;
	font-size:120%;
	resize:none;
	overflow:visible;
	height:50px;
	position:relative;
}

.new-message:after,
.messages .message:after {
	content:' ';
	position:absolute;
	z-index:1000;
	top:0;
	right:-6px;
	width:0;
	height:0;
	border-style:solid;
	border-width:6px 6px 0 0;
	border-color:#fff transparent transparent transparent;
}

.new-message:after {
	top:10px;
	right:69px;
}

button.audio {
	display:none;
}

.audio-control {
	width:100%;
	float:left;
	box-sizing:border-box;
	padding:0 100px 0 50px;
	height:50px;
	position:relative;
}

.audio-control.loading {
	opacity:0.3;
}

.audio-control .playtoggle {
	width:50px;
	height:50px;
	font-size:160%;
	text-align:center;
	line-height:50px;
	border:0 none;
	background:none transparent;
	color:#000;
	position:absolute;
	top:0;
	left:0;
	cursor:pointer;
	margin:0;
	padding:0;
}

.audio-control .playtoggle::-moz-focus-inner {
	border:0 none;
	padding:0;
	margin:0;
}

.audio-control .timer {
	width:80px;
	line-height:50px;
	height:50px;
	position:absolute;
	right:0;
	top:0;
}

.audio-control .timer:after {
	content:'s';
}

.audio-control.loading .timer:after {
	content:'';
}

.audio-control .duration {
	position:relative;
	width:100%;
	height:2px;
	background:none #000;
	margin:23px 0 0;
}

.audio-control .duration .duration-played {
	width:0%;
	position:absolute;
	top:-1px;
	left:0;
	height:4px;
	background:#2f9a8a;
}

.new-message .onair {
	color:#d00;
	font-weight:900;
}

.new-message .timer:after {
	content:'s';
}

.message .timestamp {
	font-size:80%;
	font-weight:900;
	color:#ddd;
}
    </style>
@endpush
<div class="chat p-5" style="margin-bottom: 500px">
    <div class="container">
        <div class="demo">
            
            
            <div class="new-message">
                <div class="message-box"><span class="onair"><span class="icon icon-recording"></span> Recording audio:</span> <span class="timer"></span></div>
                <textarea class="message-box" rows=1 placeholder="Type your message..."></textarea>
                <button class="audio" style="width: 33%"><span class="icon icon-mic"></span> Record</button>
                <button class="send" style="width: 33%"><span class="icon icon-send"></span>SEND</button>
            </div>
            <div class="messages"></div>

            
        </div>
    </div>
</div>

@push('script')
<script src="{{url('/')}}/public/front/js/audio/audiorecorder.js"></script>
<script src="{{url('/')}}/public/front/js/audio/timer.js"></script>
<script>

$(document).ready( function(){
	
	$('div.message-box').hide();
	var timers = [];
	
	function addMessage(type, val){
		var message = document.createElement('div');
		message.className = 'message message-' + type;
		
		var timestamp = document.createElement('div');
		timestamp.className = 'timestamp';
		var now = new Date();
		var hours = now.getHours();
		var am = 'am';
		if( hours > 12 ){
			hours -= 12;
			am = 'pm';
		}
		timestamp.innerHTML = now.getFullYear() + '/' + ( '00' + ( now.getMonth() + 1 ) ).substr(-2) + '/' + ( '00' + now.getDate() ).substr(-2) + ' ' + ( '00' + hours ).substr(-2) + ':' + ( '00' + now.getMinutes() ).substr(-2) + am
		message.appendChild(timestamp);
		
		switch(type){
			case 'text':
				var content = document.createElement('div');
				content.className = 'content';
				content.innerHTML = val.message.replace(/\n/g, '<br>');
				message.appendChild(content);
			break;
			case 'audio':
				var content = document.createElement('div');
				content.className = 'content loading';
				content.setAttribute('id', 'uuid_' + val.uuid);
				content.setAttribute('data-uuid', val.uuid);
				content.setAttribute('data-duration', val.duration);
				
				var control = document.createElement('div');
				control.className = 'audio-control loading';
				
				var playtoggle = document.createElement('button');
				playtoggle.className = 'playtoggle icon-play_arrow';
				control.appendChild(playtoggle);
				
				var duration = document.createElement('div');
				duration.className = 'duration';
				var played = document.createElement('div');
				played.className = 'duration-played';
				duration.appendChild(played);
				control.appendChild(duration);
				
				var timer = document.createElement('span');
				timer.className = 'timer';
				timer.innerHTML = 'Loading...';
				control.appendChild(timer);
				content.appendChild(control);
				
				message.appendChild(content);
			break;
		}
		
		$('.messages').prepend(message);
	}
	
	function adjustTextareaHeight( obj ){
		$(obj).height(1);
		if( $(obj)[0].scrollHeight != $(obj).outerHeight(true) && $(obj)[0].scrollHeight > 50 ){
			$(obj).outerHeight( $(obj)[0].scrollHeight );
		} else {
			$(obj).outerHeight( 50 );
		}
	}
	
	function saveAudio(uuid, blob, base64){
		
		var url = 'data:audio/mp3;base64,' + base64;
		console.log(uuid, blob, base64,url);
		var message_content = $('#uuid_' + uuid);
		var duration_played = message_content.find('.duration .duration-played');
		
		var audio = document.createElement('audio');
		audio.setAttribute('volume', 1);
		
		audio.addEventListener('timeupdate', function(e){
			var percent = audio.currentTime / audio.duration * 100;
			duration_played.css({ 'width':percent + '%' });
		});
		
		var source = document.createElement('source');
		source.setAttribute('type','audio/mpeg');
		source.src = url;
		audio.appendChild(source);
		
		$(message_content).append(audio);
		timers[uuid] = message_content.find('.timer').timer();
		timers[uuid].set( $(message_content).attr('data-duration') );
		$(message_content).find('.loading').removeClass('loading');
		sendAudioFile(base64,url);
	}

	var recorder = $.audioRecorder({
		onaccept:function(){
			$('button.send').hide();
			$('button.audio').attr('data-accepted',1).show();
		},
		onsuccess:saveAudio,
		onerror:function(e){
			console.log('error occured', e);
		}
	});
	recorder.init();
	
	var timer = $('.message-box .timer').timer();	
	$('.new-message button.audio').on('mousedown', function(){
		$(this).addClass('recording')
		$('div.message-box').show();
		$('textarea.message-box').hide();
		timer.clear();
		timer.start();
		recorder.start();
	}).on('mouseup', function(){
		$(this).removeClass('recording')
		$('div.message-box').hide();
		$('textarea.message-box').show();
		timer.stop();
		recorder.stop();
		console.log('timer stopped', timer.duration);
		addMessage('audio', {uuid:recorder.uuid, duration:timer.duration});
	});
	
	$('.new-message button.send').on('click', function(){
		if( $('textarea.message-box').val() > '' ){
			addMessage('text', {message:$('textarea.message-box').val()});
			$('textarea.message-box').val('').outerHeight(50);
			if( $('button.audio').attr('data-accepted') == 1 ){
				$('button.send').hide();
				$('button.audio').show();
			}
		}
	});
	
	$('.messages').on('click', '.audio-control button.playtoggle', function(){
		var playtoggle = $(this);
		var message = playtoggle.closest('.message');
		var content = message.find('.content');
		var uuid = content.attr('data-uuid');
		var audio = message.find('audio').get(0);
		var timer = message.find('.timer');
		var duration_played = content.find('.duration .duration-played');
		var $timer = timers[uuid];
		
		console.log('click', $timer);
		
		if( !audio || !audio.play ){
			return;
		}
		
		if( playtoggle.hasClass('icon-play_arrow') ){
			if( !playtoggle.hasClass('started') ){
				$timer.set(0);
				duration_played.width(0);
			}
			$timer.start();
			audio.play();
			playtoggle.removeClass('icon-play_arrow').addClass('icon-pause').addClass('started');
		} else {
			audio.pause();
			$timer.pause();
			playtoggle.addClass('icon-play_arrow').removeClass('icon-pause');
		}
		
		audio.addEventListener('ended', function(){
			playtoggle.addClass('icon-play_arrow').removeClass('icon-pause').removeClass('started');
			$timer.stop();
			$timer.set( content.attr('data-duration' ) );
			duration_played.css({ 'width':'100%' });
		});
		
	});
	
	$('textarea.message-box').on('keyup', function(e){
		adjustTextareaHeight( $(this) );
		if( $(this).val() > '' && $('button.send').is(':hidden') ){
			$('button.send').show();
			$('button.audio').hide();
		} else if( $(this).val() == '' && $('button.audio').is(':hidden') && $('button.audio').attr('data-accepted') == 1 ){
			$('button.send').hide();
			$('button.audio').show();
		}
	}).on('keydown', function(e){
		adjustTextareaHeight( $(this) );
	});

});

function sendAudioFile(base64,url) {
         $.ajax({
          type:'POST',
          url:base_url+"/test",
          data:{base64:base64,url:url},
          success:function(data){}
        });
}
</script>
@endpush


@endsection	