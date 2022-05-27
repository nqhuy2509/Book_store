<?php

include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>

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

    <section class="users">
        <h1 class="title">Quản lí tài khoản</h1>
        <div class="box-container">
            <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                while($fetch_users = mysqli_fetch_assoc($select_users)){
                
            ?>
            <div class="box">
                <p>User name : <span><?php echo $fetch_users['name']; ?></span></p>
                <p>Email : <span><?php echo $fetch_users['email']; ?></span></p>
                <p>Vai trò: 
                    <span style="color: <?php 
                    if($fetch_users['user_type'] == 'admin')
                    {echo 'var(--orange)';}
                    ?>">
                        <?php echo $fetch_users['user_type']; ?>
                    </span>
                </p>

                <a href="admin_users.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('Bạn chắc chắn xóa người dùng này ?')" class="delete-btn" 
                style="<?php if($fetch_users['id'] == $admin_id) {echo 'pointer-events: none; background-color: var(--light-color);';} ?>"
                >Xóa</a>
            </div>
            <?php
                }
            ?>
        </div>
    </section>

    <!-- custom admin js -->
    <script src="./js/admim_script.js"></script>
</body>
</html>