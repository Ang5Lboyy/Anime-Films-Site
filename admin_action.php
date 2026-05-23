[file name]: admin_action.php
[file content begin]
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "<div style='max-width:600px; margin:50px auto; padding:30px; background:#1a1a4a; border-radius:10px; text-align:center; color:white;'>
          <h2 style='color:#F0B13B;'>Access Denied</h2>
          <p>You must be an administrator to access this page.</p>
          <p><a href='home.php' style='color:#F0B13B;'>Go Home</a></p>
          </div>";
    exit;
}

include 'products.php';

$message = '';
$message_type = '';

try {
    // CREATE action
    if (isset($_POST['create'])) {
        $product = new Products();
        
        // Միայն պարտադիր դաշտերը
        $required_fields = ['title', 'description', 'image', 'link'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("$field field is required");
            }
        }
        
        // Ստանալ արժեքները (category-ն optional է)
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $link = $_POST['link'];
        $category = isset($_POST['category']) ? $_POST['category'] : 'Uncategorized';
        
        // Insert new anime
        $success = $product->insert($title, $description, $image, $link, $category);
        
        if ($success) {
            $message = "✅ Anime created successfully!";
            $message_type = 'success';
        } else {
            throw new Exception("Failed to create anime");
        }
    }
    
    // UPDATE action
    elseif (isset($_POST['update'])) {
        $product = new Products();
        
        if (empty($_POST['id'])) {
            throw new Exception("Anime ID is required for update");
        }
        
        $required_fields = ['title', 'description', 'image', 'link'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("$field field is required");
            }
        }
        
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $link = $_POST['link'];
        $category = isset($_POST['category']) ? $_POST['category'] : 'Uncategorized';
        $description = str_replace("'", "\\'", $description);
        $title = str_replace("'", "\\'", $title);
        $success = $product->update($id, $title, $description, $image, $link, $category);
        
        if ($success) {
            $message = "✅ Anime updated successfully!";
            $message_type = 'success';
        } else {
            throw new Exception("Failed to update anime");
        }
    }
    
    // DELETE action
    elseif (isset($_GET['delete'])) {
        $product = new Products();
        
        $id = $_GET['delete'];
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("Invalid anime ID");
        }
        
        $success = $product->delete($id);
        
        if ($success) {
            $message = "✅ Anime deleted successfully!";
            $message_type = 'success';
        } else {
            throw new Exception("Failed to delete anime");
        }
    }
    
    else {
        throw new Exception("No valid action specified");
    }
    
} catch (Exception $e) {
    $message = "❌ Error: " . $e->getMessage();
    $message_type = 'error';
}

// Redirect or show message
if ($message_type == 'success') {
    header('Location: Admin_Panel.php?message=' . urlencode($message) . '&type=success');
    exit;
} else {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Admin Action Result</title>
        <style>
            body {
                background-color: #0B0B2E;
                color: white;
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }
            
            .message-box {
                background-color: #1a1a4a;
                padding: 40px;
                border-radius: 10px;
                text-align: center;
                max-width: 600px;
                width: 90%;
                border: 1px solid #F0B13B;
            }
            
            .success {
                color: #2ecc71;
            }
            
            .error {
                color: #e74c3c;
            }
            
            .btn {
                display: inline-block;
                background-color: #F0B13B;
                color: black;
                padding: 12px 25px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
                margin-top: 20px;
            }
            
            .btn-secondary {
                background-color: #444;
                color: white;
                border: 1px solid #F0B13B;
                margin-left: 10px;
            }
            
            .debug-info {
                background: #2a2a5a;
                padding: 15px;
                border-radius: 5px;
                margin-top: 20px;
                text-align: left;
                font-size: 0.9em;
            }
        </style>
    </head>
    <body>
        <div class='message-box'>
            <h1>" . ($message_type == 'success' ? '✅ Success' : '❌ Error') . "</h1>
            <p class='" . $message_type . "' style='font-size: 1.2em;'>" . htmlspecialchars($message) . "</p>
            
            <div class='debug-info'>
                <strong>Debug Info:</strong><br>
                POST data: " . (isset($_POST) ? 'Yes' : 'No') . "<br>
                Action: " . (isset($_POST['create']) ? 'Create' : (isset($_POST['update']) ? 'Update' : (isset($_GET['delete']) ? 'Delete' : 'None'))) . "
            </div>
            
            <div style='margin-top: 30px;'>
                <a href='Admin_Panel.php' class='btn'>Back to Admin Panel</a>
                <a href='home.php' class='btn btn-secondary'>Go Home</a>
            </div>
        </div>
    </body>
    </html>";
    exit;
}
?>
[file content end]