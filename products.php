<?php 
include 'db.php';

class Products {
    private $connection;

    public function __construct() {
        try {
            $db = new Dbconnection();
            $this->connection = $db->connectDb();
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

   public function select() {
   
    $query = "SELECT * FROM products ORDER BY id DESC"; 
    $request = mysqli_query($this->connection, $query);
    
    if ($request) {
        return mysqli_fetch_all($request, MYSQLI_ASSOC);
    } else {
        echo "Error: " . mysqli_error($this->connection);
        return array();
    }
}

    public function selectOne($id) {
        $query = "SELECT * FROM products WHERE id = $id";
        $request = mysqli_query($this->connection, $query);
        
        if ($request) {
            return mysqli_fetch_all($request, MYSQLI_ASSOC);
        } else {
            echo "Error: " . mysqli_error($this->connection);
            return array();
        }
    }

   public function insert($title, $description, $image, $link, $category = 'Uncategorized') {
        try {
            // Օգտագործել mysqli_real_escape_string ապաստրոֆների համար
            $title = mysqli_real_escape_string($this->connection, $title);
            $description = mysqli_real_escape_string($this->connection, $description);
            $image = mysqli_real_escape_string($this->connection, $image);
            $link = mysqli_real_escape_string($this->connection, $link);
            $category = mysqli_real_escape_string($this->connection, $category);
            
            $query = "INSERT INTO products (title, description, image, link, category) 
                      VALUES ('$title', '$description', '$image', '$link', '$category')";
            
            // DEBUG: Ցույց տալ query-ն
            // echo "Query: $query<br>";
            
            $result = mysqli_query($this->connection, $query);
            
            if (!$result) {
                throw new Exception("Insert failed: " . mysqli_error($this->connection) . "<br>Query: " . $query);
            }
            
            return true;
            
        } catch (Exception $e) {
            error_log("Products insert error: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $title, $description, $image, $link, $category) {
        $query = "UPDATE products SET 
                  title = '$title',
                  description = '$description',
                  image = '$image',
                  link = '$link',
                  category = '$category'
                  WHERE id = $id";
        
        if (mysqli_query($this->connection, $query)) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->connection);
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM products WHERE id = $id";
        
        if (mysqli_query($this->connection, $query)) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->connection);
            return false;
        }
    }
}
?>