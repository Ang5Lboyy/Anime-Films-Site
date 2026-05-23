[file name]: category.php
[file content begin]
<?php
session_start();
include_once "data.php";
include_once "products.php";

$categories = ['Shonen', 'Seinen', 'Fantasy', 'Isekai', 'Romance', 'Comedy'];
$selected_category = isset($_GET['cat']) ? $_GET['cat'] : '';
$category_animes = [];

if (!empty($selected_category) && in_array($selected_category, $categories)) {
    $product = new Products();
    $all_animes = $product->select();
    
    foreach ($all_animes as $anime) {
        if ($anime['category'] == $selected_category) {
            $category_animes[] = $anime;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <script src="anime.js"></script>
    <style>
        .category-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        
        .category-title {
            color: #F0B13B;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .category-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .category-btn {
            background-color: #1a1a4a;
            color: white;
            border: 2px solid #F0B13B;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .category-btn:hover,
        .category-btn.active {
            background-color: #F0B13B;
            color: black;
        }
        
        .results-count {
            text-align: center;
            color: #ccc;
            margin-bottom: 20px;
            font-size: 1.1em;
        }
        
        .anime-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .anime-card {
            background-color: #1a1a4a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .anime-card:hover {
            transform: translateY(-5px);
        }
        
        .anime-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .anime-info {
            padding: 15px;
        }
        
        .anime-name {
            color: #F0B13B;
            margin: 0 0 10px 0;
            font-size: 1.2em;
        }
        
        .anime-category {
            display: inline-block;
            background-color: #0B0B2E;
            color: #F0B13B;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        
        .anime-desc {
            color: #ccc;
            font-size: 0.9em;
            line-height: 1.4;
            margin-bottom: 15px;
            height: 60px;
            overflow: hidden;
        }
        
        .watch-btn {
            display: inline-block;
            background-color: #F0B13B;
            color: black;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .no-animes {
            text-align: center;
            padding: 50px;
            color: #ccc;
            font-size: 1.2em;
        }
        
        .browse-all {
            text-align: center;
            margin-top: 30px;
        }
        
        .browse-all a {
            color: #F0B13B;
            text-decoration: none;
            font-size: 1.1em;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home">HOME</button>
        <button class="characters">CHARACTERS</button>
        <button class="films">FILMS</button>
        <button class="about">ABOUT</button>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <button class="account">ACCOUNT</button>
            <button onclick="window.location.href='logout.php'">LOGOUT</button>
        <?php } else { ?>
            <button class="register">REGISTER</button>
            <button onclick="window.location.href='login.php'">LOGIN</button>
        <?php } ?>
    </div>

    <div class="category-container">
        <h1 class="category-title">Browse by Category</h1>
        
        <div class="category-filters">
            <?php foreach ($categories as $category) { ?>
                <a href="category.php?cat=<?php echo urlencode($category); ?>">
                    <button class="category-btn <?php echo ($selected_category == $category) ? 'active' : ''; ?>">
                        <?php echo $category; ?>
                    </button>
                </a>
            <?php } ?>
        </div>
        
        <?php if (!empty($selected_category)) { ?>
            <h2 style="color: #F0B13B;"><?php echo htmlspecialchars($selected_category); ?> Animes</h2>
            
            <div class="results-count">
                <?php echo count($category_animes); ?> anime(s) found in this category
            </div>
            
            <?php if (!empty($category_animes)) { ?>
                <div class="anime-grid">
                    <?php foreach ($category_animes as $anime) { ?>
                    <div class="anime-card">
                        <img src="<?php echo htmlspecialchars($anime['image']); ?>" alt="<?php echo htmlspecialchars($anime['title']); ?>">
                        <div class="anime-info">
                            <h3 class="anime-name"><?php echo htmlspecialchars($anime['title']); ?></h3>
                            <span class="anime-category"><?php echo htmlspecialchars($anime['category']); ?></span>
                            <p class="anime-desc"><?php echo substr(htmlspecialchars($anime['description']), 0, 100); ?>...</p>
                            <a href="single_anime.php?id=<?php echo $anime['id']; ?>" class="watch-btn">Watch Now</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="no-animes">
                    <p>No animes found in the <?php echo htmlspecialchars($selected_category); ?> category.</p>
                    <p>Check back soon or browse other categories.</p>
                </div>
            <?php } ?>
            
            <div class="browse-all">
                <a href="films.php">← Browse All Animes</a>
            </div>
        <?php } else { ?>
            <div style="text-align: center; color: #ccc; padding: 50px;">
                <p>Select a category above to filter animes.</p>
                <p>Or browse <a href="films.php" style="color: #F0B13B;">all animes</a>.</p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
[file content end]