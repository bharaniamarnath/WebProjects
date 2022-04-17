<?php
class DB {
    private $dbHost     = "YOUR_HOSTNAME";
    private $dbUsername = "YOUR_DB_USER_ACCOUNT_NAME";
    private $dbPassword = "YOUR_DB_USER_ACCOUNT_PASSWORD";
    private $dbName     = "YOUUR_DB_NAME";
 
    public function __construct() {
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
 
    public function is_token_empty() {
        $result = $this->db->query("SELECT id FROM tokens WHERE provider = 'google'");
        if($result->num_rows) {
            return false;
        }
  
        return true;
    }
 
    public function get_refresh_token() {
        $sql = $this->db->query("SELECT provider_value FROM tokens WHERE provider='google'");
        return $sql->fetch_assoc()['provider_value'];
    }
 
    public function update_refresh_token($token) {
        if($this->is_token_empty()) {
            $this->db->query("INSERT INTO tokens(provider, provider_value) VALUES('google', '$token')");
        } else {
            $this->db->query("UPDATE tokens SET provider_value = '$token' WHERE provider = 'google'");
        }
    }
}