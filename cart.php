<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');

    $message[] = 'Số lượng đơn hàng đã được cập nhật!!';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" \
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <?php 
        include 'header.php';
    ?>

    <div class="heading">
        <h3>Giỏ hàng của bạn</h3>
        <p><a href="home.php">home</a> / cart</p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">Sản phẩm đã đặt</h1>

        <div class="box-container">
            <?php 
                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <div class="box">
                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Bạn chắc chắn xóa sản phẩm này ?')"></a>
                <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <div class="price"><?php echo $fetch_cart['price']; ?> VNĐ</div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" value="cập nhật" class="option-btn" name="update_cart">
                </form>
                <div class="sub-total">Tổng giá : <span><?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?> VNĐ</span> </div>
            </div>

            <?php
                $grand_total += $sub_total;                   
                    }
                }
                else{
                    echo '<p class="empty">Giỏ hàng của bạn đang trống</p>';
                }
            ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
                <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '': 'disabled'; ?>" onclick="return confirm('Bạn chắc chắn xóa tất cả sản phẩm trong giỏ ?')">Xóa tất cả</a>
        </div>
        <div class="cart_total">
            <p>Tổng giá trị giỏ hàng: <span><?php echo $grand_total; ?> VNĐ</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">Tiếp tục mua sắm</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '': 'disabled'; ?>">Tiến hành thanh toán</a>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>