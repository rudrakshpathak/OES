startTime();
$('#msg').click(hide_msg);
function hide_msg(){
	$('#msg').slideUp();
}
setTimeout(hide_msg,4000);
$('.show_questions_button').click(function(){
	id = $(this).attr('id');
	$('#question'+id).slideToggle();
});
function startTime() {
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	if(h>12) d = "PM";
	else d = "AM";
	h = setHourFormat(h);
	$('#show_time').html(h+":"+m+":"+s+" "+d);
	var t = setTimeout(startTime,500);
}
function setHourFormat(h){
	if(h>12) return h-12;
	else return h;
}
function checkTime(i) {
	if (i<10) {i = "0" + i};
	return i;
}
$('#role_buttons .radio_button').change(function(){
	role=$(this).val();
	if(role==1){
		$('#username').html("Username: ");
		$('#username_field').attr("placeholder","Enter your username");
	}else if(role==2){
		$('#username').html("ID card number: ");
		$('#username_field').attr("placeholder","Enter your Library card number");
	}else{
		$('#username').html("Roll number: ");
		$('#username_field').attr("placeholder","Enter your Roll number");
	}
	$('#username_field').focus();
});

showThat('.catBar');
showThat('.examBar');
showThat('.stuBar');
showThat('.one_question');

function showThat(thisClass){
	$(thisClass).click(function(){
		id = $(this).attr('id');
		$('#show'+id).slideToggle();
	});
}