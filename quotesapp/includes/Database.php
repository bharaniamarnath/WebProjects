<?php
class Database{
	public $isConnected;
	protected $db;
	
	private $hostname = 'localhost';
	private $user = 'bharani';
	private $passwd = 'php/mysql;db.';
	private $dbname = 'quotesapp';
	
	public function __construct(){
		$this->isConnected = TRUE;
		$dsn = 'mysql:host='.$this->hostname.';dbname='.$this->dbname;
		try{
			$this->db = new PDO($dsn,$this->user,$this->passwd);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw new Exception($e->getMessage());
		}
	}
	
	public function connect(){
		return $this->db;
	}
	
	public function disconnect(){
		$this->db = NULL;
		$this->isConnected = FALSE;
	}
}
?>