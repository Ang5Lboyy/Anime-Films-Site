[file name]: cart.php
[file content begin]
<?php
session_start();
include_once "data.php";

// Սկզբնավորել զամբյուղը եթե դեռ չկա
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ավելացնել ապրանք զամբյուղ
if (isset($_GET['add_to_cart'])) {
    $anime_id = $_GET['add_to_cart'];
    
    if (isset($_SESSION['cart'][$anime_id])) {
        $_SESSION['cart'][$anime_id]['quantity']++;
    } else {
        $_SESSION['cart'][$anime_id] = [
            'id' => $anime_id,
            'quantity' => 1,
            'title' => "Anime #$anime_id", // Փոխարինել իրական տվյալներով
            'price' => 9.99
        ];
    }
}

// Հեռացնել ապրանք զամբյուղից
if (isset($_GET['remove_from_cart'])) {
    $anime_id = $_GET['remove_from_cart'];
    unset($_SESSION['cart'][$anime_id]);
}

// Զամբյուղի ընդհանուր արժեք
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .cart-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: #1a1a4a;
            border-radius: 15px;
            color: white;
        }
        
        .cart-title {
            color: #F0B13B;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .cart-table th {
            background-color: #F0B13B;
            color: black;
            padding: 15px;
            text-align: left;
        }
        
        .cart-table td {
            padding: 15px;
            border-bottom: 1px solid #333;
        }
        
        .cart-table tr:hover {
            background-color: #2a2a5a;
        }
        
        .remove-btn {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: bold;
        }
        
        .cart-total {
            text-align: right;
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        
        .cart-actions {
            display: flex;
            justify-content: space-between;
        }
        
        .btn-continue, .btn-checkout {
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .btn-continue {
            background-color: #444;
            color: white;
            border: 1px solid #F0B13B;
        }
        
        .btn-checkout {
            background-color: #F0B13B;
            color: black;
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px;
            color: #ccc;
        }
        
        .empty-cart a {
            color: #F0B13B;
            text-decoration: none;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home">HOME</button>
        <button onclick="window.location.href='films.php'">BROWSE ANIMES</button>
        <button onclick="window.location.href='logout.php'">LOGOUT</button>
    </div>

    <div class="cart-container">
        <h1 class="cart-title">Your Shopping Cart</h1>
        
        <?php if (!empty($_SESSION['cart'])) { ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Anime</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item) { ?>
                    <tr>
                        <td><?php echo $item['title']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <a href="cart.php?remove_from_cart=<?php echo $item['id']; ?>" class="remove-btn">Remove</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <div class="cart-total">
                <strong>Total Amount: $<?php echo number_format($total, 2); ?></strong>
            </div>
            
            <div class="cart-actions">
                <a href="films.php" class="btn-continue">← Continue Shopping</a>
                <a href="checkout.php" class="btn-checkout">Proceed to Checkout →</a>
            </div>
        <?php } else { ?>
            <div class="empty-cart">
                <h3>Your cart is empty</h3>
                <p>Browse our collection of animes and add some to your cart!</p>
                <a href="films.php">Browse Animes</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
[file content end]