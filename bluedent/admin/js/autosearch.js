function searchtext(){
if(window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
}
xmlhttp.onreadystatechange = function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("searchresult").innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open('GET','autosearch.php?search_text='+ document.search.keyword.value +'',true);
xmlhttp.send();
}
