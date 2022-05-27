<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

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
        <h3>Đơn hàng</h3>
        <p><a href="home.php">home</a> / orders</p>
    </div>

    <section class="placed-orders">
        <h1 class="title">Đơn hàng của bạn</h1>

        <div class="box-container">
            <?php 
                $orders_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($orders_query) > 0 ){
                    while($fetch_orders = mysqli_fetch_assoc($orders_query)){
            ?>

            <div class="box">
                <p>Ngày đặt: <span><?php echo $fetch_orders['placed_on'] ?></span></p>
                <p>Tên: <span><?php echo $fetch_orders['name'] ?></span></p>
                <p>email: <span><?php echo $fetch_orders['email'] ?></span></p>
                <p>Số điện thoại: <span><?php echo $fetch_orders['number'] ?></span></p>
                <p>Địa chỉ: <span><?php echo $fetch_orders['address'] ?></span></p>
                <p>Phương thức thanh toán: <span><?php echo $fetch_orders['method'] ?></span></p>
                <p>Sản phẩm đã đặt: <span><?php echo $fetch_orders['total_products'] ?></span></p>
                <p>Tổng giá trị đơn hàng: <span><?php echo $fetch_orders['total_price'] ?></span></p>
                <p>Trạng thái: <span style="color:
                <?php 
                    if($fetch_orders['payment_status'] == 'Đang chờ') { echo 'red'; } 
                    elseif($fetch_orders['payment_status'] == 'Hoàn thành') {echo 'green';} 
                    else{echo 'orange';} 
                ?>;">
                <?php echo $fetch_orders['payment_status'] ?></span></p>
                <a href="orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Bạn có chắc chắn hủy đơn hàng này ?')" class="delete-btn <?php echo ($fetch_orders['payment_status'] != 'Đang chờ') ? 'disabled' : '';?>">Hủy đơn hàng</a>
                <?php 
                    if($fetch_orders['payment_status'] == 'Đang giao hàng'){
                        echo '<p>Nếu bạn hủy đơn hàng vui lòng <a href="contact.php" style="color:red;">liên hệ</a> với chúng tôi</p>';
                    }
                ?>
                
            </div>

            <?php 
                    }
                }
                else{
                    echo '<p class="empty">Bạn không có đơn hàng nào !!!</p>';
                }
            ?>
        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>