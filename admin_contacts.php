<?php

include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_contacts.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>message</title>

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

    <section class="messages">
        <h1 class="title">tin nhắn</h1>

        <div class="box-container">
            <?php 
                $select_messages = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
                if(mysqli_num_rows($select_messages) >0){
                    while($fetch_messages = mysqli_fetch_assoc($select_messages)){
            ?>
            <div class="box">
                <p>Tên: <span><?php echo $fetch_messages['name'];?></span></p>
                <p>Email: <span><?php echo $fetch_messages['email'];?></span></p>
                <p>Số điện thoại: <span><?php echo $fetch_messages['number'];?></span></p>
                <p>Nội dung: <span><?php echo $fetch_messages['message'];?></span></p>
                <a href="admin_contacts.php?delete=<?php echo $fetch_messages['id'];?>" onclick="return confirm('Bạn chắc chắn xóa tin nhắn này ?')" class="delete-btn">Xóa tin nhắn</a>
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">You have no message!</p>';
                }
            ?>
        </div>
    </section>



    <!-- custom admin js -->
    <script src="./js/admim_script.js"></script>
</body>
</html>