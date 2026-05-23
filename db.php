<?php
class Dbconnection {
    private $host;
    private $username;
    private $password;
    private $db;
    private $port;

    public function __construct() {
        $this->host = '127.0.0.1';     // ԿԱՐԵՎՈՐ - localhost-ի փոխարեն
        $this->username = 'root';
        $this->password = 'root';       // MAMP-ի password-ը
        $this->db = 'ang5lboyy';
        $this->port = 3306;             // MySQL port-ը
    }

    public function connectDb() {
        $conn = mysqli_connect($this->host, $this->username, $this->password, $this->db, $this->port);
        
        if (!$conn) {
            // Դետալներ սխալի մասին
            echo "<div style='background:#ffebee; padding:15px; margin:20px; border-radius:5px; color:#c62828;'>";
            echo "<strong>Database Connection Error:</strong><br>";
            echo "Host: {$this->host}<br>";
            echo "Port: {$this->port}<br>";
            echo "Error: " . mysqli_connect_error() . "<br>";
            echo "</div>";
            die("Cannot connect to database. Please check your MySQL settings.");
        }
        
        // Կարգավորել UTF-8 կոդավորումը
        mysqli_set_charset($conn, "utf8");
        
        return $conn;
    }
}
?>