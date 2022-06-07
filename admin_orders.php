<?php

include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['update_order'])){
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id='$order_update_id'") or die('query failed');
    $message[] = 'Trạng thái đơn hàng đã được cập nhật !';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
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

    <!-- Custom admin css file -->
    <link rel="stylesheet" href="./style/admin_style.css">
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>

    <section class="orders">
        <h1 class="title">Quản lí đơn hàng</h1>
        <div class="box-container">
            <?php 
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){

                    
            ?>
            <div class="box">
                <p>user id : <span><?php echo $fetch_orders['user_id'];?></span></p>
                <p>Ngày đặt : <span><?php echo $fetch_orders['placed_on'];?></span></p>
                <p>Tên : <span><?php echo $fetch_orders['name'];?></span></p>
                <p>Số điện thoại : <span><?php echo $fetch_orders['number'];?></span></p>
                <p>Email : <span><?php echo $fetch_orders['email'];?></span></p>
                <p>Địa chỉ : <span><?php echo $fetch_orders['address'];?></span></p>
                <p>Sản phẩm đặt hàng : <span><?php echo $fetch_orders['total_products'];?></span></p>
                <p>Tổng giá trị : <span><?php echo $fetch_orders['total_price'];?></span></p>
                <p>Phương thức thanh toán : <span><?php echo $fetch_orders['method'];?></span></p>
                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">
                    <select name="update_payment">
                        <option value="Đang chờ" <?php echo $fetch_orders['payment_status'] == 'Đang chờ' ? 'selected': ''; ?>>Đang chờ</option>
                        <option value="Đang giao hàng" <?php echo $fetch_orders['payment_status'] == 'Đang giao hàng' ? 'selected': ''; ?>>Đang giao hàng</option>
                        <option value="Hoàn thành" <?php echo $fetch_orders['payment_status'] == 'Hoàn thành' ? 'selected': ''; ?>>Hoàn thành</option>
                    </select>
                    <input type="submit" value="Cập nhật" name="update_order" class="option-btn">
                    <a href="admin_orders.php?delete=<?php echo $fetch_orders['id'];?>" onclick="return confirm('Bạn chắc chắn xóa đơn hàng này ?')" class="delete-btn">Xóa</a>
                </form>
            </div>   
            <?php 
                    }
                }else{
                    echo '<p class="empty">Chưa có đơn hàng nào!!</p>';
                }
            ?>
        </div>
    </section>



    <!-- custom admin js -->
    <script src="./js/admim_script.js"></script>
</body>
</html>