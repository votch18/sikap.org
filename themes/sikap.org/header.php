<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIKAP, Inc.</title>

    <meta charset="utf-8">
    <meta http-equiv="Cache-control" content="public">
    <meta name="descripton" content="<?=$settings['site_desc']?>">
    <meta name="keywords" content="<?=$settings['site_tags']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='icon' href='<?=base_url()?>filemanager/<?=$settings['site_logo']?>' type='image/x-icon' >
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/elegant-fonts.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>css/swiper.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_THEME ?>style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="anonymous" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin="anonymous"></script>
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
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>About Us <i class="fa fa-chevron-down" style="font-size: 12px; font-weight: normal;"></i></span>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>Programs & </span><span>Projects <i class="fa fa-chevron-down" style="font-size: 12px; font-weight: normal;"></i></span>
                        </a>
                        <div class="dropdown-menu about-us" aria-labelledby="navbarDropdownMenuLink">
                            <ul style="list-style: none; padding-left: 10px;">
                                <?php
                                $cat = "";
                                foreach($programs as $row) {
                                if ($cat == "" && $cat != $row["program_category"]){
                                $cat = $row["program_category"];
                                ?>
                                <li><a href="/programs/?category=<?=$row['category_url']?>"><?=$row['program_category']?></a>
                                    <a class="dropdown-item" href="/programs/<?=$row["slug"]?>"><?=$row['title']?></a>
                                    <?php
                                    }elseif($cat != $row["program_category"]){
                                    $cat = $row["program_category"];
                                    ?>
                                </li>
                                <li><a href="/programs/?category=<?=$row['category_url']?>"><?=$row['program_category']?></a>
                                    <a class="dropdown-item" href="/programs/<?=$row["slug"]?>"><?=$row['title']?></a>
                                    <?php
                                        }else{
                                            ?>
                                        <a class="dropdown-item" href="/programs/<?=$row["slug"]?>"><?=$row['title']?></a>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        }
                                        ?>
                                </li>
                            </ul>
                        </div>
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
