[file name]: checkout.php
[file content begin]
<?php
session_start();
include_once "data.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Հաշվել ընդհանուր գումար
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Վճարման մշակում
$payment_success = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Այստեղ կլինի վճարման համակարգի ինտեգրացիա
    $payment_success = true;
    
    // Մաքրել զամբյուղը վճարումից հետո
    if ($payment_success) {
        $_SESSION['cart'] = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .checkout-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: #1a1a4a;
            border-radius: 15px;
            color: white;
        }
        
        .checkout-title {
            color: #F0B13B;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .checkout-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }
        
        .checkout-steps:before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #444;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            background-color: #444;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
        
        .step.active .step-number {
            background-color: #F0B13B;
            color: black;
        }
        
        .step-label {
            font-size: 0.9em;
        }
        
        .order-summary {
            background-color: #0B0B2E;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }
        
        .order-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #444;
        }
        
        .payment-form {
            margin-top: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #F0B13B;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #444;
            background-color: #0B0B2E;
            color: white;
        }
        
        .btn-pay {
            width: 100%;
            padding: 15px;
            background-color: #F0B13B;
            color: black;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
        }
        
        .success-message {
            text-align: center;
            padding: 50px;
            color: #2ecc71;
        }
        
        .success-message h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home">HOME</button>
        <button onclick="window.location.href='cart.php'">← Back to Cart</button>
    </div>

    <div class="checkout-container">
        <?php if (!$payment_success) { ?>
            <h1 class="checkout-title">Checkout</h1>
            
            <div class="checkout-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-label">Cart</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div class="step-label">Checkout</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Payment</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-label">Complete</div>
                </div>
            </div>
            
            <div class="order-summary">
                <h3>Order Summary</h3>
                <?php foreach ($_SESSION['cart'] as $item) { ?>
                    <div class="order-item">
                        <span><?php echo $item['title']; ?> × <?php echo $item['quantity']; ?></span>
                        <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                <?php } ?>
                
                <div class="order-total">
                    <span>Total:</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
            
            <form method="POST" class="payment-form">
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" placeholder="1234 5678 9012 3456" required>
                </div>
                
                <div class="form-group" style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label>Expiry Date</label>
                        <input type="text" placeholder="MM/YY" required>
                    </div>
                    <div style="flex: 1;">
                        <label>CVV</label>
                        <input type="text" placeholder="123" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Name on Card</label>
                    <input type="text" placeholder="John Doe" required>
                </div>
                
                <button type="submit" class="btn-pay">Pay $<?php echo number_format($total, 2); ?></button>
            </form>
        <?php } else { ?>
            <div class="success-message">
                <h2>✅ Payment Successful!</h2>
                <p>Thank you for your purchase. Your anime(s) are now available in your account.</p>
                <p>You will receive an email confirmation shortly.</p>
                <p>
                    <a href="profile.php" style="color: #F0B13B;">Go to My Account</a> | 
                    <a href="films.php" style="color: #F0B13B;">Continue Browsing</a>
                </p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
[file content end]