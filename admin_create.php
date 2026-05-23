
<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Anime</title>
    <link rel="stylesheet" href="css.css/anime.css">
</head>
<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button onclick="window.location.href='Admin_Panel.php'">← Back to Admin</button>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <div style="max-width: 600px; margin: 30px auto; padding: 20px;">
        <h1 style="color: #000000;">Add New Anime</h1>
        
        <form method="POST" action="admin_action.php" style="background: #1a1a4a; padding: 30px; border-radius: 10px;">
            <input type="hidden" name="create" value="1">
            
            <div style="margin-bottom: 20px;">
                <label style="color: #F0B13B; display: block; margin-bottom: 5px;">Title:</label>
                <input type="text" name="title" style="width: 100%; padding: 10px; background: #0B0B2E; color: white; border: 1px solid #F0B13B;" required>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="color: #F0B13B; display: block; margin-bottom: 5px;">Description:</label>
                <textarea name="description" style="width: 100%; padding: 10px; background: #0B0B2E; color: white; border: 1px solid #F0B13B; height: 100px;" required></textarea>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="color: #F0B13B; display: block; margin-bottom: 5px;">Image URL:</label>
                <input type="text" name="image" style="width: 100%; padding: 10px; background: #0B0B2E; color: white; border: 1px solid #F0B13B;" required>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="color: #F0B13B; display: block; margin-bottom: 5px;">Watch Link:</label>
                <input type="text" name="link" style="width: 100%; padding: 10px; background: #0B0B2E; color: white; border: 1px solid #F0B13B;" required>
            </div>
            
            <!-- Category դաշտը ԱՐԴԵՆ ՀԵՌԱՑՎԱԾ Է -->
            
            <div style="text-align: center;">
                <button type="submit" style="background: #F0B13B; color: black; padding: 12px 30px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                    Add Anime
                </button>
            </div>
        </form>
    </div>
</body>
</html>
