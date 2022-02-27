function validateStock(stockpid, stockamt){
	if(stockamt == ''){
		document.getElementById('qalert' + stockpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity is required";
	}
	else if(isNaN(stockamt)){
		document.getElementById('qalert' + stockpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity can only be a number";
	}
	else if(stockamt%1 != 0){
		document.getElementById('qalert' + stockpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity cannot be decimal";
	}
	else if(stockamt < 1 || stockamt > 500){
		document.getElementById('qalert' + stockpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity should be 1 to 500";
	}
	else{
		document.getElementById('qalert' + stockpid).innerHTML = "";
		updateStock(stockpid, stockamt);
	}
}

//Load Cart

function updateStock(stockpid, stockamt){
var xmlhttp;
if (window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("qalert" + stockpid).innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("POST", "updatestock.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("stockpid=" + stockpid + "&" + "stockamt=" + stockamt);
}