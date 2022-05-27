<?php

@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed!');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'Tài khoản này đã được đăng kí !';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Mật khẩu xác thực không chính xác !';
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password,user_type) VALUES('$name','$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'Tài khoản đăng kí thành công !!';
            header('location:login.php');
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
    <title>Register</title>

    <!-- font awaresome link -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- CSS link -->
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message">
                    <span>' . $message . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove()"></i>
                </div>';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>Đăng kí </h3>
        <input type="text" name="name" placeholder="Nhập tên" require class="box">
        <input type="email" name="email" placeholder="Nhập email" require class="box">
        <input type="password" name="password" placeholder="Nhập mật khẩu" require class="box">
        <input type="password" name="cpassword" placeholder="Xác thực mật khẩu" require class="box">
        <select name="user_type" class="box">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" value="Đăng kí ngay" name="submit" class="btn">
        <p>Bạn đã có tài khoản ? <a href="login.php">Đăng nhập ngay</a></p>
    </form>
</div>

</body>

</html>