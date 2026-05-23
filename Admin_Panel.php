<?php
session_start();
include 'products.php';

// ՍՏՈՒԳԵԼ ԵՍ արդյոք օգտատերը admin է
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Access denied! You are not an admin.";
    exit;
}

$product = new Products();
$animes = $product->select();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .admin-panel { padding: 20px; }
        .btn-add { background: #F0B13B; color: black; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block; margin-bottom: 20px; }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .admin-table th { background-color: #F0B13B; color: black; }
        .admin-table tr:nth-child(even) { background-color: #ffffff; }
        .action-links a { margin-right: 10px; color: #F0B13B; text-decoration: none; }
        .action-links a:hover { text-decoration: underline; }
    </style>
</head>
<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home" onclick="window.location.href='home.php'">HOME</button>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <div class="admin-panel">
        <h1>Admin Panel - Manage Animes</h1>
        <p>Welcome, Admin! Here you can manage all anime content.</p>
        
        <a href="admin_create.php" class="btn-add">➕ Add New Anime</a>
        
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image URL</th>
                <th>Actions</th>
            </tr>
            
            <?php if (empty($animes)) { ?>
                <tr><td colspan="5" style="text-align:center; background-color: yellow;">No animes found. Add your first anime!</td></tr>
            <?php } else { ?>
                <?php foreach ($animes as $anime) { ?>
                <tr>
                    <td><?php echo $anime['id']; ?></td>
                    <td><?php echo $anime['title']; ?></td>
                    <td><?php echo $anime['category']; ?></td>
                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                        <?php echo substr($anime['image'], 0, 50) . '...'; ?>
                    </td>
                    <td class="action-links">
                        <a href="admin_update.php?id=<?php echo $anime['id']; ?>">Edit</a>
                        <a href="admin_action.php?delete=<?php echo $anime['id']; ?>" 
                           onclick="return confirm('Delete this anime?')">Delete</a>
                        <a href="single_anime.php?id=<?php echo $anime['id']; ?>">View</a>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</body>
</html>