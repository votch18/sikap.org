<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIKAP, Inc.</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='icon' href='<?=base_url()?>filemanager/<?=$settings['site_favicon']?>' type='image/x-icon' >
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/elegant-fonts.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/swiper.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>/style.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>vendor/leaflet/leaflet.css" />

    <style>
        
       /* width */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            /*box-shadow: inset 0 0 5px grey;*/
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #e0b9a3;
        }

    </style>
     	
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.js'></script>
    <script src="<?= BASE_URL_THEME ?>vendor/leaflet/leaflet.js"></script>
</head>
<body class="single-page news-page">
    <header class="site-header">
        <div class="top-header-bar">
            <div class="container">
                <div class="row ">
                    <?php          
                        $flash = "";//array('title' => 'Welcome to sikap.org!', 'message' => 'The following contents are dummies only, and is intended for testing purposes. All contents can be found at facebook.com SIKAP Caraga Region page.');
                        if ( !empty($flash) ){
                            ?>
                                <div class="col-md-12 text-center">
                                        <h5 class="mb-0 text-center">
                                            <?=$flash['title']?>
                                        </h5>
                                        <span>
                                            <?=$flash['message']?>
                                        </span>
                                    </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style=" background-image: linear-gradient(-90deg, #A7B9CA, #DB9B75 70%);">
            <div style="width: calc(50% - 15px); padding: 15px; ">
                <a class="d-inline-block" href="<?=base_url()?>" rel="home" style="text-decoration: none;">
                    <img class="d-inline-block" src="<?=base_url().'filemanager/logo2.png'?>" style="height: auto; width: 100%; vertical-align: middle;" alt="logo">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText" style="width: 50%; font-size: 16px; font-weight: bold;">
                <ul class="navbar-nav ml-auto mr-auto align-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>About Us <i class="fa fa-chevron-down"></i></span>
                        </a>
                        <div class="dropdown-menu about-us" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/history">History</a>
                            <a class="dropdown-item" href="/vision">Vision</a>
                            <a class="dropdown-item" href="/mission">Mission</a>
                            <a class="dropdown-item" href="/goals">Goals</a>
                            <a class="dropdown-item" href="/core-values">Core Values</a>
                            <a class="dropdown-item" href="/approach">Approach</a>
                            <a class="dropdown-item" href="/strategic-direction">Strategic Direction</a>
                            <a class="dropdown-item" href="/members-of-the-board-of-trustees">Members of the Board of Trustees</a>
                            <a class="dropdown-item" href="/management-and-staff">Management and Staff</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/programs"><span>Programs & </span><span>Projects</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/news"><span>Features & </span><span>News</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/accreditations"><span>Accreditation & </span><span>Membership</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/awards"><span>Awards & </span><span>Recognition</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="top-border2"></div>


    </header>
