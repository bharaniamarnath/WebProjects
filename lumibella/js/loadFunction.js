
//Load Product Rate

function loadRate(prate, prid, prtot, prcnt){
var xmlhttp;
if (window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("rateRes").innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("POST", "addrate.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("prate=" + prate + "&" + "prid=" + prid + "&" + "prtot=" + prtot + "&" + "prcnt=" + prcnt);
}

//Validate Cart

function validateCart(cpid, cqnty, cpstock){
	if(cqnty == ''){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity is required";
		document.getElementById('fbtn' + cpid).disabled = false;
	}
	if(isNaN(cqnty)){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity can only be a number";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	if(cqnty%1 != 0){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity cannot be decimal";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	if(cqnty < 1 || cqnty > 10){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity should be 1 to 10";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	if(cqnty > cpstock){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity limit exceeded";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	else{
		document.getElementById('qalert' + cpid).innerHTML = "";
		loadCart(cpid, cqnty);
	}
}

//Load Cart

function loadCart(cpid, cqnty){
var xmlhttp;
if (window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("qalert" + cpid).innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("POST", "addcart.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("cpid=" + cpid + "&" + "cqnty=" + cqnty);
}

//Validate update cart

function validateUpdateCart(cpid, cqnty, cpstock){
	if(cqnty == ''){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity is required";
		document.getElementById('fbtn' + cpid).disabled = false;
	}
	if(isNaN(cqnty)){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity can only be a number";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	if(cqnty%1 != 0){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity cannot be decimal";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	if(cqnty < 1 || cqnty > 10){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity should be 1 to 10";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	if(cqnty > cpstock){
		document.getElementById('qalert' + cpid).innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span> Quantity limit exceeded";
		document.getElementById('fbtn' + cpid).disabled = false;
		document.getElementById('qnty' + cpid).disabled = false;
	}
	else{
		document.getElementById('qalert' + cpid).innerHTML = "";
		loadUpdateCart(cpid, cqnty);
	}
}

//Load Update cart

function loadUpdateCart(cpid, cqnty){
var xmlhttp;
if (window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("qalert" + cpid).innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("POST", "updatecart.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("cpid=" + cpid + "&" + "cqnty=" + cqnty);
}