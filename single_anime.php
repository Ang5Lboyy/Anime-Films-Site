
<?php
session_start();
include_once "data.php";
include_once "products.php";

if (!isset($_GET['id'])) {
    header('Location: home.php');
    exit;
}

$anime_id = $_GET['id'];
$product = new Products();
$anime_result = $product->selectOne($anime_id);

if (empty($anime_result)) {
    echo "<h2>Anime not found!</h2>";
    exit;
}

$anime = $anime_result[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $anime['title']; ?> - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <script src="anime.js"></script>
    <style>
        .anime-detail-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #1a1a4a;
            border-radius: 15px;
            color: white;
        }
        
        .anime-header {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .anime-poster {
            flex: 1;
            min-width: 300px;
        }
        
        .anime-poster img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }
        
        .anime-info {
            flex: 2;
            min-width: 300px;
        }
        
        .anime-title {
            color: #F0B13B;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .anime-meta {
            margin-bottom: 20px;
        }
        
        .anime-meta span {
            display: inline-block;
            background-color: #0B0B2E;
            padding: 5px 15px;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
            border: 1px solid #F0B13B;
        }
        
        .anime-description {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn-watch, .btn-favorite, .btn-buy {
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-watch {
            background-color: #F0B13B;
            color: black;
        }
        
        .btn-favorite {
            background-color: #444;
            color: white;
            border: 1px solid #F0B13B;
        }
        
        .btn-buy {
            background-color: #2ecc71;
            color: white;
        }
        
        .btn-watch:hover {
            background-color: #e09a2a;
        }
        
        .btn-favorite:hover {
            background-color: #555;
        }
        
        .btn-buy:hover {
            background-color: #27ae60;
        }
        
        .related-animes {
            margin-top: 50px;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .related-card {
            background-color: #0B0B2E;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
        }
        
        .related-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .related-card h4 {
            padding: 15px;
            margin: 0;
            color: #F0B13B;
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

    <div class="anime-detail-container">
        <div class="anime-header">
            <div class="anime-poster">
                <img src="<?php echo htmlspecialchars($anime['image']); ?>" alt="<?php echo htmlspecialchars($anime['title']); ?>">
            </div>
            
            <div class="anime-info">
                <h1 class="anime-title"><?php echo htmlspecialchars($anime['title']); ?></h1>
                
                <div class="anime-meta">
                    <span><strong>Category:</strong> <?php echo htmlspecialchars($anime['category']); ?></span>
                    <span><strong>Status:</strong> Ongoing</span>
                    <span><strong>Episodes:</strong> 24+</span>
                </div>
                
                <div class="anime-description">
                    <h3>Description</h3>
                    <p><?php echo htmlspecialchars($anime['description']); ?></p>
                </div>
                
                <div class="action-buttons">
                    <a href="<?php echo htmlspecialchars($anime['link']); ?>" target="_blank" class="btn-watch">▶ Watch Now</a>
                    
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <button class="btn-favorite" onclick="addToFavorites(<?php echo $anime['id']; ?>)">❤ Add to Favorites</button>
                        <button class="btn-buy" onclick="buyAnime(<?php echo $anime['id']; ?>)">💰 Buy Digital Copy ($9.99)</button>
                    <?php } else { ?>
                        <button class="btn-favorite" onclick="alert('Please login to add favorites')">❤ Add to Favorites</button>
                        <button class="btn-buy" onclick="window.location.href='login.php'">💰 Buy Digital Copy</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <?php
        
        $all_animes = $product->select();
        $related_animes = array_filter($all_animes, function($item) use ($anime) {
            return $item['category'] == $anime['category'] && $item['id'] != $anime['id'];
        });
        
        $related_animes = array_slice($related_animes, 0, 4);
        ?>
        
        <?php if (!empty($related_animes)) { ?>
        <div class="related-animes">
            <h2>Related Animes (<?php echo htmlspecialchars($anime['category']); ?>)</h2>
            <div class="related-grid">
                <?php foreach ($related_animes as $related) { ?>
                <div class="related-card">
                    <a href="single_anime.php?id=<?php echo $related['id']; ?>">
                        <img src="<?php echo htmlspecialchars($related['image']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>">
                        <h4><?php echo htmlspecialchars($related['title']); ?></h4>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <script>
        function addToFavorites(animeId) {
            alert('Added to favorites! Anime ID: ' + animeId);
          
        }
        
        function buyAnime(animeId) {
            if (confirm('Buy this anime for $9.99?')) {
                window.location.href = 'checkout.php?anime_id=' + animeId;
            }
        }
    </script>
</body>
</html>
