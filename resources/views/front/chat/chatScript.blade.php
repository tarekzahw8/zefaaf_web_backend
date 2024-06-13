@push('script')
<script>
  function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'م' : 'ص';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}


    var currentUserName = "{{ Session::get('user')['userName'] }}";
    var currentpackageId = "{{ Session::get('user')['packageId'] }}";
    var uploaded_url = "{{Config::get('app.uploaded_url')}}/";
    $("#SubmitExample").click(function(){
      $("#chat-contact-from").submit();
    });
    window.onload=function () {
      
      updateScroll();
      var otherUserName = "{{ strtolower($user['userName']) }}";
      var socketMessage = JSON.stringify({'receiverChatID': otherUserName});
      socket.emit("confirm_readed", [socketMessage]);
    }
    $("#audio-record-error-message").click(function () { 
      //ShowErrorMessage();
	  toastr.error("هذه الخدمة لأصحاب الباقة الفضية ");   
    })
    function ShowErrorMessage () {
      Swal.fire({
          icon: 'error',
          title: '<p style="color:red">قم بترقيه باقتك</p> ',
          html: '<p style="color: black;font-size: 15px;">عفوا لايمكن إرسال رسالتك حيث انك علي الباقه المجانيه</p> ',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          cancelButtonText: 'شكرا لا أريد',
          confirmButtonText:'أرغب بترقية الباقة',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            var redirect_url = "{{url('/packages')}}";
            window.location = redirect_url;
            // window.location = "{{url('/contact-us/message/details/168')}}";
          } 
        });
    }

    function updateScroll(){
      $(".chat-box").scrollTop($(".chat-box")[0].scrollHeight);
    }

    $("#send-chat-message").click(function (e) { 
        e.preventDefault();
        if(currentpackageId > 0)
        {
          SendMessage();
        }
        else
        {
          ShowErrorMessage();
        }
        
    });

    $("#ChatImageModal").click(function(e) {
      e.preventDefault();
      $('#ChatImage').trigger('click');
    });

    $("#ChatImage").change( function () {
      readChatURL(this);
      SubmitChatFile();
    });
    var currentdate = new Date(); 
    var datetime =  currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
    function readChatURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
              
        reader.onload = function(e) {
          $chat_image = e.target.result;
          $message_content = `<div class="chat-r d-flex">
                                  <div class="mess mess-r">
                                    <p><img src="{{url('/')}}/front/imgs/arrow-old.png" alt="check"><img  src="`+$chat_image+`" title="" width="100" height="100"></p>
                                    <div class="check">
                                      <span>`+formatAMPM(new Date)+`</span>
                                    </div>
                                  </div>
                                  <div class="sp"></div>
                                </div>`;
                          $(".chat-box").append($message_content);
          
        }
              
        reader.readAsDataURL(input.files[0]);
      }
    }

    function SubmitChatFile () { 
      var file_data = $('#ChatImage').prop('files')[0];   
      var form_data = new FormData();   
      var chatId = {{ isset($chatId)? $chatId : 0 }};               
      form_data.append('file', file_data);
      form_data.append('chatId', chatId);
      form_data.append('type', 2);
      $.ajax({
        url:base_url+"/chats/send/message",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type:'POST',
        success: function(data){
          if(!data.success)
          {
            toastr.error(data.message);   
          }
          else
          {
            updateScroll();
            SendSocket(data.chat_message,data.messageId,2);
          }
            //alert(php_script_response); // display response from the PHP script, if any
        }
     });
    }


    function SendMessage() {
        let chat_message = $("#chatTxt").val();
        if (!$.trim($("#chatTxt").val())) {
          return false;
        }
        var chatId = {{ isset($chatId)? $chatId : 0 }};
        let type = 0;
        
        SubmitMessage(chat_message,chatId,type);
    }


    function SubmitMessage (chat_message,chatId,type,src_stickers=null)
    {
      
      $.ajax({
                    type:'POST',
                    url:base_url+"/chats/send/message",
                    data:{chat_message:chat_message,chatId:chatId,type:type},
                    success:function(data) {
                        $("#chatTxt").val("");
                        $('.mic').show();
                        $('.send').hide();
                        if(!data.success)
                        {
                            toastr.error(data.message);   
                        }
                        else
                        {
                          if(type ==1) 
                          {
                            $message_content = `<div class="chat-r d-flex">
                                    <div class="mess mess-r">
                                      <p><img src="{{url('/')}}/front/imgs/arrow-old.png" alt="check"><img  src="`+src_stickers+`" title="" width="100" height="100" class="sticker-message"></p>
									  <span class="svg-icon svg-icon-primary svg-icon-2x delete-message" data-id="`+data.messageId+`" style="cursor:pointer"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36px" height="36px" viewBox="0 0 36 36" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="36" height="36"/>
        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                      <div class="check">
                                        <span>`+formatAMPM(new Date)+`</span>
                                      </div>
                                    </div>
                                    <div class="sp"></div>
                                  </div>`;
                          }
                          else
                          {
                            $message_content = `<div class="chat-r d-flex">
                                  <div class="mess mess-r">
                                    <p><img src="{{url('/')}}/front/imgs/arrow-old.png" alt="check">`+chat_message+`</p><span class="svg-icon svg-icon-primary svg-icon-2x delete-message" data-id="`+data.messageId+`" style="cursor:pointer"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36px" height="36px" viewBox="0 0 36 36" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="36" height="36"/>
        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <div class="check">
                                      <span>`+formatAMPM(new Date)+`</span>
                                    </div>
                                  </div>
                                  <div class="sp"></div>
                                </div>`;
                          }
                          
                          $(".chat-box").append($message_content);
                          
                          updateScroll();
                          SendSocket(chat_message,data.messageId,type);
                        }
                    }
                });
    }


    function SendSocket(chat_message,messageId,type,duration=1) {  
      var otherUserName = "{{ strtolower($user['userName']) }}";
      var socketMessage = JSON.stringify({
        'receiverChatID': otherUserName,
        'content': chat_message,
        'messageId': messageId,
        'parent': 0,
        'parentType':0,
        'parentMessage':"",
        'type':type.toString(),
        'senderChatID': currentUserName,
        'voiceTime':parseInt(duration)

      });
      console.log(socketMessage);
      socket.emit("send_message", [socketMessage]);
    }
	
	$(".emoji-radio").change(function(){
		sendEmojy();
	});
	
	function sendEmojy()
	{
		if(currentpackageId > 0)
      {
        var message = $('input[name="emotion"]:checked').val();
		console.log(message,"emojy");
        var chatId = {{ isset($chatId)? $chatId : 0 }};
        $src_stickers = "{{Config::get('app.uploaded_url')}}/"+message;
        $('.emoji-img').removeClass('selected');  
        
        // $(".chat-box").append($message_content);
        SubmitMessage(message,chatId,1,$src_stickers);
      }
      else
      {
          ShowErrorMessage();
      }
	  $('#modelId').modal('toggle');
	}

    $("#SubmitEmojy").click(function(){
      if(currentpackageId > 0)
      {
        var message = $('input[name="emotion"]:checked').val();
        var chatId = {{ isset($chatId)? $chatId : 0 }};
        $src_stickers = "{{Config::get('app.uploaded_url')}}/"+message;
        $('.emoji-img').removeClass('selected');  
        
        // $(".chat-box").append($message_content);
        SubmitMessage(message,chatId,1,$src_stickers);
      }
      else
      {
          ShowErrorMessage();
      }
      
    });

    $('.input-hidden').click(function(){
      var img_id = $(this).data('img');
      $('.emoji-img').removeClass('selected');  
      $('#'+img_id+'').addClass('selected');  
    });



