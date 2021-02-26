$(document).ready(function(){

function setCookie(name,value) {

    document.cookie = name + "=" + (value || "") + "; ";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=;';  
}

	document.getElementById("log_in").onclick = function(){
		setCookie('ses','true');
	};

	
	var txtLog = document.getElementById("cng").textContent;
	if(txtLog=="Вход/Регистрация"){
		$(".fav-nav").magnificPopup();
		$(".reg2").magnificPopup();
		$(".reg3").magnificPopup();
	}

var is_session = getCookie('ses');


	if(is_session == 'true'){
		document.getElementById("cng").style.display="none";
		document.getElementById("logout").style.display="block";
		document.getElementById("cng").setAttribute("value","");
		document.getElementById("logout").setAttribute("value","true");

	}

		document.getElementById("logout").onclick = function(){
			document.getElementById("cng").style.display="block";
			document.getElementById("logout").style.display="none";
			document.getElementById("cng").setAttribute("value","true");
			document.getElementById("logout").setAttribute("value","");
			var del = eraseCookie('ses');

		};
		
	function checkLogin(e){
		if(is_session == 'true'){
			check = document.location.pathname;
			alert(check);
			if(check == "/product-details.php"){



				e.attr("href","");
			}else if(check == "/shop.html"){
				alert("afasf");
				id = e.value;
				e.attr("href","cart.html?prod=" + id +"&count=1");
			}
		}else{
			e.attr("href","#form-login");
		}
	}

			
	function checkLogin(e){
		var is_session = getCookie('ses');
		if(is_session == 'true'){
		}else{
			e.setAttribute("href", document.location.href);
			e.onclick = function(){
				alert("Чтобы добавить товар в корзину войдите пожалуйста в свою учетную запись.");
			};
		}
	}



});