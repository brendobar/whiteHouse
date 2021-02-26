$(document).ready(function(){

function $_GET(key) {
var s = window.location.search;
s = s.match(new RegExp(key + '=([^&=]+)'));
return s ? s[1] : false;
}

$(function(){
        $('#viewProduct').change(function(){
        	link = document.location.href;
        	strGET = window.location.search.replace( '?', '');
        	limit_old = $_GET('limit');
        	if(strGET==""){
        		limit =link + "?" + $('#viewProduct :selected').val();
        	} else{
				min = "&limit="+limit_old;
	        	link = link.split(min).join('');
	        	limit =link + $('#viewProduct :selected').val();
        	}
			history.pushState({}, '', limit);
			location.reload();
    })
});
$(function(){
        $('#sortByPrice').change(function(){
        	link = document.location.href;
        	strGET = window.location.search.replace( '?', '');
        	limit_old = $_GET('price');
        	if(strGET==""){
        		limit =link + "?" + $('#sortByPrice :selected').val();
        	} else{
				min = "&price="+limit_old;
	        	link = link.split(min).join('');
	        	limit =link + $('#sortByPrice :selected').val();
        	}
			history.pushState({}, '', limit);
			location.reload();
    })
});




$(function(){
	$("#filter").hover(function(){
		link = document.location.href;
		strGET = window.location.search.replace( '?', '');
        min_old = $_GET('min');
        max_old = $_GET('max');
        price = $('#price').text();		
        temp = price.split(" ");
		min = temp[1];
		max = temp[3];
		get = "&min=" + min + "&max=" + max;
        if(strGET!=""){
        	m = "&min=" + min_old + "&max=" + max_old;
	        link = link.split(m).join('');
	        link += get;
        }else{
        	link += "?" + get;
        }

		$("#filter").attr("href", link)
	})
});
function filter(id){
	$("#"+id+"").hover(function(){
		link = document.location.href;
		strGET = window.location.search.replace( '?', '');
        filter_old = $_GET('filter');
        get = "&filter=" + id;
        if(strGET!=""){
        	m = "&filter=" + filter_old;
	        link = link.split(m).join('');
	        link += get;
        }else{
        	link += "?" + get;
        }

		$("#"+id+"").attr("href", link)
	});
}
	
$(function(){
	filter("all");
	filter("Phone");
	filter("TV");
    filter("Smart");
});



var sonic = require('@amperka/ultrasonic').connect({trigPin: P10, echoPin: P11});                   //дальнометр
var buzzer = require('@amperka/buzzer').connect(P5).frequency(440);                                   //зуммер



        switch (true) {
          case (val<5):
            buzzer.turnOn();
            break;
          case (val<20):
            buzzer.beep(0.1, 0.1);
            break;
          case (val<50):
            buzzer.beep(0.2, 0.2);
            break;
          default:
            buzzer.turnOff();
        }


setInterval(function() {                 
    sonic.ping(function(err, val) {    
        switch (true) {
          case (val<5):
            buzzer.turnOn();
            break;
          case (val<20):
            buzzer.beep(0.1, 0.1);
            break;
          case (val<50):
            buzzer.beep(0.2, 0.2);
            break;
          default:
            buzzer.turnOff();
        }
    }, 'cm');
}, 100);


});