$(".chat-block").click(function(){
  let listtype = 0;
  let action = 'add';
  SendRequest(listtype,action);
});

$(".hideChat").click(function(){
          var chatId = {{ isset($chatId)? $chatId : 0 }};      
          $.ajax({
            type:'POST',
            url:base_url+"/hide/chat",
            data:{chatId:chatId},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message);   
              }
            }
          });
});

function SendRequest(listtype,action){
  let otherId = "{{ $user['id'] }}";          
          $.ajax({
            type:'POST',
            url:base_url+"/add/to/fav",
            data:{listType:listtype,otherId:otherId,"action":action,"from":"chat"},
            success:function(data){
              if(!data.success)
              {
                toastr.error(data.message);   
              }
              else
              {
                toastr.success(data.message);   
                // window.setTimeout(function() {
                //     location.reload();
                // }, 5000);
              }
            }
          });
}

</script>

<script>
socket.on("receive_message", function (jsonData) {
  $message_content = "";
  var otherUserName = "{{ strtolower($user['userName']) }}";
  if(jsonData.senderChatID == otherUserName)
  {

    
    var parentMessage = "";
    var endParentMessage = "";
    var style = "";
    if(jsonData.parent)
    {
      var parentMessageContent = jsonData.parentMessage;
      if(jsonData.parentType == 1)
      {
        var parentMessageContent = `<img  src="`+uploaded_url+`/`+jsonData.parentMessage+`" title="" width="100" height="100">`;
      } 
      if(jsonData.parentType == 2)
      {
        var parentMessageContent = `<img  src="`+uploaded_url+`/`+jsonData.parentMessage+`" title="" width="100" height="100">`;
      } 
      if(jsonData.parentType == 3)
      {
        var style = `style="width:300px"`;
        var parentMessageContent = `<audio controls style="width: 100%;">
                            <source src="`+uploaded_url+'/'+jsonData.parentMessage+`" type="audio/ogg">
                            <source src="`+uploaded_url+'/'+jsonData.parentMessage+`" type="audio/mpeg">
							<source src="`+uploaded_url+'/'+jsonData.parentMessage+`" type="audio/mp4">
                            Your browser does not support the audio element.
                            </audio>`;
      } 
      var parentMessage = `<span class="parent"> <span class="parent-message">`+parentMessageContent+`</span>`;
      var endParentMessage = `</span>`;
    }
   
      if(jsonData.type == 0)
      {
        $message_content = `<div class="chat-l d-flex">
                            <div class="sp"></div>
                      <div class="mess " `+style+`>
                    `+parentMessage+`<p>`+jsonData.content+`</p>`+endParentMessage+`
                    <div class="check">
                        <span>`+formatAMPM(new Date)+`</span>
                  </div></div></div>`;
                              
      }
      else if(jsonData.type == 1)
      {
        $message_content = `<div class="chat-l d-flex">
    <div class="sp"></div>
    <div class="mess " `+style+`>
      `+parentMessage+`<p><img  src="`+uploaded_url+`/`+jsonData.content+`" title="" width="100" height="100" class="sticker-message"></p>`+endParentMessage+`
                    <div class="check">
                        <span>`+formatAMPM(new Date)+`</span>
                    </div></div></div>`;
      }
      else if(jsonData.type == 2)
      {
        $message_content = `<div class="chat-l d-flex">
    <div class="sp"></div>
    <div class="mess " `+style+`>
      `+parentMessage+`<p><img  src="`+uploaded_url+'/'+jsonData.content+`" title="" width="100" height="100" class="sticker-message"></p>`+endParentMessage+`
                    <div class="check">
                        <span>`+formatAMPM(new Date)+`</span>
                    </div></div></div>`;
      }
      else if(jsonData.type == 3)
      {
        $message_content = `<div class="chat-l d-flex">
                            <div class="sp"></div>
                            <div class="mess " style="width:300px">
                              `+parentMessage+`           <p><audio controls style="width: 100%;">
                            <source src="`+uploaded_url+'/'+jsonData.content+`" type="audio/ogg">
                            <source src="`+uploaded_url+'/'+jsonData.content+`" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio></p>`+endParentMessage+`
                                        <div class="check">
                                          <span>`+formatAMPM(new Date)+`</span>
                                        </div></div></div>`;
      }
      $(".chat-box").append($message_content); 

      var socketMessage = JSON.stringify({'receiverChatID': otherUserName});
      socket.emit("confirm_readed", [socketMessage]);
      $("#available").text("متصل الآن");
      $("#available").css("color","green");
      $("#status-badge").css("background-color","green");
      updateScroll(); 

      
  }
});
socket.on("receive_typing", function (jsonData) {
    console.log("here");
    $("#available").text("متصل الآن");
    $("#type-record-message").text("يكتب الآن");
    setTimeout(function() {
      $("#type-record-message").text("");
    }, 3000);
    $("#available").css("color","green");
    $("#status-badge").css("background-color","green");
});
socket.on("receive_stop_typing", function (jsonData) {
    $("#available").text("متصل الآن");
    $("#type-record-message").text("");
    $("#available").css("color","green");
    $("#status-badge").css("background-color","green");
});
socket.on("receive_recording", function (jsonData) {
    $("#available").text("متصل الآن");
    $("#type-record-message").text("يسجل مقطع صوتي الآن");
    setTimeout(function() {
      $("#type-record-message").text("");
    }, 60000);
    $("#available").css("color","green");
    $("#status-badge").css("background-color","green");
    console.log("receive_recording");
});
socket.on("receive_stop_recording", function (jsonData) {
    $("#available").text("متصل الآن");
    $("#type-record-message").text("");
    $("#available").css("color","green");
    $("#status-badge").css("background-color","green");
});
socket.on("receive_confirm_readed", function (jsonData) {
    var oldSrc = "{{url('/')}}/front/imgs/arrow-old.png";
    var newSrc = "{{url('/')}}/front/imgs/arrow.png";
    $('img[src="' + oldSrc + '"]').attr('src', newSrc);
    $("#available").text("متصل الآن");
    $("#available").css("color","green");
    $("#status-badge").css("background-color","green");
});

