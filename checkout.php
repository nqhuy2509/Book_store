<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($user_id)) {
    header('location:login.php');
}


if (isset($_POST['order_btn'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address1'] . ', ' . $_POST['address2'] . ', ' . $_POST['address3'] . ', ' . $_POST['address4']);
    $method = $_POST['method'];
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' ") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ' )';
            $sub_total = $cart_item['price'] * $cart_item['quantity'];
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE 
    name = '$name' AND number = '$number' AND email = '$email' 
    AND total_products = '$total_products' AND total_price = '$cart_total'")
        or die('query failed');
    
    if($cart_total ==0){
        $message[] = 'your cart is empty';
    }else{
        if(mysqli_num_rows($order_query) > 0){
            $message[] = 'order already placed';
        }else{
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) 
            VALUES('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')") or die('query failed');
            $message[] = 'order placed successfully!!';
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            header('location:orders.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" \ crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <div class="heading">
        <h3>Thanh toán</h3>
        <p><a href="home.php">home</a> / checkout</p>
    </div>

    <section class="display-order">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
        ?>

                <p><?php echo $fetch_cart['name']; ?> <span>(<?php echo $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span></p>

        <?php
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
        ?>

        <div class="grand-total">Tổng đơn hàng: <span><?php echo $grand_total ?> VNĐ</span></div>
    </section>

    <section class="checkout">
        <form action="" method="post">
            <h3>Thông tin đơn hàng</h3>
            <div class="flex">
                <div class="inputBox">
                    <label for="name">Họ và tên:</label>
                    <input type="text" name="name" id="name" required placeholder="Nhập họ và tên">
                </div>
                <div class="inputBox">
                    <label for="number">Số điện thoại:</label>
                    <input type="number" name="number" id="number" required placeholder="Nhập số điện thoại">
                </div>
                <div class="inputBox">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required placeholder="Nhập email">
                </div>
                <div class="inputBox">
                    <label for="payment">Phương thức thanh toán:</label>
                    <select name="method" id="payment">
                        <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                        <option value="Thanh toán bằng ngân hàng">Thanh toán bằng ngân hàng</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Momo">Momo</option>
                    </select>
                </div>
                <div class="inputBox">
                    <label for="address1">Số nhà / tên đường</label>
                    <input type="text" name="address1" id="address1" required placeholder="V.d 1 Trần Hưng Đạo">
                </div>
                <div class="inputBox">
                    <label for="address2">Phường / Xã / Thị trấn</label>
                    <input type="text" name="address2" id="address2" required placeholder="e.g. flat no.">
                </div>
                <div class="inputBox">
                    <label for="address3">Quận / Huyện</label>
                    <input type="text" name="address3" id="address3" required placeholder="e.g. flat no.">
                </div>
                <div class="inputBox">
                    <label for="address4">Tỉnh / Thành phố</label>
                    <input type="text" name="address4" id="address4" required placeholder="e.g. flat no.">
                </div>
            </div>

            <div class="confirm">
                <input type="checkbox" id="confirmBtn">
                <label for="confirmBtn" class="confirm">Tôi đã chắn chắn thông tin ở trên và xác nhận đặt hàng</label>
            </div>
            <input type="submit" value="Đặt hàng ngay" class="btn disabled" id="submitBtn" name="order_btn">
        </form>
    </section>



    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>