function searchtext(){
var kw = document.search.keyword.value;
if(kw == ""){
$(".autosearch").hide();
}
else{
if(window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
}
xmlhttp.onreadystatechange = function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("searchresult").innerHTML = xmlhttp.responseText;
$(".autosearch").show();
}
}
xmlhttp.open('GET','autosearch.php?search_text='+ document.search.keyword.value +'',true);
xmlhttp.send();
}
}
