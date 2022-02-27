<?php
	session_start();
	include('includes/connect.php');
	include('includes/class.group.php');
	include('includes/alerts.php');
	$suid = $_SESSION['user'];
	if(isset($_POST['delete'])){
		$gpid = $_POST['gpdid'];
		$group = new group();
		$group->setUserSession($suid);
		$group->setPostId($_POST['deletegpost']);
		$group->DeleteGroupPost();
		header("Location: viewgroup.php?vgrpid=" . $gpid);
		}
?>