$('#chatTxt').on('input', function() {
var otherUserName = "{{ strtolower($user['userName']) }}";
  var socketMessage = JSON.stringify({'receiverChatID': otherUserName});
  socket.emit("send_typing", [socketMessage]);
});

$('#chatTxt').keyup(function() {
  delay(function(){
    var otherUserName = "{{ strtolower($user['userName']) }}";
    var socketMessage = JSON.stringify({'receiverChatID': otherUserName});
    socket.emit("send_stop_typing", [socketMessage]);
  }, 1000 );
});
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();
</script>


<script>

  $(".chat-box").on( 'scroll', function(){
    if($(".chat-box").scrollTop() ==0 ){
          var page = $(".chat-box").data('page');
      var chatid = {{ $chatId }};
                          
        $.ajax({
            url: '{{ url("chat/load/more") }}',
            type: 'get',
            data: {page:page,chatid:chatid},
            success: function(response){
              $(".chat-box").prepend(response);
              page = page+1;
              $(".chat-box").data('page', page);
            }
        });
    }
  });  

  $("#ad-message").click(function(){
    $("#ad-message").hide();
  });  


  $("#chatTxt").keypress(function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
    
        $("#send-chat-message").click();
    }
  });
  
  </script>

<script src="{{url('/')}}/public/front/js/audio/recorder.js"></script>
<script src="{{url('/')}}/public/front/js/audio/timer.js"></script>
<script>

