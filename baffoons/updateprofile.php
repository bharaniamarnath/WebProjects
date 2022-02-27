<?php
session_start();
include('includes/connect.php');
include('includes/class.profile.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
?>
<?php
if(isset($_POST['update'])){
if(empty($_POST['firstname'])){
echo $pfnamealert;
exit();
}
elseif(preg_match('/[^0-9A-Z.!`&\'-]/i',$_POST['firstname'])){
echo $invalidpfname;
exit();
}
if(empty($_POST['lastname'])){
echo $plnamealert;
exit();
}
elseif(preg_match('/[^0-9A-Z.!`&\'-]/i',$_POST['lastname'])){
echo $invalidplname;
exit();
}
if(strlen($_POST['contact'])<10){
echo $contactalert;
exit();
}	 
if(empty($_POST['country'])){
echo $countryalert;
exit();
}
if(empty($_POST['lang1']) || empty($_POST['lang2']) || empty($_POST['olang'])){
echo $emptylangalert;
exit();
}
if(strlen($_POST['about'])>150){
echo $aboutalert;
exit();
}
$profile = new profile();
$profile->setUserSession($_SESSION['user']);
$profile->setFirstName($_POST['firstname']);
$profile->setLastName($_POST['lastname']);
$profile->setOccupation($_POST['occupation']);
$profile->setContact($_POST['contact']);
$profile->setCity($_POST['city']);
$profile->setCountry($_POST['country']);
$profile->setSchool($_POST['school']);
$profile->setWork($_POST['work']);
$l1 = $_POST['lang1'];
$l2 = $_POST['lang2'];
$l3 = $_POST['olang'];
$profile->setLanguage($l1 . ', ' . $l2 . ', ' . $l3);
$profile->setMarital($_POST['marital']);
$profile->setAbout($_POST['about']);
$profile->UpdateProfile();
}
?>
<?php
$result = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$result->execute(array('UserID'=>$suid));
while($row = $result->fetch())
{
$usrid = $row['UserID'];
$usrnme = $row['Username'];
$fnme = $row['Firstname'];
$lnme = $row['Lastname'];
$gen = $row['Gender'];
$ml = $row['Email'];
$db = $row['Dob'];
$ag = floor( (strtotime(date('Y-m-d')) - strtotime($db)) / 31556926);
}
$proresult = $pdo->prepare("SELECT * FROM personaldetails WHERE UserID=:UserID");
$proresult->execute(array('UserID'=>$suid));
while($prow = $proresult->fetch())
{
$occ = $prow['Occupation'];
$cont = $prow['Contact'];
$city = $prow['City'];
$cntry = $prow['Country'];
$schl = $prow['School'];
$wrk = $prow['Work'];
$lang = $prow['Language'];
$marit = $prow['Marital'];
$abtme = $prow['About'];	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php include('includes/header.php'); ?>

<div class="col-md-3">
<div class="row panel-board"><div class="col-md-4"><?php echo "<a href='profile.php'><img src='$thumbloc' class='img-responsive'></a>"; ?></div><div class="col-md-8"><h5><?php echo $fname . ' ' . $lname; ?><br /><small><?php echo $usrnme; ?><br /><?php echo $mail; ?></small></h5></div></div>
<div class="row">
<div class="col-md-12">
<div class="list-group">
<a class="list-group-item" href="main.php"><span class='glyphicon glyphicon-home'></span> Home</a>
<a class="list-group-item active" href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a>
<a class="list-group-item" href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a>
<a class="list-group-item" href="photos.php"><span class='glyphicon glyphicon-picture'></span> Photos</a>
<a class="list-group-item" href="inbox.php"><span class='glyphicon glyphicon-envelope'></span> Messages</a>
<a class="list-group-item" href="groups.php"><span class='glyphicon glyphicon-th'></span> Groups</a>
<a class="list-group-item" href="account.php"><span class='glyphicon glyphicon-lock'></span> Account</a>
</div>
</div>
</div>		
</div>

<div class="col-md-6">
<div class="row">
<div class="col-md-12">
<ul class="nav nav-pills nav-justified">
<li class="active"><a href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a></li>
<li><a href="calendar.php"><span class='glyphicon glyphicon-calendar'></span> calendar</a></li>
<li><a href="activities.php"><span class='glyphicon glyphicon-th-large'></span> Activities</a></li>
<li><a href="addevent.php"><span class='glyphicon glyphicon-star'></span> Event</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-user'></span> Profile Update</h3>
<form action="updateprofile.php" method="POST">

<div class="form-group"><label for=" ">First name:</label><input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $fnme; ?>" /></div>	
	
<div class="form-group"><label for=" ">Last name:</label><input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $lnme; ?>" /></div>

<div class="form-group"><label for=" ">Occupation:</label><select class="form-control" name="occupation">
<option  value="<?php echo $occ; ?>"><?php echo $occ; ?></option>
<option value="Student">Student</option>
<option value="Lecturer">Lecturer</option>
<option value="Engineer">Engineer</option>
<option value="Doctor">Doctor</option>
<option value="Advocate">Advocate</option>
<option value="Business">Business</option>
<option value="Sports">Sports</option>
<option value="Entertainer">Entertainer</option>
<option value="Media">Media</option>
<option value="Unemployed">Unemployed</option>
</select>
</div>

<div class="form-group"><label for=" ">Contact:</label><input class="form-control" class="form-control" type="text" name="contact" id="contact" value="<?php echo $cont; ?>" /></div>

<div class="form-group"><label for=" ">Location:</label><input class="form-control" type="text" name="city" id="city" value="<?php echo $city; ?>" /></div>

<div class="form-group"><label for=" ">Country:</label>
<select class="form-control" name="country">
<option value="<?php echo $cntry; ?>"><?php echo $cntry; ?></option>
<option value="Afganistan">Afghanistan</option>
<option value="Argentina">Argentina</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Bhutan">Bhutan</option>
<option value="Brazil">Brazil</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Cambodia">Cambodia</option>
<option value="Canada">Canada</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Colombia">Colombia</option>
<option value="Cuba">Cuba</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lebanon">Lebanon</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mauritius">Mauritius</option>
<option value="Mexico">Mexico</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Morocco">Morocco</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="New Zealand">New Zealand</option>
<option value="Nigeria">Nigeria</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Qatar">Qatar</option>
<option value="Serbia">Serbia</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vatican City">Vatican City</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
tion value="Wake Island">Wake Island</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select></div>

<div class="form-group"><label for=" ">School:</label><input class="form-control" type="text" name="school" id="school" value="<?php echo $schl; ?>" /></div>

<div class="form-group"><label for=" ">Work Place:</label><input class="form-control" type="text" name="work" id="work" value="<?php echo $wrk; ?>" /></div>

<div class="form-group"><label for=" ">Languages: </label>
<select class="form-control" name="lang1">
<option value=""></option>
<option value="English">English</option>
<option value="French">French</option>
<option value="Japanese">Japanese</option>
<option value="Arabic">Arabic</option>
<option value="Russian">Russian</option>
<option value="German">German</option>
<option value="Filipino">Filipino</option>
<option value="Italian">Italian</option>
<option value="Greek">Greek</option>
<option value="Spanish">Spanish</option>
<option value="Hindi">Hindi</option>
<option value="African">African</option>
</select>
<br />
<select class="form-control" name="lang2">
<option value=""></option>
<option value="English">English</option>
<option value="French">French</option>
<option value="Japanese">Japanese</option>
<option value="Arabic">Arabic</option>
<option value="Russian">Russian</option>
<option value="German">German</option>
<option value="Filipino">Filipino</option>
<option value="Italian">Italian</option>
<option value="Greek">Greek</option>
<option value="Spanish">Spanish</option>
<option value="Hindi">Hindi</option>
<option value="African">African</option>
</select>
</div>	

<div class="form-group"><label for=" ">Other Languages: </label><input class="form-control" type="text" name="olang" id="olang" /></div>

<div class="form-group"><label for=" ">Marital Status: </label>
<select class="form-control" name="marital">
<option value="<?php echo $marit; ?>"><?php echo $marit; ?></option>
<option value="Single">Single</option>
<option value="Married">Married</option>
<option value="Divorced">Divorced</option>
</select></div>

<div class="form-group"><label for=" ">About Me: </label><br /><textarea class="form-control" name="about" id="about" rows="5" cols="30"><?php echo $abtme; ?></textarea></div>
	
<input type="submit" class="btn btn-success btn-lg pull-right" name="update" id="update" value="Update" />
</form>

</div>
</div>
</div>

<div class="row footer">
<div class="col-md-12">
<a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a>
<br />
&copy;Copyrights 2013. Baffoons Network.
</div>
</div>

</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
