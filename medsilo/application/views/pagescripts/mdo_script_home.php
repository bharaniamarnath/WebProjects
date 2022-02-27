<script>
var divs = $('div[id^="carousel-"]').hide(),
i = 0;
(function cycle() { 
divs.eq(i).show(0)
.delay(5000)
.hide(0, cycle);
i = ++i % divs.length;
})();
</script>
<script type="text/javascript">
tday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
function GetClock(){
d = new Date();
dx = d.toGMTString();
dx = dx.substr(0,dx.length -3);
d.setTime(Date.parse(dx))
d.setSeconds(d.getSeconds() + <?php date_default_timezone_set('Asia/Calcutta'); echo date('Z'); ?>);
nday   = d.getDay();
nmonth = d.getMonth();
ndate  = d.getDate();
nyear = d.getYear();
nhour  = d.getHours();
nmin   = d.getMinutes();

// If holiday, comment out below line and comment in conditional holidays script
// document.getElementById('availability').innerHTML="Closed";

// Conditional Holidays Block

if(tday[nday] == "Sunday"){
document.getElementById('availability').innerHTML="Closed";
}
else if(nhour < 9){
document.getElementById('availability').innerHTML="Closed";
}
else if(nhour >= 18){
document.getElementById('availability').innerHTML="Closed";
}
else{
document.getElementById('availability').innerHTML="Opened";
}

// Conditional Holidays End

if(nyear<1000) nyear=nyear+1900;
if(nhour ==  0) {ap = " AM";nhour = 12;} 
else if(nhour <= 11) {ap = " AM";} 
else if(nhour == 12) {ap = " PM";} 
else if(nhour >= 13) {ap = " PM";nhour -= 12;}
if(nmin <= 9) {nmin = "0" +nmin;}
document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+"<br /><p class='time pt-2 mb-0'>"+nhour+":"+nmin+ap+" IST</p>";
setTimeout("GetClock()", 1000);
}
window.onload=GetClock;
</script>