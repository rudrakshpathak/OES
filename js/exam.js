tt = $.cookie('time');
function startTime(){
	thisTime = Math.floor(Date.now()/1000);
	t = tt-thisTime;
	if(t==0) window.location.assign('back/timeover.php');
	var m=getM(t);
	var s=getS(t);
	m = checkTime(m);
	s = checkTime(s);
	$('#countdown').html(m+":"+s);
	var t = setTimeout(function(){startTime()},500);
}
$(document).keyup(function(e) {
	if(e.keyCode==65||e.keyCode==49||e.keyCode==97){ $('#question_form #option1').prop("checked", true);}
	else if(e.keyCode==66||e.keyCode==50||e.keyCode==98) $('#question_form #option2').prop("checked", true);
	else if(e.keyCode==67||e.keyCode==51||e.keyCode==99) $('#question_form #option3').prop("checked", true);
	else if(e.keyCode==68||e.keyCode==52||e.keyCode==100) $('#question_form #option4').prop("checked", true);
	if((e.keyCode>64&&e.keyCode<69)||(e.keyCode>48&&e.keyCode<53)||(e.keyCode>96&&e.keyCode<101)) $('#question_form').submit();
	//alert(e.keyCode);
});
function getM(t){
	var m = t/60;
	if(m>0) return Math.floor(m);
	else return 0;
}
function getS(t){
	var s = t%60;
	if(s>0) return Math.floor(s);
	else return 0;
}
function checkTime(i){
	if (i<10) {i = "0" + i};
	return i;
}
startTime();


