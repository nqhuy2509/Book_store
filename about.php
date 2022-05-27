<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

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
        <h3>about us</h3>
        <p><a href="home.php">home</a> / about</p>
    </div>
    
    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="./images/about-img.jpg" alt="">
            </div>
            <div class="content">
                <h3>Why choose us ?</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea suscipit labore quam molestias delectus accusantium officia magni nisi! Omnis sunt sequi labore optio, rerum libero ipsum magni consectetur enim nesciunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, possimus. Recusandae minima facilis exercitationem odio, neque reiciendis nemo iusto at possimus officia labore rem porro illo iste quidem fugit unde.</p>
                <a href="about.php" class="btn">Contact us</a>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h1 class="title">Đánh giá của khách hàng</h1>
        <div class="box-container">

            <div class="box">
                <img src="./images/pic-1.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem possimus eveniet, fugit qui et nihil velit atque magni! Corrupti tenetur quas hic aut voluptatibus odit sed eum id sequi.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="./images/pic-2.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem possimus eveniet, fugit qui et nihil velit atque magni! Corrupti tenetur quas hic aut voluptatibus odit sed eum id sequi.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="./images/pic-3.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem possimus eveniet, fugit qui et nihil velit atque magni! Corrupti tenetur quas hic aut voluptatibus odit sed eum id sequi.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="./images/pic-4.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem possimus eveniet, fugit qui et nihil velit atque magni! Corrupti tenetur quas hic aut voluptatibus odit sed eum id sequi.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="./images/pic-5.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem possimus eveniet, fugit qui et nihil velit atque magni! Corrupti tenetur quas hic aut voluptatibus odit sed eum id sequi.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="./images/pic-6.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem possimus eveniet, fugit qui et nihil velit atque magni! Corrupti tenetur quas hic aut voluptatibus odit sed eum id sequi.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>


        </div>
    </section>
    
    <section class="authors">
        <h1 class="title">Tác giả nổi bật</h1>
        
        <div class="box-container">
            <div class="box">
                <img src="./images/author-1.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>join deo</h3>
            </div>
            <div class="box">
                <img src="./images/author-2.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>join deo</h3>
            </div>
            <div class="box">
                <img src="./images/author-3.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>join deo</h3>
            </div>
            <div class="box">
                <img src="./images/author-4.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>join deo</h3>
            </div>
            <div class="box">
                <img src="./images/author-5.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>join deo</h3>
            </div>
            <div class="box">
                <img src="./images/author-6.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>join deo</h3>
            </div>
        </div>
    </section>


    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>