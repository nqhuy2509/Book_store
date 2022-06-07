<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['send_message'])){
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    // $email = mysqli_real_escape_string($conn, $_POST['email']);
    $select_info_user = mysqli_query($conn, "SELECT name,email FROM `users` WHERE id = '$user_id'");
    $fetch_user = mysqli_fetch_assoc($select_info_user);
    $name = $fetch_user['name'];
    $email = $fetch_user['email'];
    $number = $_POST['number'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    mysqli_query($conn, "INSERT INTO `messages`(user_id, name, email, number, message) VALUE ('$user_id','$name','$email','$number','$msg')") or die('query failed');
    $message[] = 'Tin nhắn gửi thành công';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

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
        <h3>Liên hệ</h3>
        <p><a href="home.php">home</a> / contact</p>
    </div>

    <section class="contact">
        <form action="" method="post">
            <h3>Phản hồi từ bạn !!</h3>
            <!-- <input type="text" name="name" required placeholder="enter your name" class="box">
            <input type="email" name="email" required placeholder="enter your email" class="box"> -->
            <input type="number" name="number" required placeholder="Nhập số điện thoại" class="box">
            <textarea name="message" class="box" placeholder="Tin nhắn của bạn" cols="30" rows="10"></textarea>
            <input type="submit" value="Gửi" name="send_message" class="btn">
        </form>
    </section>



    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>