<?php
session_start();
?>
<?php include 'db.php';
$data=mysqli_query($conn,"select * from users");
$numrow=mysqli_num_rows($data);
?>
<?php
include 'db.php';
$datetoday=date("Y-m-d");
$sql = "UPDATE boss_event SET status='Held' where end_date<'$datetoday'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boss Cars</title>
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
</head>
<style>
.navbar {
  transition:500ms ease;
  background-color:rgba(255,255,255,0.85);
  

}
.navbar.scrolled{
  background-color:white;
  overflow: hidden;

  position: fixed;
  top: 0;
  width: 100%;
  z-index: 500
}
.navbar.scrolled:hover{
  background-color:#ff7fb3;
  
  overflow: hidden;

  position: fixed;
  top: 0;
  width: 100%;
  z-index: 500
}
</style>
<script>
$(window).scroll(function(){
	$('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
});
</script>
<body style="background-color:rgb(0,0,0);color:rgb(255,255,255);">
    <section class="d-flex flex-column justify-content-between" id="banner" style="background-color:#ffffff;">
         <?php include 'nav.php';?>
        <div id="b-id">
            <h1 class="text-center" data-aos="fade-up" data-aos-duration="950" data-aos-once="true" id="title" style="color:rgb(255,255,255);">Boss Cars</h1>
            <h2 class="text-center" data-aos="fade-up" data-aos-duration="950" data-aos-delay="350" data-aos-once="true" id="subtitle" style="color:rgb(255,255,255);"><strong>Built</strong><br></h2>
        </div>
        <div id="banner-bottom" style="width:100%;">
            <div class="container summary">
                <div class="row ban-bot1">
                    <div class="col-8 offset-2">
                        <p data-aos="fade-up" data-aos-duration="700" data-aos-delay="400"></p>
                    </div>
                </div>
              <div class="row ban-bot1" data-aos="fade" data-aos-duration="700" data-aos-delay="700">
                    <div class="col" data-aos="fade-up" data-aos-duration="700" data-aos-delay="450">
                        <p id="p-top"><i class="fa fa-users"></i>&nbsp;<?php echo $numrow;?></p>                   
                        <p id="p-bot" style="font-size:13px;">User Access</p>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
                        <p id="p-top"><i class="fa fa-eye"></i>
						
						<img src="https://www.reliablecounter.com/count.php?page=hht.insourceintelligent.com/&digit=style/plain/10/&reloads=0" alt="" title="" border="0">
						
						</p>
                        <p id="p-bot" style="font-size:13px;">Reviews</p>
                    </div>
                    <div class="col align-self-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800"><a href="BossEvent/index.php"><button class="btn btn-primary btn-block join-button" type="button">Join Events</button></a></div>
                </div>
                <div class="row ban-bot1">
                    <div class="col"><button class="btn btn-link btn-block arrow-button" type="button"><i class="icon ion-ios-arrow-down" style="font-size:32px;color:rgba(255,255,255,0);"></i></button></div>
                </div>
            </div>
        </div>
    </section>
    <div class="carousel slide" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox" id="carousel-slide">
            <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/19.jpg" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="assets/img/15.jpg" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="assets/img/36.jpg" alt="Slide Image"></div>
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
        <ol
            class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-1" data-slide-to="1"></li>
            <li data-target="#carousel-1" data-slide-to="2"></li>
            </ol>
    </div>
    <section id="video" style="/*background-image:url(&quot;assets/img/maxresdefault.jpg&quot;);*/"><iframe width="560" height="315" allowfullscreen="" frameborder="0" src="https://player.vimeo.com/video/123608325?autoplay=1&amp;loop=1&amp;portrait=0&amp;title=0&amp;byline=0" data-aos="fade-up" data-aos-duration="700" data-aos-delay="50"></iframe></section>
    <div
        class="article-list" style="background-image:url(&quot;assets/img/event_banner.jpg&quot;);background-position:center;background-size:cover;background-repeat:no-repeat;width:100%;">
        <div class="container" id="e-id">
            <div class="intro">
                <h2 class="text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="150" id="evet-text">Events</h2>
            </div>
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="250"><a href="BossEvent/index.php?id=top"></a><i class="fa fa-trophy" id="event-icon-icon" style="background-color:rgba(255,255,255,0);color:gold;"></i>
                    <h3 id="event4-title" class="name">Top Events</h3>
                    <p id="event-description1" class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="BossEvent/index.php?id=TOP" class="action"><i class="fa fa-arrow-circle-right"></i></a></div>
                <div
                    class="col-sm-6 col-md-4 item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="250"><a href="BossEvent/index.php?id=new"></a><i class="fa fa-car" id="event-icon-icon" style="background-color:rgba(255,255,255,0);color:gold;"></i>
                    <h3 id="event4-title" class="name">New Events</h3>
                    <p id="event-description1" class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="BossEvent/index.php?id='NEW'" class="action"><i class="fa fa-arrow-circle-right"></i></a></div>
            <div
                class="col-sm-6 col-md-4 item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="250"><a href="BossEvent/index.php?id=up"></a><i class="fa fa-link" id="event-icon-icon" style="background-color:rgba(255,255,255,0);color:gold;"></i>
                <h3 id="event4-title" class="name">Incoming Events</h3>
                <p id="event-description1" class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="BossEvent/index.php?id='UP'" class="action"><i class="fa fa-arrow-circle-right"></i></a></div>
        </div>
        </div>
        </div>
        <section id="business-logo" style="margin-top:30px;margin-bottom:30px;/*background-image:url(&quot;assets/img/maxresdefault.jpg&quot;);*/">
            <div class="intro">
                <h2 class="text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="150" data-aos-once="true" id="logo-title">Business Banner's</h2>
                <p class="text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200" data-aos-once="true" id="event-subtitle">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
            </div>
            <div class="row articles" id="b-logo-logo">
                <?php
				include 'db.php';
				$select=mysqli_query($conn,"select * from flyers_or_advertisement where status='Ongoing' limit 3");
				while($logo = mysqli_fetch_array($select)){
					$pic = $logo['picture'];
					echo '
					<div class="col-sm-6 col-md-4 item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="250"><a href="BossEvent/ads.php"><img class="img-fluid logo-style" src="boss-back/'.$pic.'" alt="Image Din Not Find"></a></div>
					';
				}
				?>
			</div>
        </section>
        <footer>
            <div class="row">
                <div class="col-sm-6 col-md-4 footer-navigation" data-aos="fade-up" data-aos-duration="700" data-aos-delay="150">
                    <h3><a href="#">Boss&nbsp;<span>Carss</span></a></h3>
                    <p class="links"><a href="#">Home</a><strong> · </strong><a href="#">Boss Events</a><strong> · </strong><a href="#">Newsfeed</a><strong> · </strong><a href="#">Shop</a><strong> · </strong><a href="#">Admin</a><strong> · </strong><a href="#">Video Gallery</a></p>
                    <p
<
                        class="company-name">Company Bossca © 2018</p>

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
                    <p><br>Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.<br><br>Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor
                        lacus vehicula sit amet.<br><br>Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit&nbsp;<br></p>
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

		<script>
        $(function () {
        $(document).scroll(function () {
            var $nav = $(".navbar");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
        });
        </script>
		</body>

</html>
