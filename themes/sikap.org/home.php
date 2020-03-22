    <div class="swiper-container hero-slider">
        <div class="swiper-wrapper">

            <?php 
            foreach($slider as $row) {
            ?>
            <div class="swiper-slide hero-content-wrap">
                <img src="<?=$row['featured_img']?>" alt="">

                <div class="hero-content-overlay position-absolute w-100 h-100">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-start">
                                <header class="entry-header">
                                    <h1><?=$row['title']?></h1>
                                </header>

                                <div class="entry-content mt-4">
                                    <p><?=$row['description']?></p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

        <div class="pagination-wrap position-absolute w-100">
            <div class="container">
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="swiper-button-next flex justify-content-center align-items-center">
            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
        </div>

        <div class="swiper-button-prev flex justify-content-center align-items-center">
            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg></span>
        </div>
    </div>

    <div class="home-page-events">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="upcoming-events">
                        <div class="section-heading">
                            <h2 class="entry-title">News and Updates</h2>
                        </div>

                        <?php
                            $featured_news = array_slice($news, 0, 1)[0];
                            $news =  array_slice($news, 1, 3);
                            foreach($news as $row) {
                        ?>
                        <div class="event-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                                <img src="<?=$row['featured_img']?>" alt="">
                            </figure>

                            <div class="event-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="<?=base_url().'news/'.$row['slug']?>"><?=$row['title']?></a></h3>

                                    <div class="posted-date">
                                        <a href="#"><?= date_format(new DateTime($row['date']), 'F d, Y'); ?></a>
                                    </div>
                                </header>

                                <div class="entry-content">
                                    <p class="m-0"><?=substr(strip_tags($row['post']), 0, 250)?></p>
                                </div>

                                <div class="entry-footer">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        ?>

                    </div>
                </div>
                
                <div class="col-12 col-lg-6">
                    <?php
                    if ( !empty($featured_news) ) {
                    ?>
                    <div class="featured-cause">
                        <div class="section-heading">
                            <h2 class="entry-title">Featured News</h2>
                        </div>

                        <div class="cause-wrap">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?=$featured_news['featured_img']?>" alt="<?=$featured_news['title']?>" class="img-fluid">
                                </div>
                                <div class="col-md-7">
                                    <div class="cause-content-wrap">
                                        <header class="entry-header">                                   
                                            <h3 class="entry-title w-100 m-0"><a href="<?=base_url().'news/'.$featured_news['slug']?>"><?=$featured_news['title']?></a></h3>
                                            <div class="posted-date">
                                                <a href="#"><?= date_format(new DateTime($featured_news['date']), 'F d, Y'); ?></a>
                                            </div>
                                    
                                        </header>

                                        <div class="entry-content">
                                            <p class="m-0"><?=substr(strip_tags($featured_news['post']), 0, 250)?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>



    <div class="our-causes">
        <div class="container">
            <div class="row">
                <div class="coL-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Programs and Projects</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="swiper-container causes-slider">
                        <div class="swiper-wrapper">

                            <?php
                                foreach($programs as $row) {
                            ?>
                            <div class="swiper-slide">
                                <div class="cause-wrap">
                                    <figure class="m-0">
                                        <img src="<?=$row['featured_img']?>" alt="">

                                        <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                            <a href="#" class="btn gradient-bg mr-2">Read More</a>
                                        </div>
                                    </figure>

                                    <div class="cause-content-wrap">
                                        <header class="entry-header d-flex flex-wrap align-items-center">
                                            <h3 class="entry-title w-100 m-0"><a href="#"><?=$row['title']?></a></h3>
                                        </header>

                                        <div class="entry-content">
                                            <p class="m-0"><?=substr(strip_tags($row['post']), 0, 250)?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <?php
                                }
                            ?>
                        
                        </div>

                    </div>

                    <div class="swiper-button-next flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
                    </div>

                    <div class="swiper-button-prev flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-page-limestone">
        <div class="container">
            <div class="row align-items-center">
                <div class="coL-12 col-lg-6">
                    <div class="section-heading">
                        <h2 class="entry-title">About us</h2>

                        <p class="mt-5"><?=$settings['site_about']?></p>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
					 <div id="mapid" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>



	<script>

		//--Start map init
		var map = L.map('mapid').setView([8.502448, 125.978988], 15);

		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoidm90Y2gxOCIsImEiOiJjazM2dHhucmQwNTMzM2NubmR3dHduZHh2In0.CXezVIToRZsnx42HZJNQVw', {
			maxZoom: 15,
            zoomControl: false, 
			id: 'mapbox.streets',
			accessToken: 'pk.eyJ1Ijoidm90Y2gxOCIsImEiOiJjazM2dHhucmQwNTMzM2NubmR3dHduZHh2In0.CXezVIToRZsnx42HZJNQVw',       
		}).addTo(map);
		
		L.marker([8.502448, 125.978988]).addTo(map)
		.bindPopup('<div style="text-align: center;"><img src="<?=base_url().'filemanager/'.$settings['site_logo']?>" style="height: 40px; width: 40px;" alt="SIKAP logo"><br><?=$settings['site_name']?><br> <?=$settings['address']?></div>')
		.openPopup();

	</script>
	
