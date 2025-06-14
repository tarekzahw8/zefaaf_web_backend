
@push('style')
<style>

#available{
    float: right;
}

#type-record-message
{
    margin-right: 50px;
}
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

.recording {
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

.onair {
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