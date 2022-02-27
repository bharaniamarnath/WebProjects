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
<?php
$dbalert = "<div class='alert alert-warning'>Error connecting to the database.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$fieldalert = "<div class='alert alert-warning'>All fields are required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$fnamealert = "<div class='alert alert-warning'>Firstname is required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$lnamealert = "<div class='alert alert-warning'>Lastname is required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$genderalert = "<div class='alert alert-warning'>Gender is not specified. Specify either 'Male' or 'Female'.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>"; 
$emptylangalert = "<div class='alert alert-warning'>Languages not specified. Specify atleast two languages.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$proupdfailalert = "<div class='alert alert-warning'>Could not update profile. Try again later.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$invalidurlalert = "<div class='alert alert-warning'>Invalid youtube link. Try again with a valid youtube URL.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$reportfailalert = "<div class='alert alert-warning'>Could not send report. Try again later.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$reportconalert = "<div class='alert alert-success'>Report sent successfully. Action on the post will be taken soon.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$favupdfailalert = "<div class='alert alert-warning'>Could not update profile favorites. Try again later.</div><input type='button' class='btn btn-primary pull-right' onClick='profile.php' value='Back'></input>";
$invalidpassalert = "<div class='alert alert-warning'>Password is invalid. Does not match to the account. Try again.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$invalidsettingaccess = "<div class='alert alert-warning'>Access Denied. Failed to authenticate the page.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$grouppostalert = "<div class='alert alert-warning'>The message cannot be posted empty. </div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>"; 
$gpostalert = "<div class='alert alert-success'>Message posted to the group. </div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>"; 
$delgrouppostalert = "<div class='alert alert-success'>Message deleted from the group. </div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>"; 
$gpostfailalert = "<div class='alert alert-warning'>Could not post message to the group. </div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$dobdalert = "<div class='alert alert-warning'>Date is not specified in 'Date of Birth' field.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$dobmalert = "<div class='alert alert-warning'>Month is not specified in 'Date of Birth' field.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$dobyalert = "<div class='alert alert-warning'>Year is not specified in 'Date of Birth' field.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$unamealert = "<div class='alert alert-warning'>Username is required.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$unamecountalert = "<div class='alert alert-warning'>Username should not be more than 15 characters.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$passalert = "<div class='alert alert-warning'>Password is required.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$passcountalert = "<div class='alert alert-warning'>Password should not be more than 15 characters.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$mailidalert = "<div class='alert alert-warning'>Email ID is required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$invalidfname = "<div class='alert alert-warning'>Invalid First Name. Name cannot contain Numbers or Invalid/Special characters.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$invalidlname = "<div class='alert alert-warning'>Invalid Last Name. Name cannot contain Numbers or Invalid/Special characters.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$wrongdelpassalert = "<div class='alert alert-warning'>Wrong or invalid account password.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='account.php' value='Back'></input>";
$delaccpassalert = "<div class='alert alert-warning'>Password is required</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='account.php' value='Back'></input>";
$unameexistalert = "<div class='alert alert-warning'>Username already exists. Try a different username.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$passconfalert = "<div class='alert alert-warning'>Password and Confirm Password did not match. Retype the fields correctly.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$invalidemail = "<div class='alert alert-warning'>Invalid E-mail ID format. Enter a valid address.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$emlexistalert = "<div class='alert alert-warning'>Email ID already registered or taken by another user. Try a different Email ID.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$regerroralert = "<div class='alert alert-danger'>Error in database. Registration failed.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$regconfalert = "<div class='alert alert-success'>Registration Success. Sign into the account now.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$mailreadalert = "<div class='alert alert-success'>Mails marked as read</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='inbox.php' value='Back'></input>";
$accdeletealert = "<div class='alert alert-success'>Account deleted. Thank you. Baffoons will miss you.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Index'></input>";
$accdeletefailalert = "<div class='alert alert-danger'>Could not delete the account. Try again later.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$mailreadfalert = "<div class='alert alert-danger'>Could not mark mails as read. Try again later.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='inbox.php' value='Back'></input>";
$logerroralert = "<div class='alert alert-danger'>Login Failed. Invalid username and password. Try again.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$wrongpassalert = "<div class='alert alert-danger'>Wrong old account password. Try again.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$logemptyalert = "<div class='alert alert-danger'>Login Failed. Enter a valid username and password. Try again.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$logdenyalert = "<div class='alert alert-warning'>Access Denied. User not logged in.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$logoutalert = "<div class='alert alert-success'>User logged out.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$useridalert = "<div class='alert alert-warning'>User ID is required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='resetpass.php' value='Back'></input>";
$noidexistalert = "<div class='alert alert-danger'>User ID is invalid. Try again.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='resetpass.php' value='Back'></input>";
$newpassalert = "<div class='alert alert-warning'>New Password and Confirm New Password does not match.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='newpass.php' value='Back'></input>";
$newpwfailalert = "<div class='alert alert-danger'>Password update failed.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='resetpass.php' value='Back'></input>";
$nwpwconfalert = "<div class='alert alert-success'>Password updated. Sign into the account using new password.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='index.php' value='Back'></input>";
$emptypassalert = "<div class='alert alert-warning'>Password and confirm password both are required. </div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='newpass.php' value='Back'></input>";
$unamefailalert = "<div class='alert alert-warning'>Invalid username or username does not exist.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='newpass.php' value='Back'></input>";
$imagealert = "<div class='alert alert-warning'>Select an image file to upload.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='imageupload.php' value='Back'></input>";
$imageulalert = "<div class='alert alert-success'>Profile image uploaded and updated.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$countryalert = "<div class='alert alert-warning'>Country is not specified. Select a country.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$contactalert = "<div class='alert alert-warning'>Invalid contact number. Enter a valid 10 digit contact number.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$aboutalert = "<div class='alert alert-warning'>'About Me' field can contain only 150 characters or below. Describe shortly.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$favcharalert = "<div class='alert alert-warning'>Each fields in the favorites can contain only 1024 characters or below. Describe shortly.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='favorites.php' value='Back'></input>";
$proupderralert = "<div class='alert alert-warning'>Profile update failed</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$proupdconalert = "<div class='alert alert-success'>Profile updated. Check the profile.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='profile.php' value='Back'></input>";
$favupdconalert = "<div class='alert alert-success'>Profile favorites updated. Check the profile.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='profile.php' value='Back'></input>";
$accupdconalert = "<div class='alert alert-success'>Account updated. </div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$accupdfailalert = "<div class='alert alert-warning'>Account update failed. Try again later</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$invalidpfname = "<div class='alert alert-warning'>Invalid First Name. Name cannot contain Numbers or Invalid/Special characters.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$invalidplname = "<div class='alert alert-warning'>Invalid Last Name. Name cannot contain Numbers or Invalid/Special characters.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$pfnamealert = "<div class='alert alert-warning'>Firstname is required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$plnamealert = "<div class='alert alert-warning'>Lastname is required.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='updateprofile.php' value='Back'></input>";
$posterralert = "<div class='alert alert-warning'>Post message can contain only 100 characters.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$msgerralert = "<div class='alert alert-warning'>Error in posting message. Try again.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$delpostalert = "<div class='alert alert-warning'>Error in deleting posting message.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$frndaddalert = "<div class='alert alert-success'>Friend added to the profile.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friends.php' value='Back'></input>";
$frndfailalert = "<div class='alert alert-warning'>Error in adding friend.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friends.php' value='Back'></input>";
$frndexstalert = "<div class='alert alert-warning'>The user is already a friend.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friends.php' value='Back'></input>";
$nofrndsalert = "<div class='alert alert-warning'>No friends added yet. Find people.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='people.php' value='Find People'></input>";
$deldenyalert = "<div class='alert alert-warning'>Cannot delete post. Only posted user can delete it.</div><input type='button' class='btn btn-primary pull-right' onClick='history.go(-1)' value='Back'></input>";
$emptygrpalert = "<div class='alert alert-warning'>Not a member in any group. Join groups.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='allgroups.php' value='View Groups'></input>";
$photoulalert = "<div class='alert alert-success'>Photo uploaded. Check the album.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='photos.php' value='View Album'></input>";
$groupalert = "<div class='alert alert-success'>Group Created. Check the groups page.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='allgroups.php' value='View Groups'></input>";
$groupjoinalert = "<div class='alert alert-success'>Joined the group. Check the groups page.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='groups.php' value='View Groups'></input>";
$groupunjoinalert = "<div class='alert alert-success'>Unjoined the group. Check the groups page.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='groups.php' value='View Groups'></input>";
$groupunjoinfailalert = "<div class='alert alert-warning'>Could not unjoin the group. Check the groups page.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='groups.php' value='View Groups'></input>";
$groupjoinfailalert = "<div class='alert alert-warning'>Could not join the group. Check the groups page.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='allgroups.php' value='View Groups'></input>";
$photoalert = "<div class='alert alert-danger'>Photo upload failed. Check if file and description is valid.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='uploadphotos.php' value='Back'></input>";
$groupfailalert = "<div class='alert alert-danger'>Failed to create group.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='creategroup.php' value='Back'></input>";
$delpicalert = "<div class='alert alert-danger'>Photo could not be deleted.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='photos.php' value='Back'></input>";
$photoupdalert = "<div class='alert alert-success'>Photo updated. View the album.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='photos.php' value='Back'></input>";
$photoupdfalert = "<div class='alert alert-danger'>Photo update failed.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='photos.php' value='Back'></input>";
$puphotoulalert = "<div class='alert alert-success'>Photo uploaded to public album. Check the album.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='publicphotos.php' value='View Album'></input>";
$commentalert = "<div class='alert alert-success'>Comment added to the photo. View photo.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input><br />";
$commfailalert = "<div class='alert alert-danger'>Failed adding comment to the photo.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='publicphotos.php' value='Back'></input>";
$commdelalert = "<div class='alert alert-success'>Comment deleted from the photo. Go back to photos.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='publicphotos.php' value='Back'></input>";
$commdelfalert = "<div class='alert alert-danger'>Comment could not be deleted from the photo. Go back to photos.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='publicphotos.php' value='Back'></input>";
$commdelerralert = "<div class='alert alert-warning'>Comment could not be deleted from the photo. Only comment posted user can delete it.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='publicphotos.php' value='Back'></input>";
$votealert = "<div class='alert alert-warning'>Already voted for the photo.</div><input type='button' class='btn btn-primary pull-right' onClick='history.back()' value='Back'></input>";
$pbdelpicalert = "<div class='alert alert-danger'>Photo cannot be deleted. Only posted user can delete the photo.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='publicphotos.php' value='Back'></input>";
$emptytoalert = "<div class='alert alert-warning'>To/Reciever's username field is empty. Enter a username to send the message.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='composemail.php' value='Back'></input>";
$mailsentalert = "<div class='alert alert-success'>Mail sent to the reciever successfully.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='inbox.php' value='Back'></input>";
$mailfalert = "<div class='alert alert-danger'>Mail sending failed. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='composemail.php' value='Back'></input>";
$nophotosalert = "<div class='alert alert-warning'>No photos added yet. Add photos.</div>";
$maildelalert = "<div class='alert alert-success'>Message deleted from inbox. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='inbox.php' value='Back'></input>";
$allmaildelalert = "<div class='alert alert-success'>Messages deleted from inbox. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='inbox.php' value='Back'></input>";
$maildelfalert = "<div class='alert alert-danger'>Message could not be deleted. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='inbox.php' value='Back'></input>";
$emptyinboxalert = "<div class='alert alert-warning'>No messages found. </div>";
$frnddelalert = "<div class='alert alert-success'>User removed from friend list. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friends.php' value='Back'></input>";
$errdelfralert = "<div class='alert alert-danger'>Error removing user from friend list. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friends.php' value='Back'></input>";
$fbacksentalert = "<div class='alert alert-success'>Feedback submitted successfully to Baffoons.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$emptysenderalert = "<div class='alert alert-warning'>Enter the email ID of the feeback sender. Fill information in all fields.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='feedback.php' value='Back'></input>";
$fbackfalert = "<div class='alert alert-danger'>Feedback sending failed. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='feedback.php' value='Back'></input>";
$votefalert = "<div class='alert alert-danger'>Could not add vote to the photo. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='feedback.php' value='Back'></input>";
$fqsalert = "<div class='alert alert-success'>Friend request sent to the user. Go back to people list</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='people.php' value='Back'></input>";
$fqsfalert = "<div class='alert alert-danger'>Failed sending friend request. Go back to people list</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='people.php' value='Back'></input>";
$nofreqalert = "<div class='alert alert-warning'>No friend requests found.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friends.php' value='Friends'></input>";
$reqdelalert = "<div class='alert alert-success'>Friend request deleted.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friendrequest.php' value='Friends'></input>";
$reqdelfalert = "<div class='alert alert-danger'>Error deleting request.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='friendrequest.php' value='Friends'></input>";
$rasalert = "<div class='alert alert-warning'>Request already sent to the user.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='people.php' value='Friends'></input>";
$termsalert = "<div class='alert alert-warning'>Accept to terms and conditions to complete registration.</div><input type='button' class='btn btn-primary pull-right' onClick='history.go(-1)' value='Back'></input>";
$eventexstalert = "<div class='alert alert-warning'>Event already exists in the calendar.</div><input type='button' class='btn btn-primary pull-right' onClick='history.go(-1)' value='Back'></input>";
$eventaddalert = "<div class='alert alert-success'>Event added to the calendar. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='calendar.php' value='Back'></input>";
$eventaddfalert = "<div class='alert alert-danger'>Event could not be added to the calendar. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location'addevent.php' value='Back'></input>";
$evntdelalert = "<div class='alert alert-success'>Event deleted from the calendar. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='calendar.php' value='Back'></input>";
$evntdelfalert = "<div class='alert alert-danger'>Event could not be deleted from the calendar. Go back.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='calendar.php' value='Back'></input>";
$emptyeventalert = "<div class='alert alert-warning'>No events added to the calendar. Add an event.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='addevent.php' value='Add Event'></input><br />";
$noactivityalert = "<div class='alert alert-warning'>No activities found or selected. </div><br />";
$postemptyalert = "<div class='alert alert-warning'>Post cannot be posted empty.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$nofrndphotosalert = "<div class='alert alert-warning'>Friend has not added any photos yet.</div>";
$delpropicalert = "<div class='alert alert-danger'>Photo could not be deleted.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='imageupload.php' value='Back'></input>";
$searchemptyalert = "<div class='alert alert-warning'>No search results found.</div><input type='button' class='btn btn-primary pull-right' onClick=parent.location='main.php' value='Back'></input>";
$peopleemptyalert = "<div class='alert alert-warning'>No people found. Invite your friends.</div>";
?>
</div>
</div>
</div>
</body>
</html>