//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("audio-record");
var stopButton = document.getElementById("StopRecord");
var audio_file = "";
//var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
//pauseButton.addEventListener("click", pauseRecording);
var timer = $('.message-box .timer').timer();	

function startRecording() {
  var clicks = $("#audio-record").data('clicks');
  if(clicks > 0 )
  {
    stopRecording();
    return false;
  }
  $("#audio-record").data('clicks',1)
  
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	// pauseButton.disabled = false

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();
    
		//update the format 
		// document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})
		//start the recording process
		rec.record();

    $(".message-box-audio").hide();
		$("#audio-record").addClass('recording')
		$('div.message-box').show();
		$('textarea.message-box').hide();
		timer.clear();
		timer.start();
    CountDown();
    var otherUserName = "{{ strtolower($user['userName']) }}";
    var socketMessage = JSON.stringify({'receiverChatID': otherUserName});
    socket.emit("send_recording", [socketMessage]); 
	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	// pauseButton.disabled = true
	});
}

function CountDown() { 
  var count = 0, new_timer = setInterval(function() {
    count++;
    if(count == 59) stopRecording();
  }, 1000);
}

// function pauseRecording(){
// 	console.log("pauseButton clicked rec.recording=",rec.recording );
// 	if (rec.recording){
// 		//pause
// 		rec.stop();
// 		pauseButton.innerHTML="Resume";
// 	}else{
// 		//resume
// 		rec.record()
// 		pauseButton.innerHTML="Pause";

// 	}
// }

function stopRecording() {

  timer.stop();
  $("#audio-record").data('clicks',0)
  if(timer.duration >= 1)
  {

    $('#audio-record').removeClass('recording')
    $('div.message-box').hide();
    $('textarea.message-box').show();
    $(".message-box-stop").hide();
    $('div.message-box-audio').show();
    
    
    console.log('timer stopped', timer.duration);
    console.log("stopButton clicked");

    //disable the stop button, enable the record too allow for new recordings
    stopButton.disabled = true;
    recordButton.disabled = false;
    // pauseButton.disabled = true;

    // //reset button just in case the recording is stopped while paused
    // pauseButton.innerHTML="Pause";
    
    //tell the recorder to stop the recording
    rec.stop();

    //stop microphone access
    gumStream.getAudioTracks()[0].stop();

    //create the wav blob and pass it on to createDownloadLink
    rec.exportWAV(createDownloadLink);


  }
  else
  {
    $('#audio-record').removeClass('recording')
    $('div.message-box').hide();
    $('textarea.message-box').hide();
    $(".message-box-stop").hide();
    $('div.message-box-audio').hide();
    toastr.error("يجب ان يكون مدة الملف الصوتي اكبر من 0 . برجاء استمرار الضغط على علامة التسجيل"); 
  }
  

  var otherUserName = "{{ strtolower($user['userName']) }}";
  var socketMessage = JSON.stringify({'receiverChatID': otherUserName});
  socket.emit("send_stop_recording", [socketMessage]); 
}

