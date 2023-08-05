<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <title>Elang Fresh Meat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!-- 
    Compass Template
    http://www.templatemo.com/tm-454-compass
    -->
    <meta charset="UTF-8">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- CSS Bootstrap & Custom -->
    <link href="<?= base_url('landing/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="<?= base_url('landing/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('landing/css/templatemo-misc.css') ?>">
    <link rel="stylesheet" href="<?= base_url('landing/css/animate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('landing/css/templatemo-main.css') ?>">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url('landing/images/ico/favicon.ico') ?>">
    <style>
        /* styles.css */
        #whatsapp-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 50px;
            height: 50px;
            /* WhatsApp green color */
            border-radius: 50%;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.3);
        }

        #whatsapp-button:hover {
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.5);
        }

        #whatsapp-button img {
            display: block;
            width: 40px;
            height: 40px;
            margin: 5px;
            /* Center the WhatsApp icon inside the button */
        }
    </style>

    <!-- JavaScripts -->
    <script src="<?= base_url('landing/js/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?= base_url('landing/js/modernizr.js') ?>"></script>
    <!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
        </div>
    <![endif]-->
</head>

<body>

    <div id="home">
        <div class="site-header">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="left-header">
                                <span><i class="fa fa-phone"></i>0831-4240-4000</span>
                                <span><i class="fa fa-instagram"></i>elangfarm_freshmeat</span>
                            </div> <!-- /.left-header -->
                        </div> <!-- /.col-md-6 -->
                        <div class="col-md-6 col-sm-6">
                            <div class="right-header text-right">
                                <ul class="social-icons">
                                    <li><a href="<?= base_url('auth/login') ?>" class="fa fa-sign-in"></a></li>
                                </ul>
                            </div> <!-- /.left-header -->
                        </div> <!-- /.col-md-6 -->
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
            </div> <!-- /.top-header -->
            <div class="main-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="logo">
                                <h1><a href="#" title="Dreri">Elang Fresh Meat</a></h1>
                            </div> <!-- /.logo -->
                        </div> <!-- /.col-md-4 -->
                        <div class="col-md-8 col-sm-8 col-xs-6">
                            <div class="menu text-right hidden-sm hidden-xs">
                                <ul>
                                    <li><a href="#home">Beranda</a></li>
                                    <li><a href="#services">Pelayanan</a></li>
                                    <li><a href="#portfolio">Produk Terlaris</a></li>
                                    <li><a href="#about">Toko Kami</a></li>
                                    <li><a href="#contact">Alamat</a></li>
                                </ul>
                            </div> <!-- /.menu -->
                        </div> <!-- /.col-md-8 -->
                    </div> <!-- /.row -->
                    <div class="responsive-menu text-right visible-xs visible-sm">
                        <a href="#" class="toggle-menu fa fa-bars"></a>
                        <div class="menu">
                            <ul>
                                <li><a href="#home">Beranda</a></li>
                                <li><a href="#services">Pelayanan</a></li>
                                <li><a href="#portfolio">Produk Terlaris</a></li>
                                <li><a href="#about">Toko Kami</a></li>
                                <li><a href="#contact">Alamat</a></li>
                            </ul>
                        </div> <!-- /.menu -->
                    </div> <!-- /.responsive-menu -->
                </div> <!-- /.container -->
            </div> <!-- /.header -->
        </div> <!-- /.site-header -->
    </div> <!-- /#home -->

    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="<?= base_url('landing/images/banner01.jpg"') ?> alt="">
                <div class=" flex-caption">
    </div>
    </li>
    <li>
        <img src="<?= base_url('landing/images/banner02.jpg"') ?> alt="">
                <div class=" flex-caption">
        </div>
    </li>
    <li>
        <img src="<?= base_url('landing/images/banner03.jpg"') ?> alt="">
                <div class=" flex-caption">
        </div>
    </li>
    </ul>
    </div>

    <div id="services" class="section-cotent">
        <div class="container">
            <div class="title-section text-center">
                <h2>Pelayanan Kami</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-trash-o"></i>
                            <!--font awesome toko-->
                            <h3>Tempat bersih</h3>
                        </div>
                        <div class="service-description">
                            Toko kami menjamin kebersihan tempat penyimpanan serta pelayanan bagi para pembeli.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-shopping-cart"></i>
                            <h3>Persediaan Lengkap</h3>
                        </div>
                        <div class="service-description">
                            Toko kami menjamin tersedianya stok yang lengkap bagi para pembeli.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-heart-o"></i>
                            <h3>Pelayanan ramah</h3>
                        </div>
                        <div class="service-description">
                            Toko kami menjamin pelayanan yang baik, ramah dan cepat bagi para pembeli.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-check-circle"></i>
                            <!--fontawesome package-->
                            <h3>Produk Terjamin</h3>
                        </div>
                        <div class="service-description">
                            Toko kami menjamin produk yang terjual merupakan produk yang higienis dan halal untuk dikonsumsi.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#services -->

    <div id="portfolio" class="section-content">
        <div class="container">
            <div class="title-section text-center">
                <h2>PRODUK TERLARIS</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item1.jpg') ?>" alt="Produk 1">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item1.jpg') ?>">Saus Bumbu Barbeque 100ml </a></h4>
                                <span>Rp 13.500</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item2.jpg') ?>" alt="Produk 2">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item2.jpg') ?>">Slice Belly 400 gram</a></h4>
                                <span>Rp 85.000</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item3.jpg') ?>" alt="Produk 3">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item3.jpg') ?>">Saus Bulgogi 100ml</a></h4>
                                <span>Rp 13.000</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item4.jpg') ?>" alt="Produk 4">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item4.jpg') ?>">Slice Premium 400 gram</a></h4>
                                <span>Rp 90.000</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item5.jpg') ?>" alt="Produk 5">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item5.jpg') ?>">Mister Max Sosis Bakar (10+1) 500 gram</a></h4>
                                <span>Rp 32.500</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item6.jpg') ?>" alt="Produk 6">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item6.jpg') ?>">Daging Sapi Segar</a></h4>
                                <span>Rp 170.000/kg</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item7.jpg') ?>" alt="Produk 7">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item7.jpg') ?>">Dada Ayam Boneless 500 gram</a></h4>
                                <span>Rp 45.000</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="<?= base_url('landing/images/produk/item8.jpg') ?>" alt="Produk 8">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="<?= base_url('landing/images/produk/item8.jpg') ?>">Tenderloin Meltique ±200 gram</a></h4>
                                <span>Rp 48.000</span>
                            </div>
                        </div> <!-- /.overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#portfolio -->

    <div id="about" class="section-cotent">
        <div class="container">
            <div class="title-section text-center">
                <h2>TOKO KAMI</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-8">
                    <h4 class="widget-title">Tentang Toko</h4>
                    <p>Elang Fresh Meat merupakan sebuah usaha bisnis yang bergerak pada bidang penjualan daging sapi, daging ayam serta frozen food di kota Banjarbaru.
                        Usaha bisnis ini didirikan dari tahun 2020. Penjualan daging di toko ini menjamin kesegaran dan keaslian dari daging serta frozen food kepada konsumen.
                        Saat ini Elang Fresh Meat beralamat di Jl. Karang Anyar 1 No.2, RW.01, Loktabat Utara, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70714</p>
                </div> <!-- /.col-md-3 -->
                <div class="col-md-4 our-skills">
                    <h4 class="widget-title">Rating Toko</h4>
                    <!--bintang 4,5 toko-->
                    <ul class="progess-bars">

                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-full"></i> 4.5
                    </ul>
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="our-team">
                    <div class="col-md-4 col-sm-6">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="<?= base_url('landing/images/team/toko-1.jpg') ?>" alt="Tracy">
                                <div class="overlay">
                                    <ul class="social">
                                        <li><a href="#" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div> <!-- /.overlay -->
                            </div>
                            <div class="inner-content">
                                <h5>Tampak Depan</h5>
                                <span>Elang Fresh Meat</span>
                            </div>
                        </div> <!-- /.team-member -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="<?= base_url('landing/images/team/toko-2.jpg') ?>" alt="Mary">
                                <div class="overlay">
                                    <ul class="social">
                                        <li><a href="#" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div> <!-- /.overlay -->
                            </div>
                            <div class="inner-content">
                                <h5>Tampak Etalase</h5>
                                <span>Elang Fresh Meat</span>
                            </div>
                        </div> <!-- /.team-member -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="<?= base_url('landing/images/team/toko-3.jpg') ?>" alt="Julia">
                                <div class="overlay">
                                    <ul class="social">
                                        <li><a href="#" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div> <!-- /.overlay -->
                            </div>
                            <div class="inner-content">
                                <h5>Tampak Kasir</h5>
                                <span>Elang Fresh Meat</span>
                            </div>
                        </div> <!-- /.team-member -->
                    </div> <!-- /.col-md-4 -->
                </div> <!-- /.our-team -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#about -->

    <div id="contact" class="section-cotent">
        <div class="container">
            <div class="title-section text-center">
                <h2>Alamat Kami</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-7 col-sm-6">
                    <div class="map-holder">
                        <div class="google-map-canvas" id="map-canvas" style="height: 250px;">
                        </div>
                    </div> <!-- /.map-holder -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-5 col-sm-6">
                    <div class="contact-info">
                        <span><i class="fa fa-map-marker"></i>Jl. Karang Anyar 1 No.2, RW.01, Loktabat Utara, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70714</span>
                        <span><i class="fa fa-phone"></i>0831-4240-4000</span>
                        <span><i class="fa fa-instagram"></i>elangfarm_freshmeat</span>
                    </div>
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#contact -->
    <!-- Floating WhatsApp Button -->
    <div id="whatsapp-button">
        <a href="https://wa.me/6283142404000" target="_blank">
            <img src="<?= base_url('assets/images/whatsapp.png') ?>" alt="Whatsapp">
        </a>
    </div>

    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <p>Copyright &copy; Elang Fresh Meat</p>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="go-top">
                        <a href="#" id="go-top">
                            <i class="fa fa-angle-up"></i>
                            Kembali ke atas
                        </a>
                    </div>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    <script src="<?= base_url('landing/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('landing/js/plugins.js') ?>"></script>
    <script src="<?= base_url('landing/js/jquery.lightbox.js') ?>"></script>
    <script src="<?= base_url('landing/js/custom.js') ?>"></script>
    <script type="text/javascript">
        const whatsappButton = document.getElementById('whatsapp-button');

        // Show the WhatsApp button after scrolling down a bit
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                whatsappButton.style.display = 'block';
            } else {
                whatsappButton.style.display = 'none';

            }
        });

        function initialize() {
            var mapOptions = {
                scrollwheel: false,
                zoom: 25,
                center: new google.maps.LatLng(-3.4342994, 114.8085662)
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
        }

        function loadScript() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
                'callback=initialize';
            document.body.appendChild(script);
        }

        window.onload = loadScript;
    </script>

</body>

</html>
