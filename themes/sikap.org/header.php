<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIKAP, Inc.</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='icon' href='<?=base_url()?>filemanager/<?=$settings['site_favicon']?>' type='image/x-icon' >
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/style.css">
	
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>vendor/leaflet/leaflet.css" />

     	
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.js'></script>
    <script src="<?= BASE_URL_THEME ?>vendor/leaflet/leaflet.js"></script>
</head>
<body class="single-page news-page">
    <header class="site-header">
		<div class="top-border"></div>
        <div class="top-header-bar">
            <div class="container">
                <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                    
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .top-header-bar -->

        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-inline-block" href="index.html" rel="home" style="text-decoration: none;">
						   <img class="d-inline-block" src="<?=base_url().'filemanager/'.$settings['site_logo']?>" style="height: 80px; width: 80px; vertical-align: middle;" alt="logo">
						   <h3 class="d-inline-block m-0" style="vertical-align: middle; font-weight: bold;">SIKAP, Inc.</h3>
						   </a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <?php
                                
                                    foreach($pages as $row) {
                                ?>
                                
                                <li class="<?= $row['url'] == $url ? 'current-menu-item' : ''?> "><a href="<?= BASE_URL.$row['url']?>"><?=ucwords($row['name'])?></a></li>
                                <?php
}
                                ?>
                                
                            </ul>
                        </nav><!-- .site-navigation -->

                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->
    </header><!-- .site-header -->
