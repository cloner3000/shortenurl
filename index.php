<?php
require 'connect.php';

function generateRandomString() 
{
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';

  for ($i = 0; $i < 5; $i++) 
  {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  
  return  $randomString;
}

$msg = "";

if(isset($_GET['r']) || !empty($_GET['r'])) {
    $id = $_GET['r'];

    $sql = $conn->query("SELECT real_url FROM link WHERE id = '$id'");
    $rows = $sql->fetch_assoc();

    if(mysqli_num_rows($sql) == 1) {
        $longslink = $rows['real_url'];
        header("Location:".$longslink);
    } else {
        header("Location:".$site['root']);
    }
}

if(isset($_POST["pendekin"])) {
    $real_link = $conn->real_escape_string($_POST['real_link']);

    $sql = $conn->query("SELECT real_url FROM link WHERE real_url = '$real_link'");
    $rows = $sql->fetch_assoc();

    if(mysqli_num_rows($sql) == 0) {
        if(!filter_var($_POST['real_link'], FILTER_VALIDATE_URL) == FALSE) {
            $url_id = generateRandomString();
            $shortner = $site['root']. "" . $url_id;

            $query = $conn->query("INSERT INTO link VALUES ('$url_id','$real_link','$shortner','0','$date $time')");
            if($query) {
                $msg = "<strong>Your short URL is : </strong> $shortner";
            } else {
                $msg = "System error";
            }
        } else {
            $msg = $real_link ."Not valid URL";
        }
    } else {
        $msg = "SORRY This url already exist";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminto/layouts/landing/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2019 19:34:05 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Shortlink Free For Blogger</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

        <!--Material Icon -->
        <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css" />
    
        <!--pe-7 Icon -->
        <link rel="stylesheet" type="text/css" href="css/pe-icon-7-stroke.css" />

        <!-- Magnific-popup -->
        <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">

        <!-- Custom  sCss -->
        <link rel="stylesheet" type="text/css" href="css/style.css" />

    </head>

    <body>

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="index.html">
                    <h1 class="logo-light text-white" height="18">ShortlinkFree</h1>
                    <h1 class="logo-dark" height="18">ShortlinkFree</h1>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                        <li class="nav-item active">
                            <a href="#home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#features" class="nav-link">Features</a>
                        </li>
                        <li class="nav-item">
                            <a href="#clients" class="nav-link">Clients</a>
                        </li>   
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- home start -->
        <section class="bg-home bg-gradient" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="home-title text-white">
                                    <h5 class="mb-3 text-white-50">Gunakan pemendek url gratis</h5>
                                    <form class="form-horizontal" method="POST">
                                        <?php if($msg): ?>
                                            <div class="alert alert-danger">
                                                <?php echo $msg; ?>
                                            </div>
                                        <?php endif; ?>
                                        <input type="text" name="real_link" class="form-control" placeholder="Masukkan url mu disini" name="url">
                                            <div class="watch-video mt-5">
                                                <button type="submit" name="pendekin"  class="btn btn-custom mr-4">Pendekkan</button>
                                            </div>
                                    </form>
    
                                </div>
                            </div>
                            <div class="col-lg-5 offset-lg-1 col-sm-6">
                                <div class="home-img mo-mt-20">
                                    <img src="images/home-img.png" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div>
                    <!-- end container-fluid -->
                </div>
            </div>
        </section>
        <!-- home end -->

        <!-- features start -->
        <section class="features" id="features">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified features-tab mb-5" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="pills-code-tab" data-toggle="pill" href="#pills-code" role="tab" aria-controls="pills-code" aria-selected="true">
                                    <div class="clearfix">
                                        <div class="features-icon float-right">
                                            <i class="pe-7s-notebook h1"></i>
                                        </div>
                                        <div class="d-none d-lg-block mr-4">
                                            <h5>Mudah digunakan</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-customize-tab" data-toggle="pill" href="#pills-customize" role="tab" aria-controls="pills-customize" aria-selected="false">
                                    <div class="clearfix">
                                        <div class="features-icon float-right">
                                            <i class="pe-7s-edit h1"></i>
                                        </div>
                                        <div class="d-none d-lg-block mr-4">
                                            <h5>Link yang berkualitas</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-support-tab" data-toggle="pill" href="#pills-support" role="tab" aria-controls="pills-support" aria-selected="false">
                                    <div class="clearfix">
                                        <div class="features-icon float-right">
                                            <i class="pe-7s-headphones h1"></i>
                                        </div>
                                        <div class="d-none d-lg-block mr-4">
                                            <h5>Bantuan jika ada kendala</h5>
                                        </div> 
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="pills-code" role="tabpanel" aria-labelledby="pills-code-tab">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <img src="images/features-img/img-1.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 offset-lg-1">
                                        <div>
                                            <div class="feature-icon mb-4">
                                                <i class="pe-7s-notebook h1 text-primary"></i>
                                            </div>
                                            <h5 class="mb-3">Quality Code</h5>
                                            <p class="text-muted">It will be as simple as Occidental in fact, it will be Occidental. To an English person it will seem like simplified English as a skeptical Cambridge.</p>
                                            <p class="text-muted">If several languages coalesce the grammar of the resulting language </p>
                                            <div class="row pt-4">
                                                <div class="col-lg-6">
                                                    <div class="text-muted">
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> Nemo enim ipsam quia</p>
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> Ut enim ad minima</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-muted">
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> At vero eos accusamus et </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <!-- end row -->
                            </div>
                            <div class="tab-pane fades how active" id="pills-customize" role="tabpanel" aria-labelledby="pills-customize-tab">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <img src="images/features-img/img-2.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 offset-lg-1">
                                        <div>
                                            <div class="feature-icon mb-4">
                                                <i class="pe-7s-edit h1 text-primary"></i>
                                            </div>
                                            <h5 class="mb-3">Easy to customize</h5>
                                            <p class="text-muted">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et</p>
                                            <p class="text-muted">If several languages coalesce the grammar of the resulting language </p>
                                            <div class="row pt-4">
                                                <div class="col-lg-6">
                                                    <div class="text-muted">
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> Nemo enim ipsam quia</p>
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> Ut enim ad minima</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-muted">
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> At vero eos accusamus et </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                            <div class="tab-pane fade" id="pills-support" role="tabpanel" aria-labelledby="pills-support-tab">
                                
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <img src="images/features-img/img-3.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 offset-lg-1">
                                        <div>
                                            <div class="feature-icon mb-4">
                                                <i class="pe-7s-headphones h1 text-primary"></i>
                                            </div>
                                            <h5 class="mb-3">Awesome Support</h5>
                                            <p class="text-muted">It will be as simple as Occidental in fact, it will be Occidental. To an English person it will seem like simplified English as a skeptical Cambridge.</p>
                                            <p class="text-muted">If several languages coalesce the grammar of the resulting language </p>
                                            <div class="row pt-4">
                                                <div class="col-lg-6">
                                                    <div class="text-muted">
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> Nemo enim ipsam quia</p>
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> Ut enim ad minima</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-muted">
                                                        <p><i class="mdi mdi-checkbox-marked-outline text-primary mr-2 h6"></i> At vero eos accusamus et </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                        <!-- end tab-content -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </section>
        <!-- features end -->
        
        <!-- clients start -->
        <section class="section bg-light" id="clients">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="title text-center mb-4">
                            <h6 class="text-primary small-title">Clients</h6>
                            <h4>What our Users Says</h4>
                            <p class="text-muted">At solmen va esser far uniform grammatica.</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testi-box p-4 bg-white mt-4 text-center">
                            <p class="text-muted mb-4">" The designer of this theme delivered a quality product. I am not a front-end developer and I hate when the theme I download has glitches or needs minor tweaks here and there. This worked for my needs just out of the boxes. Also, it is fast and elegant."</p>
                            <div class="testi-img mb-4">
                                <img src="images/testi/img-1.png" alt="" class="rounded-circle img-thumbnail">
                            </div>
                            <p class="text-muted mb-1"> - Adminto User</p>
                            <h5 class="font-18">Xpanta</h5>
                            
                            <div class="testi-icon">
                                <i class="mdi mdi-format-quote-open display-2"></i>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testi-box p-4 bg-white mt-4 text-center">
                            <p class="text-muted mb-4">"  Extremely well designed and the documentation is very well done. Super happy with the purchase and definitely recommend this! "</p>
                            <div class="testi-img mb-4">
                                <img src="images/testi/img-2.png" alt="" class="rounded-circle img-thumbnail">
                            </div>
                            <p class="text-muted mb-1"> - Adminto User</p>
                            <h5 class="font-18">G_Sam</h5>
                            
                            <div class="testi-icon">
                                <i class="mdi mdi-format-quote-open display-2"></i>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testi-box p-4 bg-white mt-4 text-center">
                            <p class="text-muted mb-4">"  We used this theme to save some design time but... wow it has everything you didn't realize you would need later. I highly recommend this template to get your web design headed in the right direction quickly.  "</p>
                            <div class="testi-img mb-4">
                                <img src="images/testi/img-3.png" alt="" class="rounded-circle img-thumbnail">
                            </div>
                            <p class="text-muted mb-1"> - Adminto User</p>
                            <h5 class="font-18">Isaacfab</h5>
                            
                            <div class="testi-icon">
                                <i class="mdi mdi-format-quote-open display-2"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mt-5 pt-5">
                    <div class="col-lg-3 col-sm-6">
                        <div class="client-images">
                            <img src="images/clients/1.png" alt="logo-img" class="mx-auto img-fluid d-block">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="client-images">
                            <img src="images/clients/2.png" alt="logo-img" class="mx-auto img-fluid d-block">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="client-images">
                            <img src="images/clients/3.png" alt="logo-img" class="mx-auto img-fluid d-block">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="client-images">
                            <img src="images/clients/4.png" alt="logo-img" class="mx-auto img-fluid d-block">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container-fluid -->
        </section>
        <!-- clients end -->

        <!-- counter start -->
        <section class="section bg-gradient">
            <div class="container-fluid">
                <div class="row" id="counter">
                    <div class="col-lg-3 col-sm-6">
                        <div class="text-center p-3">
                            <div class="counter-icon text-white-50 mb-4">
                                <i class="pe-7s-add-user display-4"></i>
                            </div>
                            <div class="counter-content text-white">
                                <h2 class="counter-value mb-3" data-count="1200">0</h2>
                                <h5 class="counter-name">Fans</h5>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-3 col-sm-6">
                        <div class="text-center p-3">
                            <div class="counter-icon text-white-50 mb-4">
                                <i class="pe-7s-cart display-4"></i>
                            </div>
                            <div class="counter-content text-white">
                                <h2 class="mb-3"><span class="counter-value" data-count="1500">10</span> +</h2>
                                <h5 class="counter-name">Total Sales</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="text-center p-3">
                            <div class="counter-icon text-white-50 mb-4">
                                <i class="pe-7s-smile display-4"></i>
                            </div>
                            <div class="counter-content text-white">
                                <h2 class="counter-value mb-3" data-count="6931">608</h2>
                                <h5 class="counter-name">Happy Clients</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="text-center p-3">
                            <div class="counter-icon text-white-50 mb-4">
                                <i class="pe-7s-medal display-4"></i>
                            </div>
                            <div class="counter-content text-white">                       
                                <h2 class="counter-value mb-3" data-count="800">2</h2>
                                <h5 class="counter-name">Won Prices</h5>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </section>
        <!-- counter end -->

        <!-- contact start -->
        <section class="section" id="contact">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="title text-center mb-5">
                            <h6 class="text-primary small-title">Contact</h6>
                            <h4>Have any Questions ?</h4>
                            <p class="text-muted">At solmen va esser far uniform grammatica.</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="get-in-touch">
                            <h5>Get in touch</h5>
                            <p class="text-muted mb-5">At solmen va esser necessi far</p>

                            <div class="mb-3">
                                <div class="get-touch-icon float-left mr-3">
                                    <i class="pe-7s-mail h2 text-primary"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h5 class="font-16 mb-0">E-mail</h5>
                                    <p class="text-muted">example@abc.com</p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="get-touch-icon float-left mr-3">
                                    <i class="pe-7s-phone h2 text-primary"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h5 class="font-16 mb-0">Phone</h5>
                                    <p class="text-muted">012-345-6789</p>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="get-touch-icon float-left mr-3">
                                    <i class="pe-7s-map-marker h2 text-primary"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h5 class="font-16 mb-0">Address</h5>
                                    <p class="text-muted">20 Rollins Road Cotesfield, NE 68829</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="custom-form bg-white">
                            <div id="message"></div>
                            <form method="post" action="https://coderthemes.com/adminto/layouts/landing/php/contact.php" name="contact-form" id="contact-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input name="name" id="name" type="text" class="form-control" placeholder="Enter your name...">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Enter your email...">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input name="subject" id="subject" type="text" class="form-control" placeholder="Enter Subject...">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="comments">Message</label>
                                            <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Enter your message..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-12 text-right">
                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-custom" value="Send Message">
                                        <div id="simple-msg"></div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                        <!-- end custom-form -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </section>
        <!-- contact end -->

        <!-- footer start -->
        <footer class="footer bg-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="text-center">
                            <div class="footer-logo mb-3">
                                <img src="images/logo-light.png" alt="" height="20">
                            </div>
                            <ul class="list-inline footer-list text-center mt-5">
                                <li class="list-inline-item"><a href="#">Home</a></li>
                                <li class="list-inline-item"><a href="#">About</a></li>
                                <li class="list-inline-item"><a href="#">Services</a></li>
                                <li class="list-inline-item"><a href="#">Clients</a></li>
                                <li class="list-inline-item"><a href="#">Pricing</a></li>
                                <li class="list-inline-item"><a href="#">Contact</a></li>
                            </ul>
                            <ul class="list-inline social-links mb-4 mt-5">
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-google-plus"></i></a></li>
                            </ul>
                            <p class="text-white-50 mb-4">2016 - 2019 © Adminto. Design by <a href="#" target="_blank" class="text-white-50">Coderthemes</a> </p>
                            
                        </div>
                    </div>
                
                </div>

            </div>
        </footer>
        <!-- footer end -->

        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

        
        <!-- javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        
        <!-- Magnific Popup -->
        <script src="js/jquery.magnific-popup.min.js"></script>

        <!-- counter js -->
        <script src="js/counter.int.js"></script>

        <!-- custom js -->
        <script src="js/app.js"></script>
    </body>


<!-- Mirrored from coderthemes.com/adminto/layouts/landing/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2019 19:34:19 GMT -->
</html>