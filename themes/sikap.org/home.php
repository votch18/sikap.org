   <div style="margin: 20px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="program-category">
                        <ul class="list-inline">
                            <li class="list-inline-item" style="border-color: violet; padding: 10px;">
                                <a href="/programs/?category=women-children-and-family-development">Women, Children & Family Development</a>
                            </li>
                            <li class="list-inline-item" style="border-color: red;  padding: 10px;">
                                <a href="/programs/?category=indigenous-peoples-development">Indigenous Peoples Development</a>
                            </li>
                            <li class="list-inline-item" style="border-color: blue;  padding: 10px;">
                                <a href="/programs/?category=good-local-governance">Good Local Governance</a>
                            </li>
                        </ul>
                        <ul class="list-inline">         
                            <li class="list-inline-item" style="border-color: green;  padding: 10px;">
                                <a href="/programs/?category=rural-livelihood-and-enterprise-development">Rural Livelihood & Enterprise Development</a>
                            </li>
                            <li class="list-inline-item" style="border-color: orange;  padding: 10px;">
                                <a href="/programs/?category=disaster-risk-reduction-climate-change-adaptation">Disaster Risk Reduction/Climate Change Adaptation</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="upcoming-events">                      
                        <div class="swiper-container hero-slider">
                            <div class="swiper-wrapper">
                                <?php
                                foreach($slider as $row) {
                                    ?>
                                    <div class="swiper-slide hero-content-wrap">
                                        <img src="<?=$row['featured_img']?>" alt="">

                                        <div class="hero-content-overlay position-absolute w-100">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12 d-flex flex-column justify-content-end align-items-end">
                                                        <header class="entry-header text-right">
                                                            <h6><?=$row['title']?></h6>
                                                        </header>
														
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="our-causes" style="padding: 56px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="featured-cause">
                        <div class="section-heading">
                            <h2 class="entry-title" style="height: 85px; vertical-align: text-bottom;">Vision, Mission & Goals</h2>
                        </div>

                        <div>							 
                            <div class="row">
								 <div class="col-12">
									<div style="height: 250px; width: 100%; overflow: hidden!important; 
												background-image: url('filemanager/ABOUT_US/sikap_approach.webp');
												background-size: auto 100%;
												background-position:center;
												background-repeat:no-repeat;
												background-color: #fff;
												border-bottom: 1px solid #e2e2e2;">
									</div>                                   
                                </div>
                                <div class="col-12">
									<div class="cause-content-wrap" style="padding-bottom: 17px!important;">
										<h5>Vision</h5>
										<p>A Self-Sustaining Human Development Institution in an Empowered, Just and Accountable Society.</p>
										<br/>
										<h5>Mission</h5>
										<p>
											SIKAP is a leading resource organization in attaining and promoting:
										
											<ul>
												<li>Holistic and Sustainable Development</li>
												<li>Climate and Disaster Resiliency</li>
												<li>Gender and Culture Sensitivity</li>
												<li>Good Governance</li>                                            
											</ul>
										</p>
										<br/>
										<h5>Goals</h5>
										<ol>
											<li >Established responsible communities characterized by peace, sustained productivity, and disaster resiliency.
											</li><li >Empowered communities benefiting and facilitating social protection, health and education services, gender equity and good governance.
											</li><li>Established strong partnership with different stakeholders in the delivery of pro-active development initiatives.
											</li><li>Promoted spirit of volunteerism and service, citizen participation, and people development.
											</li><li>Attained organizational viability and stability characterized by sustained implementation of development interventions, presence of committed and competent staff, and financial liquidity.
											</li>
										</ol> 
                                	</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <?php
                    $featured_programs = $programs; 
            
                    if ( !empty($featured_programs) ) {
						
                    ?>
					
                    <div class="featured-cause">
                        <div class="section-heading">
                            <h2 class="entry-title" style="height: 85px; vertical-align: text-bottom;">Featured Programs </h2>
                        </div>
						<?php
                        $count = 0;
						foreach($featured_programs as $featured_program) {
						    if (!empty($featured_program['featured_img']) && $count < 2){
                                $count++;
						?>

                        <div class="mb-5">
                            <div class="row">
                                <div class="col-12">
									<div style="height: 250px; width: 100%; overflow: hidden!important; 
												background-image: url(<?=$featured_program['featured_img']?>);
												background-size:cover;
												background-position:center;
												background-repeat:no-repeat;">
									</div>                                   
                                </div>
                                <div class="col-12">
                                    <div class="cause-content-wrap" style="height: 400px;">
                                        <header class="entry-header">                                   
                                            <h3 class="entry-title w-100 m-0"><a href="<?=base_url().'programs/'.$featured_program['slug']?>"><?=$featured_program['title']?></a></h3>
                                            <div class="posted-date">
                                               
                                            </div>
                                    
                                        </header>

                                        <div class="entry-content">
                                            <p class="m-0"><?=substr(strip_tags($featured_program['post']), 0, 300)?>...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
						 <?php
                            }
						}
                   		 ?>
                    </div>
                    <?php
						}
                    ?>
					<div class="text-center">
						<a href="https://sikap.org/programs" class="btn gradient-bg" style="margin: 20px;">Read More</a>
					</div>
						
                </div>
                <?php
                $featured_news2 = @array_slice($news, 0, 2);
                $news =  @array_slice($news, 1, 3);
                ?>

                <div class="col-12 col-lg-4">
                    <?php
                    if ( !empty($featured_news2) ) {
                    ?>
                    <div>
                        <div class="section-heading">
                            <h2 class="entry-title" style="height: 85px; vertical-align: text-bottom;">Features and News </h2>
                        </div>
						<?php
							foreach($featured_news2 as $featured_news){
						?>

                        <div class="mb-5">
                            <div class="row">
                                <div class="col-12"> 
									<div style="height: 250px; width: 100%; overflow: hidden!important; 
												background-image: url(<?=$featured_news['featured_img']?>);
												background-size:cover;
												background-position:center;
												background-repeat:no-repeat;">
									</div>
								</div>
                                <div class="col-12">
                                    <div class="cause-content-wrap" style="height: 400px;">
                                        <header class="entry-header">                                   
                                            <h3 class="entry-title w-100 m-0"><a href="<?=base_url().'news/'.$featured_news['slug']?>"><?=$featured_news['title']?></a></h3>
                                            <div class="posted-date">
                                                
                                            </div>
                                    
                                        </header>

                                        <div class="entry-content">
                                            <p class="m-0"><?=substr(strip_tags($featured_news['post']), 0, 300)?>...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
						 <?php
						}
                   		 ?>
                    </div>
                    <?php
                        }
                    ?><div class="text-center">
						<a href="https://sikap.org/news" class="btn gradient-bg" style="margin: 20px;">Read More</a>
					</div>
                </div>
            </div>
        </div>
    </div>


    <div style="margin: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="coL-12 col-lg-6">
                    <div class="section-heading">
                        <h2 class="entry-title">With Thanks</h2>
						<div style="height: 300px;">
							<p class="mt-5"><?=$settings['site_about']?></p>
							<img src="https://sikap.org/filemanager/she.png" class="d-inline-block" style="height: 60px; margin-right: 10px;"/>
							<img src="https://sikap.org/filemanager/oxfam.png" class="d-inline-block" style="height: 60px; margin-right: 10px;"/>
							<img src="https://sikap.org/filemanager/gaf.png" class="d-inline-block" style="height: 60px;"/>
						</div>
					</div>
                </div>

                <div class="col-12 col-lg-6">
				   <div class="section-heading">
						<h2 class="entry-title">Visit Us</h2>
					 	<div id="mapid" style="width: 100%; height: 300px;"></div>
				   </div>
                </div>
            </div>
        </div>
    </div>

	<script>

		//--Start map init
		var map = L.map('mapid').setView([8.502448, 125.978988], 18);

		var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 20,			
		}).addTo(map);
		
		L.marker([8.502448, 125.978988]).addTo(map)
		.bindPopup('<div style="text-align: center;"><img src="<?=base_url().'filemanager/'.$settings['site_logo']?>" style="height: 40px; width: 40px;" alt="SIKAP logo"><br><?=$settings['site_name']?><br> <?=$settings['address']?></div>')
		.openPopup();

        map.scrollWheelZoom.disable();
	</script>