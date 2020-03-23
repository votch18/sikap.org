
    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="#"><img src="<?=base_url().'filemanager/'.$settings['site_logo']?>" alt="" style="height: 100px; width: 100px;"></a></h2>
                            <ul class="d-flex flex-wrap align-items-center">
                               
                                <li><a href="<?=$settings['facebook']?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?=$settings['twitter']?>"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?=$settings['youtube']?>"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="<?=$settings['linkedin']?>"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mt-5 mt-md-0">
                        <h2>Site Map</h2>

                        <ul>
                        <?php                                
                            foreach($pages as $row) {
                        ?>
                            
                            <li><a href="<?= BASE_URL.$row['url']?>"><?=ucwords($row['name'])?></a></li>
                        <?php
                            }
                            ?>

                        </ul>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact</h2>

                            <ul>
                                <li><i class="fa fa-phone"></i><span><?=$settings['contactno']?></span></li>
                                <li><i class="fa fa-envelope"></i><span><?=$settings['email']?></span></li>
                                <li><i class="fa fa-map-marker"></i><span><?=$settings['address']?></span></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SIKAP, Inc.
</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/swiper.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/circle-progress.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/custom.js'></script>

</body>
</html>