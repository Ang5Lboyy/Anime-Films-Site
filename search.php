[file name]: search.php
[file content begin]
<?php
session_start();
include_once "data.php";
include_once "products.php";

$search_query = '';
$search_results = [];

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $search_query = trim($_GET['query']);
    $product = new Products();
    $all_animes = $product->select();
    
    // Ֆիլտրել ըստ որոնման բառի
    foreach ($all_animes as $anime) {
        if (stripos($anime['title'], $search_query) !== false || 
            stripos($anime['description'], $search_query) !== false ||
            stripos($anime['category'], $search_query) !== false) {
            $search_results[] = $anime;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <script src="anime.js"></script>
    <style>
        .search-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        
        .search-box {
            display: flex;
            margin-bottom: 30px;
            gap: 10px;
        }
        
        .search-box input {
            flex: 1;
            padding: 12px 20px;
            border-radius: 5px;
            border: 2px solid #F0B13B;
            background-color: #0B0B2E;
            color: white;
            font-size: 16px;
        }
        
        .search-box button {
            background-color: #F0B13B;
            color: black;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .results-info {
            color: #ccc;
            margin-bottom: 20px;
            font-size: 1.1em;
        }
        
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .result-card {
            background-color: #1a1a4a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .result-card:hover {
            transform: translateY(-5px);
        }
        
        .result-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .result-info {
            padding: 15px;
        }
        
        .result-title {
            color: #F0B13B;
            margin: 0 0 10px 0;
            font-size: 1.2em;
        }
        
        .result-category {
            display: inline-block;
            background-color: #0B0B2E;
            color: #F0B13B;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        
        .result-description {
            color: #ccc;
            font-size: 0.9em;
            line-height: 1.4;
            margin-bottom: 15px;
            height: 60px;
            overflow: hidden;
        }
        
        .view-btn {
            display: inline-block;
            background-color: #F0B13B;
            color: black;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .no-results {
            text-align: center;
            padding: 50px;
            color: #ccc;
            font-size: 1.2em;
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

    <div class="search-container">
        <h1 style="color: #F0B13B; text-align: center;">Search Animes</h1>
        
        <form method="GET" action="search.php" class="search-box">
            <input type="text" name="query" placeholder="Search by title, description or category..." 
                   value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Search</button>
        </form>
        
        <?php if (!empty($search_query)) { ?>
            <div class="results-info">
                <?php if (!empty($search_results)) { ?>
                    Found <strong><?php echo count($search_results); ?></strong> result(s) for "<strong><?php echo htmlspecialchars($search_query); ?></strong>"
                <?php } else { ?>
                    No results found for "<strong><?php echo htmlspecialchars($search_query); ?></strong>"
                <?php } ?>
            </div>
        <?php } ?>
        
        <?php if (!empty($search_results)) { ?>
            <div class="results-grid">
                <?php foreach ($search_results as $anime) { ?>
                <div class="result-card">
                    <img src="<?php echo htmlspecialchars($anime['image']); ?>" alt="<?php echo htmlspecialchars($anime['title']); ?>">
                    <div class="result-info">
                        <h3 class="result-title"><?php echo htmlspecialchars($anime['title']); ?></h3>
                        <span class="result-category"><?php echo htmlspecialchars($anime['category']); ?></span>
                        <p class="result-description"><?php echo substr(htmlspecialchars($anime['description']), 0, 100); ?>...</p>
                        <a href="single_anime.php?id=<?php echo $anime['id']; ?>" class="view-btn">View Details</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php } elseif (!empty($search_query)) { ?>
            <div class="no-results">
                <p>No animes found matching your search.</p>
                <p>Try different keywords or browse all <a href="films.php" style="color: #F0B13B;">animes</a>.</p>
            </div>
        <?php } else { ?>
            <div class="no-results">
                <p>Enter a search term above to find animes.</p>
                <p>You can search by title, description, or category.</p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
[file content end]