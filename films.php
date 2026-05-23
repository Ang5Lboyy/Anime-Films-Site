
<?php
session_start();
include_once "data.php";
include_once "products.php";

// Ստանալ բոլոր անիմեները տվյալների բազայից
$product = new Products();
$animes = $product->select(); // Այստեղ կստանանք բոլոր անիմեները

// Կատեգորիաների ցանկ (եթե ուզում եք ֆիլտրել)
$categories = ['All', 'Shonen', 'Seinen', 'Fantasy', 'Isekai', 'Romance', 'Comedy', 'Action', 'Drama'];
$selected_category = isset($_GET['category']) ? $_GET['category'] : 'All';

// Ֆիլտրել ըստ կատեգորիայի
if ($selected_category != 'All') {
    $animes = array_filter($animes, function($anime) use ($selected_category) {
        return isset($anime['category']) && $anime['category'] == $selected_category;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $films_title; ?> - Anime World</title>
    <link rel="stylesheet" href="css.css/anime.css">
    <script src="anime.js"></script>
    <style>
        .films-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .films-header {
            text-align: center;
            margin: 30px 0 40px;
        }
        
        .films-title {
            color: #F0B13B;
            font-size: 2.8em;
            margin-bottom: 15px;
        }
        
        .films-subtitle {
            color: #ccc;
            font-size: 1.1em;
            max-width: 700px;
            margin: 0 auto 25px;
            line-height: 1.6;
        }
        
        .category-filter {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
        }
        
        .category-btn {
            background-color: #1a1a4a;
            color: white;
            border: 1px solid #F0B13B;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .category-btn:hover {
            background-color: #2a2a5a;
        }
        
        .category-btn.active {
            background-color: #F0B13B;
            color: black;
        }
        
        .results-count {
            text-align: center;
            color: #ccc;
            margin-bottom: 25px;
            font-size: 1.1em;
        }
        
        .anime-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .anime-card {
            background-color: #1a1a4a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            border: 1px solid #2a2a5a;
        }
        
        .anime-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(240, 177, 59, 0.2);
        }
        
        .anime-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .anime-card-content {
            padding: 18px;
        }
        
        .anime-card-title {
            color: #F0B13B;
            font-size: 1.2em;
            margin: 0 0 10px 0;
            height: 50px;
            overflow: hidden;
        }
        
        .anime-card-category {
            display: inline-block;
            background-color: #0B0B2E;
            color: #F0B13B;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.85em;
            margin-bottom: 12px;
            font-weight: bold;
        }
        
        .anime-card-description {
            color: #ccc;
            font-size: 0.9em;
            line-height: 1.4;
            margin-bottom: 15px;
            height: 60px;
            overflow: hidden;
        }
        
        .anime-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        
        .watch-btn {
            background-color: #F0B13B;
            color: black;
            padding: 8px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9em;
            transition: background 0.3s;
        }
        
        .watch-btn:hover {
            background-color: #e09a2a;
        }
        
        .price-tag {
            color: #F0B13B;
            font-weight: bold;
            font-size: 1.1em;
        }
        
        .no-animes {
            text-align: center;
            padding: 60px 30px;
            background-color: #1a1a4a;
            border-radius: 10px;
            margin: 40px 0;
        }
        
        .no-animes h3 {
            color: #F0B13B;
            margin-bottom: 20px;
        }
        
        .no-animes p {
            color: #ccc;
            margin-bottom: 25px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .btn-add-anime {
            background-color: #F0B13B;
            color: black;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        
        .search-box {
            max-width: 600px;
            margin: 30px auto 40px;
            text-align: center;
        }
        
        .search-form {
            display: flex;
            gap: 10px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 20px;
            border-radius: 5px;
            border: 1px solid #F0B13B;
            background-color: #0B0B2E;
            color: white;
            font-size: 1em;
        }
        
        .search-btn {
            background-color: #F0B13B;
            color: black;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .view-all-link {
            text-align: center;
            margin: 40px 0;
        }
        
        .view-all-link a {
            color: #F0B13B;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: bold;
        }
        
        .debug-info {
            background: #2a2a5a;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 0.9em;
            color: #ccc;
        }
    </style>
</head>

<body class="film-body">
    <!-- Logo -->
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <!-- Navigation Buttons -->
    <div class="contacts">
        <button class="home">HOME</button>
        <button class="characters">CHARACTERS</button>
        <button class="films">FILMS</button>
        <button class="about">ABOUT</button>
        
        <?php if (isset($_SESSION['user_id'])) { ?>
            <button class="account">ACCOUNT</button>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) { ?>
                <button class="Admin_Panel">Admin Panel</button>
            <?php } ?>
            <button onclick="window.location.href='logout.php'">Logout</button>
        <?php } else { ?>
            <button class="register">REGISTER</button>
            <button onclick="window.location.href='login.php'">LOGIN</button>
        <?php } ?>
    </div>

    <!-- Main Content -->
    <div class="films-container">
        <!-- Header -->
        <div class="films-header">
            <h1 class="films-title">All Anime Series</h1>
            <p class="films-subtitle">
                Browse anime series added by our admins. <?php echo count($animes); ?> anime(s) available.
            </p>
        </div>
        
        <!-- Debug info (կարող եք հեռացնել հետո) -->
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) { ?>
            <div class="debug-info">
                <strong>Admin Debug Info:</strong><br>
                Total animes from database: <?php echo is_array($animes) ? count($animes) : '0'; ?><br>
                <a href="admin_create.php">Add New Anime</a> | 
                <a href="Admin_Panel.php">View in Admin Panel</a>
            </div>
        <?php } ?>
        
        <!-- Category Filter -->
        <div class="category-filter">
            <?php foreach ($categories as $category) { ?>
                <button class="category-btn <?php echo ($selected_category == $category) ? 'active' : ''; ?>" 
                        onclick="window.location.href='films.php?category=<?php echo urlencode($category); ?>'">
                    <?php echo $category; ?>
                </button>
            <?php } ?>
        </div>
        
        <!-- Results Count -->
        <div class="results-count">
            <?php if ($selected_category == 'All') { ?>
                Showing all <strong><?php echo count($animes); ?></strong> anime series from database
            <?php } else { ?>
                Found <strong><?php echo count($animes); ?></strong> anime series in <strong><?php echo $selected_category; ?></strong> category
            <?php } ?>
        </div>
        
        <!-- Search Box -->
        <div class="search-box">
            <p style="color: #ccc; margin-bottom: 15px;">Looking for specific anime?</p>
            <form action="search.php" method="GET" class="search-form">
                <input type="text" name="query" class="search-input" placeholder="Search anime by title or description...">
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
        
        <!-- Anime Grid -->
        <?php if (!empty($animes) && is_array($animes)) { ?>
            <div class="anime-grid">
                <?php foreach ($animes as $anime) { ?>
                    <div class="anime-card">
                        <img src="<?php echo htmlspecialchars($anime['image']); ?>" 
                             alt="<?php echo htmlspecialchars($anime['title']); ?>"
                             onerror="this.src='https://via.placeholder.com/300x200?text=Anime+Image'">
                        <div class="anime-card-content">
                            <h3 class="anime-card-title"><?php echo htmlspecialchars($anime['title']); ?></h3>
                            <?php if (isset($anime['category'])) { ?>
                                <span class="anime-card-category"><?php echo htmlspecialchars($anime['category']); ?></span>
                            <?php } ?>
                            <p class="anime-card-description">
                                <?php 
                                $desc = isset($anime['description']) ? $anime['description'] : 'No description available.';
                                echo substr(htmlspecialchars($desc), 0, 100) . '...'; 
                                ?>
                            </p>
                            <div class="anime-card-footer">
                                <a href="single_anime.php?id=<?php echo $anime['id']; ?>" class="watch-btn">View Details</a>
                                <span class="price-tag">$9.99</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
            <!-- View All Link -->
            <?php if ($selected_category != 'All') { ?>
                <div class="view-all-link">
                    <a href="films.php">← View All Anime Series</a>
                </div>
            <?php } ?>
            
        <?php } else { ?>
            <div class="no-animes">
                <h3>No anime series found</h3>
                <p>
                    <?php if ($selected_category != 'All') { ?>
                        There are no anime series in the <strong><?php echo $selected_category; ?></strong> category yet.
                    <?php } else { ?>
                        No anime series in the database yet.
                    <?php } ?>
                </p>
                
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) { ?>
                    <p>As an admin, you can add new anime series.</p>
                    <a href="admin_create.php" class="btn-add-anime">➕ Add Your First Anime</a>
                <?php } else { ?>
                    <p>Please check back later or contact the site administrator.</p>
                <?php } ?>
                
                <!-- Կարող եք ցույց տալ data.php-ի հին տվյալները, եթե ուզում եք -->
                <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #333;">
                    <h4>Sample Animes (from data.php):</h4>
                    <p>These are static examples until admins add real animes.</p>
                    <div style="display: flex; gap: 15px; flex-wrap: wrap; justify-content: center; margin-top: 20px;">
                        <?php 
                        // Ցույց տալ data.php-ի մի քանի օրինակ
                        $sample_films = array_merge($films1, $films2);
                        $sample_films = array_slice($sample_films, 0, 4);
                        
                        foreach ($sample_films as $film) { 
                        ?>
                            <div style="text-align: center; background: #2a2a5a; padding: 10px; border-radius: 5px; width: 120px;">
                                <img src="<?php echo $film['imgURL']; ?>" alt="<?php echo $film['name']; ?>" 
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                <p style="margin-top: 5px; font-size: 0.9em;"><?php echo $film['name']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
        // Navigation buttons
        document.querySelector('.home')?.addEventListener('click', function() {
            window.location.href = 'home.php';
        });
        
        document.querySelector('.characters')?.addEventListener('click', function() {
            window.location.href = 'characters.php';
        });
        
        document.querySelector('.films')?.addEventListener('click', function() {
            window.location.href = 'films.php';
        });
        
        document.querySelector('.about')?.addEventListener('click', function() {
            window.location.href = 'about.php';
        });
        
        document.querySelector('.register')?.addEventListener('click', function() {
            window.location.href = 'register.php';
        });
        
        document.querySelector('.account')?.addEventListener('click', function() {
            window.location.href = 'profile.php';
        });
        
        document.querySelector('.Admin_Panel')?.addEventListener('click', function() {
            window.location.href = 'Admin_Panel.php';
        });
    </script>
</body>
</html>
