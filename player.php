<!DOCTYPE html>
<html lang=en>
<head>
<meta charset="UTF-8">

<title>Simple Audio Player</title>
<script src="data.php"></script>
<script>

var audio;

function init(){
	console.log("init");

	audio = document.getElementById("audio");
	
	audio.addEventListener("abort", 		function () {	debug(arguments, "abort"); });
	audio.addEventListener("canplay", 		function () {	debug(arguments, "canplay"); });
	audio.addEventListener("canplaythrough", 	function () {	debug(arguments, "canplaythrough"); });
	audio.addEventListener("durationchange", 	function () {	debug(arguments, "durationchange"); });
	audio.addEventListener("emptied", 		function () {	debug(arguments, "emptied"); });
	audio.addEventListener("ended", 		function () {	debug(arguments, "ended"); });
	audio.addEventListener("error", 		function () {	debug(arguments, "error"); });
	audio.addEventListener("loadeddata", 		function () {	debug(arguments, "loadeddata"); });
	audio.addEventListener("loadedmetadata", 	function () {	debug(arguments, "loadedmetadata"); });
	audio.addEventListener("loadstart", 		function () {	debug(arguments, "loadstart"); });
	audio.addEventListener("pause", 		function () {	debug(arguments, "pause"); });
	audio.addEventListener("play", 			function () {	debug(arguments, "play"); });
	audio.addEventListener("playing", 		function () {	debug(arguments, "playing"); });
	audio.addEventListener("progress", 		function () {	debug(arguments, "progress"); });
	audio.addEventListener("ratechange", 		function () {	debug(arguments, "ratechange"); });
	audio.addEventListener("readystatechange", 	function () {	debug(arguments, "readystatechange"); });
	audio.addEventListener("seeked", 		function () {	debug(arguments, "seeked"); });
	audio.addEventListener("seeking", 		function () {	debug(arguments, "seeking"); });
	audio.addEventListener("stalled", 		function () {	debug(arguments, "stalled"); });
	audio.addEventListener("suspend", 		function () {	debug(arguments, "suspend"); });
	audio.addEventListener("volumechange", 		function () {	debug(arguments, "volumechange"); });
	audio.addEventListener("waiting", 		function () {	debug(arguments, "waiting"); });

	audio.addEventListener("timeupdate", 		function () {	update(arguments); });

}

function update(){
	var status = document.getElementById("status");
	status.innerHTML = audio.currentTime + "<br />";
	for (var i=0; i<timeline.length; i++){
		
	}
}

function time2secs(t){
	var arr = t.split(":");
	var secs = (arr[0]*3600) + (arr[1]*60) + (arr[2]);
	return Number(secs) + Number(timeline.offset);
}

function debug(args,msg){
	var t = "";
	for (var o in args[0]){
		t += o + " " + args[0][o];
	}
	
	console.log(args.length + " - " + msg);
}

timeline.offset = 50;

function seekTo(t){
	var time = time2secs(t);
	audio.currentTime = time;
	audio.pause();
	audio.play();
}

</script>

<body onload="init()">



<div>
	<audio controls id="audio">
		<source type="audio/mp3" preload="metadata" src="audio/Practical_Demonkeeping_Ch01.mp3"/>
		Your browser does not support HTML5 audio.
	</audio>
</div>

<div id="status"></div>

<?php include("epub.php"); ?>

<script>
	var pArr = document.getElementsByTagName("p");
	for (var i=0; i<pArr.length;i++){
		var but = document.createElement("button");
		var txt = document.createTextNode(timeline[i].start);
		but.appendChild(txt);
		but.onclick = function(){seekTo(this.firstChild.nodeValue);};
		pArr[i].insertBefore(but,pArr[i].firstChild);
	}

</script>

</body>

</html>
