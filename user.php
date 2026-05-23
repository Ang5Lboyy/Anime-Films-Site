[file name]: user.php
[file content begin]
<?php 
include 'db.php';

class User {
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $username;
    public $is_admin;
    public $connection;

    public function __construct() {
        $connection = new Dbconnection();
        $this->connection = $connection->connectDb();
    }

    public function create() {
        // Սկզբում ստուգել արդյոք is_admin սյունակը կա
        $check_column_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
        $check_result = mysqli_query($this->connection, $check_column_query);
        
        $is_admin_value = 0; // Լռելյայն արժեք
        
        // Եթե առաջին օգտատերն է, դարձնել admin
        $count_query = "SELECT COUNT(*) as count FROM users";
        $count_result = mysqli_query($this->connection, $count_query);
        $count_row = mysqli_fetch_assoc($count_result);
        
        if ($count_row['count'] == 0) {
            $is_admin_value = 1; // Առաջին օգտատերը admin է
        }
        
        // Ստեղծել INSERT query
        if (mysqli_num_rows($check_result) > 0) {
            // Եթե is_admin սյունակը կա
            $query = "INSERT INTO users(firstname, lastname, email, password, username, is_admin) 
                      VALUES('" . mysqli_real_escape_string($this->connection, $this->firstname) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->lastname) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->email) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->password) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->username) . "', 
                             " . $is_admin_value . ")";
        } else {
            // Եթե is_admin սյունակը չկա
            $query = "INSERT INTO users(firstname, lastname, email, password, username) 
                      VALUES('" . mysqli_real_escape_string($this->connection, $this->firstname) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->lastname) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->email) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->password) . "', 
                             '" . mysqli_real_escape_string($this->connection, $this->username) . "')";
        }
        
        $request = mysqli_query($this->connection, $query);
        if (!$request) {
            echo "<div style='padding: 20px; margin: 20px; background: #ffebee; color: #c62828; border-radius: 5px;'>";
            echo "<strong>Error creating user:</strong> " . mysqli_error($this->connection) . "<br>";
            echo "<strong>Query:</strong> " . htmlspecialchars($query);
            echo "</div>";
            return false;
        } else {
            echo "<div style='padding: 20px; margin: 20px; background: #e8f5e9; color: #2e7d32; border-radius: 5px;'>";
            echo "✅ Registration successful!";
            if ($is_admin_value == 1) {
                echo "<br>🎉 You are the first user and have been granted admin privileges!";
            }
            echo "<br><a href='login.php' style='color: #1b5e20; font-weight: bold;'>Click here to login</a>";
            echo "</div>";
            return true;
        }
    }

    public function update($id) {
        // Ստուգել is_admin սյունակի առկայությունը
        $check_column_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
        $check_result = mysqli_query($this->connection, $check_column_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $query = "UPDATE users SET 
                      firstname = '" . mysqli_real_escape_string($this->connection, $this->firstname) . "',
                      lastname = '" . mysqli_real_escape_string($this->connection, $this->lastname) . "',
                      email = '" . mysqli_real_escape_string($this->connection, $this->email) . "',
                      password = '" . mysqli_real_escape_string($this->connection, $this->password) . "',
                      username = '" . mysqli_real_escape_string($this->connection, $this->username) . "'
                      WHERE id = " . intval($id);
        } else {
            $query = "UPDATE users SET 
                      firstname = '" . mysqli_real_escape_string($this->connection, $this->firstname) . "',
                      lastname = '" . mysqli_real_escape_string($this->connection, $this->lastname) . "',
                      email = '" . mysqli_real_escape_string($this->connection, $this->email) . "',
                      password = '" . mysqli_real_escape_string($this->connection, $this->password) . "',
                      username = '" . mysqli_real_escape_string($this->connection, $this->username) . "'
                      WHERE id = " . intval($id);
        }
        
        $request = mysqli_query($this->connection, $query);
        if (!$request) {
            echo "Error updating user: " . mysqli_error($this->connection);
            return false;
        } else {
            return true;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = " . intval($id);
        $request = mysqli_query($this->connection, $query);
        if (!$request) {
            echo "Error deleting user: " . mysqli_error($this->connection);
            return false;
        } else {
            return true;
        }
    }

    public function selectOne($id) {
        $query = "SELECT * FROM users WHERE id = " . intval($id);
        $request = mysqli_query($this->connection, $query);
        
        if (!$request) {
            echo "Error fetching user: " . mysqli_error($this->connection);
            return [];
        } else {
            return mysqli_fetch_all($request, MYSQLI_ASSOC);
        }
    }

    public function select() {
        // Ստուգել is_admin սյունակի առկայությունը
        $check_column_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
        $check_result = mysqli_query($this->connection, $check_column_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $query = "SELECT * FROM users ORDER BY id DESC";
        } else {
            // Եթե is_admin սյունակը չկա, ավելացնել այն ըստ լռելյայն
            $query = "SELECT *, 0 as is_admin FROM users ORDER BY id DESC";
        }
        
        $request = mysqli_query($this->connection, $query);
        
        if (!$request) {
            echo "Error fetching users: " . mysqli_error($this->connection);
            return [];
        } else {
            return mysqli_fetch_all($request, MYSQLI_ASSOC);
        }
    }

    public function login($email, $password) {
        // Ստուգել is_admin սյունակի առկայությունը
        $check_column_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
        $check_result = mysqli_query($this->connection, $check_column_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($this->connection, $email) . "' 
                      AND password = '" . mysqli_real_escape_string($this->connection, $password) . "'";
        } else {
            $query = "SELECT *, 0 as is_admin FROM users WHERE email = '" . mysqli_real_escape_string($this->connection, $email) . "' 
                      AND password = '" . mysqli_real_escape_string($this->connection, $password) . "'";
        }
        
        $request = mysqli_query($this->connection, $query);
        $user = mysqli_fetch_assoc($request);
        
        if ($user) {
            return $user; 
        } else {
            return false; 
        }
    }

    public function isAdmin($user_id) {
        // Ստուգել is_admin սյունակի առկայությունը
        $check_column_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
        $check_result = mysqli_query($this->connection, $check_column_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $query = "SELECT is_admin FROM users WHERE id = " . intval($user_id);
            $request = mysqli_query($this->connection, $query);
            $result = mysqli_fetch_assoc($request);
            
            return ($result && $result['is_admin'] == 1);
        } else {
            return false; // Եթե սյունակը չկա, ոչ մեկը admin չէ
        }
    }
}
?>
[file content end]