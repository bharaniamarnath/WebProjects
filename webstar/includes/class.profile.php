<?php
class profile{

	private $UserSession;
	private $FirstName; 
	private $LastName;
	private $Occupation;
	private $Contact;
	private $City;
	private $Country;
	private $School;
	private $Work;
	private $Language;
	private $Marital;
	private $About;
	
	private $FavActs;
	private $FavFoods;
	private $FavMovies;
	private $FavMusic;
	private $FavBooks;
	private $FavGames;
	private $FavPeople;
	
	private $ImageTarget;
	private $ImageThumb;
	
	public function getUserSession(){
		return $this->UserSession;
	}
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getFirstName(){
		return $this->FirstName;
	}
	public function setFirstName($FirstName){
		$this->FirstName = $FirstName;
	}
	
	public function getLastName(){
		return $this->LastName;
	}
	public function setLastName($LastName){
		$this->LastName = $LastName;
	}
	
	public function getOccupation(){
		return $this->Occupation;
	}
	public function setOccupation($Occupation){
		$this->Occupation = $Occupation;
	}
	
	public function getContact(){
		return $this->Contact;
	}
	public function setContact($Contact){
		$this->Contact = $Contact;
	}
	
	public function getCity(){
		return $this->City;
	}
	public function setCity($City){
		$this->City = $City;
	}
	
	public function getCountry(){
		return $this->Country;
	}
	public function setCountry($Country){
		$this->Country= $Country;
	}
	
	public function getSchool(){
		return $this->School;
	}
	public function setSchool($School){
		$this->School = $School;
	}
	
	public function getWork(){
		return $this->Work;
	}
	public function setWork($Work){
		$this->Work = $Work;
	}
	
	public function getLanguage(){
		return $this->Language;
	}
	public function setLanguage($Language){
		$this->Language = $Language;
	}
	
	public function getMarital(){
		return $this->Marital;
	}
	public function setMarital($Marital){
		$this->Marital = $Marital;
	}
	
	public function getAbout(){
		return $this->About;
	}
	public function setAbout($About){
		$this->About = $About;
	}
	
		public function getFavActs(){
		return $this->FavActs;
	}
	public function setFavActs($FavActs){
		$this->FavActs = $FavActs;
	}
	
	public function getFavFoods(){
		return $this->FavFoods;
	}
	public function setFavFoods($FavFoods){
		$this->FavFoods = $FavFoods;
	}
	
	public function getFavMovies(){
		return $this->FavMovies;
	}
	public function setFavMovies($FavMovies){
		$this->FavMovies = $FavMovies;
	}
	
	public function getFavMusic(){
		return $this->FavMusic;
	}
	public function setFavMusic($FavMusic){
		$this->FavMusic = $FavMusic;
	}
	
	public function getFavBooks(){
		return $this->FavBooks;
	}
	public function setFavBooks($FavBooks){
		$this->FavBooks = $FavBooks;
	}
	
	public function getFavGames(){
		return $this->FavGames;
	}
	public function setFavGames($FavGames){
		$this->FavGames = $FavGames;
	}
	
	public function getFavPeople(){
		return $this->FavPeople;
	}
	public function setFavPeople($FavPeople){
		$this->FavPeople = $FavPeople;
	}
	
	public function getImageTarget(){
		return $this->ImageTarget;
	}	
	public function setImageTarget($ImageTarget){
		$this->ImageTarget = $ImageTarget;
	}
	
	public function getImageThumb(){
		return $this->ImageThumb;
	}	
	public function setImageThumb($ImageThumb){
		$this->ImageThumb = $ImageThumb;
	}
	
	public function UpdateProfile(){
		include "connect.php";
		include "alerts.php";
		
		$usrupd = $pdo->prepare("UPDATE userdetails SET Firstname=:Firstname, Lastname=:Lastname WHERE UserID=:UserID");
		$usrupd->execute(array(
						'Firstname'=>$this->getFirstName(),
						'Lastname'=>$this->getLastName(),
						'UserID'=>$this->getUserSession()
		));
		
		$usrpupd = $pdo->prepare("UPDATE personaldetails SET Occupation=:Occupation, Contact=:Contact, City=:City, Country=:Country, School=:School, Work=:Work, Language=:Language, Marital=:Marital, About=:About WHERE UserID=:UserID");
		$usrpupd->execute(array(
						'Occupation'=>$this->getOccupation(),
						'Contact'=>$this->getContact(),
						'City'=>$this->getCity(),
						'Country'=>$this->getCountry(),
						'School'=>$this->getSchool(),
						'Work'=>$this->getWork(),
						'Language'=>$this->getLanguage(),
						'Marital'=>$this->getMarital(),
						'About'=>$this->getAbout(),
						'UserID'=>$this->getUserSession()
		));
		
		if($usrpupd){
		echo $proupdconalert;
		exit();	
		}
		else{
		echo $proupdfailalert;
		exit();
		}
	}
	
	public function UpdateFavorites(){
		include "connect.php";
		include "alerts.php";
		
		$favupd = $pdo->prepare("UPDATE favorites SET Activities=:Activities, Foods=:Foods, Movies=:Movies, Music=:Music, Books=:Books, Games=:Games, People=:People WHERE UserID=:UserID");
		$favupd->execute(array(
						'Activities'=>$this->getFavActs(),
						'Foods'=>$this->getFavFoods(),
						'Movies'=>$this->getFavMovies(),
						'Music'=>$this->getFavMusic(),
						'Books'=>$this->getFavBooks(),
						'Games'=>$this->getFavGames(),
						'People'=>$this->getFavPeople(),
						'UserID'=>$this->getUserSession()
						));
						
		if($favupd){
			echo $favupdconalert;
			exit();	
		}
		else{
			echo $favupdfailalert;
			exit();
		}
	}
	
	public function ProfileImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("UPDATE imagedetails SET Image=:Image, Thumb=:Thumb WHERE UserID=:UserID");
		$imgquery->execute(array(
						'Image'=>$this->getImageTarget(),
						'Thumb'=>$this->getImageThumb(),
						'UserID'=>$this->getUserSession()
						));
		if($imgquery){
		echo $imageulalert;
		exit();
		}	
		else{
		echo $imagealert;
		exit();
		}
	}
}
?>