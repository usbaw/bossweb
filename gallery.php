<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boss Cars v.10</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amita:400,700&amp;subset=devanagari,latin-ext">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Custom-Brand.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css&quot; integrity=&quot;sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB&quot; crossorigin=&quot;anonymous">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/J-Item-list-1.css">
    <link rel="stylesheet" href="assets/css/J-Item-list.css">
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="assets/css/Navigation-e-commerce.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Testimonials.css">

    <link rel="stylesheet" href="assets/css/boss-gallery.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
    <script type="text/javascript" src="assets/js/lightbox-plus-jquery.min.js"></script>
</head>
<style>
.gallery{
    margin:10px 50px;
}
.gallery img{
    width: 285px;
    padding: 5px;
    filter:grayscale(50%);
    transition: 1s;

}
.gallery img:hover{
    filter:grayscale(0%);
    transform:scale(1.1);
}
</style>

<body style="background-image:url(&quot;assets/img/long3.png&quot;);background-color:rgb(255,247,247);background-position:top;background-size:cover;background-repeat:no-repeat;">
   
<?php include 'nav.php'?>


    <br><br>
    <div class="gallery">

    <?php
    require_once("db.php");

            //  $sql = "SELECT * FROM ( SELECT post.id_post, post.image, post.createdAt FROM post INNER JOIN users ON post.id_user=users.id_user WHERE post.id_user='$_SESSION[id_user]' AND post.image!='' UNION SELECT friend_posts.id_post, friend_posts.image, friend_posts.createdAt FROM friend_posts INNER JOIN users ON friend_posts.id_user=users.id_user WHERE friend_posts.id_friend='$_SESSION[id_user]' AND friend_posts.image!='') posts ORDER BY posts.createdAt DESC";

            $sql = "select * from admin_gallery";

                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  $totalDiv  = (int) ceil($result->num_rows / 5);
    ?>
    <?php while($row = $result->fetch_assoc()) { ?>

    <a href="../boss-back/<?php echo $row['image']; ?>" data-lightbox="mygallery" data-title="<?php echo $row['caption']?>"> <img src="boss-back/<?php echo $row['image']; ?>" alt="Photo"> </a>
                 
           
    <?php
    }
    ?>
    <?php }  ?>

    </div>
    <br>
    <br>
    <br>

    <footer>
        <div class="row">
            <div class="col-sm-6 col-md-4 footer-navigation" data-aos="fade-up" data-aos-duration="700" data-aos-delay="150">
                <h3><a href="#">Boss&nbsp;<span>Carss</span></a></h3>
                <p class="links"><a href="#">Home</a><strong> · </strong><a href="#">Boss Events</a><strong> · </strong><a href="#">Newsfeed</a><strong> · </strong><a href="#">Shop</a><strong> · </strong><a href="#">Admin</a><strong> · </strong><a href="#">Video Gallery</a></p>
                <p
                    class="company-name">Company Bosscars © 2018</p>
            </div>
            <div class="col-sm-6 col-md-4 footer-contacts" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                    <p><span class="new-line-span">21 Revolution Street</span> Paris, France</p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                    <p class="footer-center-info email text-left"> +1 555 123456</p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                    <p> <a href="#" target="_blank">josh@bosscars-uk.com</a></p>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p> <a href="#" target="_blank">jason@bosscars-uk.com</a></p>
                    </div>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p> <a href="#" target="_blank">sam@bosscars-uk.com</a></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 footer-about" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                <h4>About the company</h4>
                <p><br>Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.<br><br>Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus
                    vehicula sit amet.<br><br>Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit&nbsp;<br></p>
                <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-github"></i></a></div>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js&quot; integrity=&quot;sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49&quot; crossorigin=&quot;anonymous&quot;"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js&quot; integrity=&quot;sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo&quot; crossorigin=&quot;anonymous&quot;"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js&quot; integrity=&quot;sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T&quot; crossorigin=&quot;anonymous&quot;"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</body>

</html>