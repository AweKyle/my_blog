function f()
{
	var form = document.getElementById("checkForm")
	document.forms["checkForm"].submit();
}
function check()
{
	if (confirm("Подтвердить корректность списка?"))
	{
		window.onload = f();
	}
	else
	{
		document.getElementById('stat').value = "false";
		window.onload = f();
	}	
}
function AjaxFormRequest(result_id,form_id,url, type) 
{
	jQuery.ajax({ 
	    url:     url, //Адрес подгружаемой страницы 
	    type:     type, //Тип запроса 
	    dataType: "html", //Тип данных 
	    data: jQuery("#"+form_id).serialize(),  
	    success: function(response) { //Если все нормально 
	    	document.getElementById(result_id).innerHTML = response; 
		}, 
		error: function(response) { //Если ошибка
			alert(response.responseText) 
			document.getElementById(result_id).innerHTML = "Ошибка при отправке формы"; 
		} 
	}); 
}