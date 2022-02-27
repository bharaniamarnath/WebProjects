<?php
session_start();
include('includes/header.php');
include('includes/class.profile.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
if(isset($_POST['updatefav'])){
if(strlen($_POST['favacts'])>1024 || strlen($_POST['favfoods'])>1024 || strlen($_POST['favmovies'])>1024 || strlen($_POST['favmusic'])>1024 || strlen($_POST['favbooks'])>1024 || strlen($_POST['favgames'])>1024 || strlen($_POST['favpeople'])>1024){
echo $favcharalert;
exit();
}
$profile = new profile();
$profile->setUserSession($_SESSION['user']);
$profile->setFavActs($_POST['favacts']);
$profile->setFavFoods($_POST['favfoods']);
$profile->setFavMovies($_POST['favmovies']);
$profile->setFavMusic($_POST['favmusic']);
$profile->setFavBooks($_POST['favbooks']);
$profile->setFavGames($_POST['favgames']);
$profile->setFavPeople($_POST['favpeople']);
$profile->UpdateFavorites();
}
?>