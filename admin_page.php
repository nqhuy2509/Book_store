<?php

include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" \
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom admin css file -->
    <link rel="stylesheet" href="./style/admin_style.css">
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>
    <!-- admin dashboard secsion starts -->
    <section class="dashboard">
        <h1 class="title">bảng điều khiển</h1>

        <div class="box-container">

            <div class="box">

                <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    $number_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Số đơn hàng</p>
            </div>

            <div class="box">

                <?php
                    $select_success_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'Hoàn thành'") or die('query failed');
                    $number_success_orders = mysqli_num_rows($select_success_orders);
                ?>
                <h3><?= $number_success_orders; ?></h3>
                <p>Đơn hàng thành công</p>
            </div>

            <div class="box">
                <?php
                    $select_pending_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'Đang chờ'") or die('query failed');
                    $number_pending_orders = mysqli_num_rows($select_pending_orders);
                ?>
                <h3><?= $number_pending_orders; ?></h3>
                <p>Đơn hàng đang chờ</p>
            </div>

            <div class="box">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    $number_of_products = mysqli_num_rows($select_products);
                ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>Sản phẩm</p>
            </div>

            <div class="box">
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type ='user'") or die('query failed');
                    $number_of_users = mysqli_num_rows($select_users);
                ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>Người dùng</p>
            </div>

            <div class="box">
                <?php
                    $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type ='admin'") or die('query failed');
                    $number_of_admins = mysqli_num_rows($select_admins);
                ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>Admin</p>
            </div>

            <div class="box">
                <?php
                    $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                    $number_of_account = mysqli_num_rows($select_account);
                ?>
                <h3><?php echo $number_of_account; ?></h3>
                <p>Tổng tài khoản</p>
            </div>

            <div class="box">
                <?php
                    $select_messages = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
                    $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>Tin nhắn</p>
            </div>
        </div>
    </section>



    <!-- custom admin js -->
    <script src="./js/admim_script.js"></script>
</body>
</html>