<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Gruppo15">
    <title>ShipSite</title>
    <link rel="stylesheet" href="styleindex.css" />
</head>

<body>
    <?php include_once 'header.php';?>

    <div class="slideshow-container">

    <!-- Slides -->
    <div class="mySlides fade">
        <img src="imgs/brt.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
        <img src="imgs/dhl.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
        <img src="imgs/gls.jpg" style="width:100%">
    </div>

    <!-- Punti/bottoni di navigazione -->
    <div class="dot-container">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
    </div>
    </div>
    
    <div class="headingAbout">
        <h1 id="about" >About Us</h1>
    </div>
    <section class="about-us1">
        <img src="imgs/aboutUs1.jpeg">
        <div class="contentAbout1">
        <p>Welcome to our shipping portal, the ideal place to connect users with a wide range of available couriers. We are here to simplify the shipping process by providing an intuitive and convenient platform that puts the power in your hands.</p>
        <br>
        <p>With our service, you can order a shipment quickly and easily. Just access our website, enter the shipment details, and choose from the available couriers. We are proud to offer you a wide selection of trusted couriers, each with their own rates and delivery times. Additionally, if you have a trusted courier that is not yet on our platform, you can easily add them.</p>
        <br>
        <p>One of the main advantages of our portal is the ability to track the progress of your shipment. Once you have placed the order, you will be constantly updated on the status of the shipment. Companies can send notifications to the user to inform them of important developments, such as the departure of the package, any delays, or successful delivery.</p>
        </div>
    </section>
    <section class="about-us2">
        <img src="imgs/aboutUs2.jpeg">
        <div class="contentAbout2">
        <p>Your experience as a user is our top priority. We understand that every shipment is unique and that your needs may vary. That's why we offer you the option to choose the courier you prefer. We know that trust is crucial when it comes to entrusting your packages to a courier, so we provide detailed information about each courier, including user reviews and ratings, to help you make the best decision.</p>
        <br>
        <p>We are here to simplify your life by offering you an efficient, transparent, and personalized shipping service. With our portal, you have complete control over your shipment, from choosing the courier to tracking the package. You no longer have to worry about endless phone calls or searching for fragmented information on different websites. We have everything you need in one place.</p>
        <br>
        <p>So, what are you waiting for? Start enjoying the benefits of our shipping portal today. Choose the courier you prefer, place your shipment order, and enjoy a stress-free and convenient experience. We are here to make your shipping process a breeze!</p>
        </div>
    </section>
    <?php include_once 'footer.html';?>
    <script type="text/javascript" src="scriptindex.js"></script>
</body>
</html>