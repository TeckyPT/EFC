$('ul li').on('click', function() {
	$('li').removeClass('active');
	$(this).addClass('active');
});


var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10){
		dd='0'+dd
	} 
	if(mm<10){
		mm='0'+mm
	} 
today = yyyy+'-'+mm+'-'+dd;


var checkin = document.getElementById('checkin');
var reserv = document.getElementsByClassName('btnreserv');

var checkout = document.querySelectorAll("[id='checkout']");
var elms = document.querySelectorAll("[id='checkin']");

var btn = document.querySelectorAll("[id='btn']");



for(var i = 0; i < elms.length; i++) 
  elms[i].setAttribute("min", today);

function getVal() {
	for(var i = 0; i < checkout.length; i++) 
 	 checkout[i].setAttribute("min", elms[i].value); 
}