function createDownloadLink(blob) {
	audio_file = blob
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');
  console.log(url,blob,au,link);
	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	// link.href = url;
	// link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	// link.innerHTML = "Save to disk";

	// //add the new audio element to li
	// li.appendChild(au);
	
	// //add the filename to the li
	// li.appendChild(document.createTextNode(filename+".wav "))

	// //add the save to disk link to li
	// li.appendChild(link);
  $("#url").val(url);
  $("#duration").val(timer[0].textContent);

	//upload link
	// var upload = document.createElement('a');
	// upload.href="#";
	// upload.innerHTML = "Upload";
	// upload.addEventListener("click", function(event){
	// 	  var xhr=new XMLHttpRequest();
	// 	  xhr.onload=function(e) {
	// 	      if(this.readyState === 4) {
	// 	          console.log("Server returned: ",e.target.responseText);
	// 	      }
	// 	  };
	// 	  var fd=new FormData();
	// 	  fd.append("audio_data",blob, filename);
	// 	  xhr.open("POST","upload.php",true);
	// 	  xhr.send(fd);
	// })
	// li.appendChild(document.createTextNode (" "))//add a space in between
	// li.appendChild(upload)//add the upload link to li

	//add the li element to the ol
	//recordingsList.appendChild(li);
}




function deleteAudio()
{
    var base64 = $("#base64").val("");
    var url = $("#url").val("");
    var duration = $("#duration").val("");
    $(".message-box-audio").hide();
}
//function sendAudioFile(base64,url,duration) {
function sendAudioFile() {
    // if(parseInt($("#duration").val()) > 0)
    // {
     
    $(".message-box-audio").hide();
    var base64 = $("#base64").val();
    var url = $("#url").val();
    var duration = $("#duration").val();
    $('div.message-box-text').show();
    var chatId = {{ isset($chatId)? $chatId : 0 }};     
    var currentdate = new Date(); 
    var datetime =  currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
    
          var fd = new FormData();
          fd.append('fname', 'test.wav');
          fd.append('data', audio_file);                           
          fd.append('chatId', chatId);                           
          fd.append('voiceTime', duration);                           
         $.ajax({
          type:'POST',
          url:base_url+"/chats/send/audio",
          // data:{base64:base64,"chatId":chatId,voiceTime:duration},
          data:fd,
          processData: false,
          contentType: false,
          success:function(data){
            $('div.message-box-text').hide();
            if(!data.success)
            {
              toastr.error(data.message);   
            }
            else
            {
              $message_content = `<div class="chat-r d-flex">
                                  <div class="mess mess-r" style="width: 300px;">
                                    <p><audio controls style="width: 100%;">
                        <source src="`+uploaded_url+`/`+data.chat_message+`" type="audio/ogg">
                        <source src="`+uploaded_url+`/`+data.chat_message+`" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio></p><span class="svg-icon svg-icon-primary svg-icon-2x delete-message" data-id="`+data.messageId+`" style="cursor:pointer"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36px" height="36px" viewBox="0 0 36 36" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="36" height="36"/>
        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <div class="check">
                                      <span>`+formatAMPM(new Date)+`</span>
                                    </div>
                                  </div>
                                  <div class="sp"></div>
                                </div>`;
              $(".chat-box").append($message_content); 
              updateScroll();           
              let audio_message = data.chat_message;
              SendSocket(audio_message,data.messageId,3,duration);      
            }
            //let audio_message = "{{Config::get('app.uploaded_url')}}/"+data.chat_message;
            
          }
        });
    // }
    // else 
    // {
    //   toastr.error("يجب ان يكون مدة الملف الصوتي اكبر من 0 . برجاء استمرار الضغط على علامة التسجيل"); 
    // }
    
}


//$(".delete-message").click(function(){
$(document).on('click','.chat-box .delete-message', function(){
      
	var id = $(this).data('id');
	Swal.fire({
              text: "هل تود حقاً حذف رسالتك  ؟",
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText:  'نعم',
			  icon: 'error',
              target: document.getElementById('rtl-container'),
              cancelButtonText: 'لا'
          }).then(function(result) {
            if (result.isConfirmed) {
              $.post( base_url+"/delete/chat/message", { id: id})
              .done(function( data ) {
                if(data.success){
                  toastr.success(data.message);   
                  location.reload();
                }
                else{
                  toastr.error(data.message);   
                }
				});
            }
			
          });
});

</script>



@endpush