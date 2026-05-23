[file name]: admin_update.php
[file content begin]
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: Admin_Panel.php');
    exit;
}

include_once "data.php";
include_once "products.php";

// Ստանալ անիմեի տվյալները
$anime_id = $_GET['id'];
$product = new Products();
$anime_result = $product->selectOne($anime_id);

if (empty($anime_result)) {
    die("Anime not found!");
}

$anime = $anime_result[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anime - Admin</title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .admin-update-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .admin-header {
            text-align: center;
            margin: 30px 0;
        }
        
        .admin-title {
            color: #F0B13B;
            font-size: 2.5em;
            margin-bottom: 15px;
        }
        
        .admin-form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #1a1a4a;
            border-radius: 10px;
            padding: 40px;
            border: 1px solid #2a2a5a;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            color: #F0B13B;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            font-size: 1.1em;
        }
        
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 14px;
            border-radius: 5px;
            border: 1px solid #F0B13B;
            background-color: #0B0B2E;
            color: white;
            font-size: 1em;
            font-family: Arial, sans-serif;
        }
        
        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .btn-submit {
            background-color: #F0B13B;
            color: black;
            padding: 16px 35px;
            border-radius: 5px;
            border: none;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            min-width: 180px;
        }
        
        .btn-submit:hover {
            background-color: #e09a2a;
        }
        
        .btn-cancel {
            background-color: #444;
            color: white;
            padding: 16px 35px;
            border-radius: 5px;
            border: 1px solid #F0B13B;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            text-align: center;
            min-width: 180px;
        }
        
        .btn-cancel:hover {
            background-color: #555;
        }
        
        .preview-section {
            background-color: #0B0B2E;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }
        
        .preview-image {
            max-width: 300px;
            border-radius: 5px;
            margin: 10px 0;
        }
        
        .current-values {
            background-color: #2a2a5a;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #ccc;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button onclick="window.location.href='Admin_Panel.php'">← Back to Admin Panel</button>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <div class="admin-update-container">
        <div class="admin-header">
            <h1 class="admin-title">Edit Anime: <?php echo htmlspecialchars($anime['title']); ?></h1>
            <p style="color: #ccc;">Edit the details of this anime series.</p>
        </div>
        
        <div class="admin-form-container">
            <form method="POST" action="admin_action.php">
                <input type="hidden" name="update" value="1">
                <input type="hidden" name="id" value="<?php echo $anime['id']; ?>">
                
                <div class="current-values">
                    <p><strong>Current Anime ID:</strong> <?php echo $anime['id']; ?></p>
                    <p><strong>Last Updated:</strong> <?php echo isset($anime['created_at']) ? $anime['created_at'] : 'Unknown'; ?></p>
                </div>
                
                <!-- Title -->
                <div class="form-group">
                    <label class="form-label">Title:</label>
                    <input type="text" name="title" class="form-input" 
                           value="<?php echo htmlspecialchars($anime['title']); ?>" required>
                </div>
                
                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-textarea" required><?php echo htmlspecialchars($anime['description']); ?></textarea>
                </div>
                
                <!-- Image URL -->
                <div class="form-group">
                    <label class="form-label">Image URL:</label>
                    <input type="text" name="image" class="form-input" 
                           value="<?php echo htmlspecialchars($anime['image']); ?>" required>
                    
                    <div class="preview-section">
                        <p><strong>Current Image Preview:</strong></p>
                        <img src="<?php echo htmlspecialchars($anime['image']); ?>" 
                             alt="Current Image" 
                             class="preview-image"
                             onerror="this.style.display='none';">
                        <p style="color: #888; font-size: 0.9em;">URL: <?php echo htmlspecialchars($anime['image']); ?></p>
                    </div>
                </div>
                
                <!-- Watch Link -->
                <div class="form-group">
                    <label class="form-label">Watch Link:</label>
                    <input type="text" name="link" class="form-input" 
                           value="<?php echo htmlspecialchars($anime['link']); ?>" required>
                </div>
                
                <!-- Category -->
                <div class="form-group">
                    <label class="form-label">Category:</label>
                    <select name="category" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <option value="Shonen" <?php echo (isset($anime['category']) && $anime['category'] == 'Shonen') ? 'selected' : ''; ?>>Shonen</option>
                        <option value="Seinen" <?php echo (isset($anime['category']) && $anime['category'] == 'Seinen') ? 'selected' : ''; ?>>Seinen</option>
                        <option value="Fantasy" <?php echo (isset($anime['category']) && $anime['category'] == 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                        <option value="Isekai" <?php echo (isset($anime['category']) && $anime['category'] == 'Isekai') ? 'selected' : ''; ?>>Isekai</option>
                        <option value="Romance" <?php echo (isset($anime['category']) && $anime['category'] == 'Romance') ? 'selected' : ''; ?>>Romance</option>
                        <option value="Comedy" <?php echo (isset($anime['category']) && $anime['category'] == 'Comedy') ? 'selected' : ''; ?>>Comedy</option>
                        <option value="Action" <?php echo (isset($anime['category']) && $anime['category'] == 'Action') ? 'selected' : ''; ?>>Action</option>
                        <option value="Drama" <?php echo (isset($anime['category']) && $anime['category'] == 'Drama') ? 'selected' : ''; ?>>Drama</option>
                        <option value="Uncategorized" <?php echo (!isset($anime['category']) || empty($anime['category'])) ? 'selected' : ''; ?>>Uncategorized</option>
                    </select>
                </div>
                
                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update Anime</button>
                    <a href="Admin_Panel.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
            
            <!-- Danger Zone -->
            <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #ff6b6b;">
                <h3 style="color: #ff6b6b;">⚠️ Danger Zone</h3>
                <p style="color: #ccc;">This action cannot be undone.</p>
                <a href="admin_action.php?delete=<?php echo $anime['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this anime? This action cannot be undone!')"
                   style="background-color: #ff6b6b; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; display: inline-block; margin-top: 15px;">
                    Delete This Anime
                </a>
            </div>
        </div>
    </div>

    <script>
        // Image preview on URL change
        document.querySelector('input[name="image"]').addEventListener('input', function(e) {
            const preview = document.querySelector('.preview-image');
            preview.src = e.target.value;
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const category = document.querySelector('select[name="category"]').value;
            if (!category) {
                e.preventDefault();
                alert('Please select a category');
                return false;
            }
            return true;
        });
    </script>
</body>
</html>
[file content end]