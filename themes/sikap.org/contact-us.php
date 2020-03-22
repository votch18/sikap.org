    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=ucwords(str_replace('-', ' ', $url))?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="entry-content">
                        <h2>Get In touch with us</h2>

                        <p>If you have any questions or concerns about the <?=$settings['site_name']?>, please do not hesitate to contact us.</p>

                        <ul class="contact-social d-flex flex-wrap align-items-center">                     
                            <li><a href="<?=$settings['facebook']?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?=$settings['twitter']?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?=$settings['linkedin']?>"><i class="fa fa-linkedin"></i></a></li>
                        </ul>

                        <ul class="contact-info p-0">
                            <li><i class="fa fa-phone"></i><span><?=$settings['contactno']?></span></li>
                            <li><i class="fa fa-envelope"></i><span><?=$settings['email']?></span></li>
                            <li><i class="fa fa-map-marker"></i><span><?=$settings['address']?></span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <form class="contact-form">
                        <input type="text" placeholder="Name" required>
                        <input type="email" placeholder="Email" required>
                        <textarea rows="15" cols="6" placeholder="Messages" required></textarea>

                        <span>
                            <input class="btn gradient-bg" type="submit" value="Contact us">
                        </span>
                    </form>

                </div>

                <div class="col-12 mt-5">
                    <div class="contact-gmap">
                        <div id="mapid" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
	<script>

//--Start map init
var map = L.map('mapid').setView([8.502448, 125.978988], 15);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoidm90Y2gxOCIsImEiOiJjazM2dHhucmQwNTMzM2NubmR3dHduZHh2In0.CXezVIToRZsnx42HZJNQVw', {
    maxZoom: 15,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1Ijoidm90Y2gxOCIsImEiOiJjazM2dHhucmQwNTMzM2NubmR3dHduZHh2In0.CXezVIToRZsnx42HZJNQVw',       
}).addTo(map);

L.marker([8.502448, 125.978988]).addTo(map)
.bindPopup('<div style="text-align: center;"><img src="<?=base_url().'filemanager/'.$settings['site_logo']?>" style="height: 40px; width: 40px;" alt="SIKAP logo"><br><?=$settings['site_name']?><br> <?=$settings['address']?></div>')
.openPopup();

</script>
