
    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="#"><img src="<?=base_url().'filemanager/'.$settings['site_logo']?>" alt="" style="height: 100px; width: 100px;"></a></h2>
                            <ul class="d-flex flex-wrap align-items-center">
                               
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

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
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-4 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact</h2>

                            <ul>
                                <li><i class="fa fa-phone"></i><span>+63 946 525 5166</span></li>
                                <li><i class="fa fa-envelope"></i><span>email@sikap.com</span></li>
                                <li><i class="fa fa-map-marker"></i><span>Door 3,4 & 5, Pulvera Apartment, Barangay 5, San Francisco, Agusan del Sur</span></li>
                            </ul>
                        </div><!-- .foot-contact -->

                        <div class="subscribe-form">
                            <form class="d-flex flex-wrap align-items-center">
                                <input type="email" placeholder="Your email">
                                <input type="submit" value="send">
                            </form><!-- .flex -->
                        </div><!-- .search-widget -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-widgets -->

        <div class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SIKAP, Inc.
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-bar -->
    </footer><!-- .site-footer -->

    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/swiper.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/circle-progress.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='<?= BASE_URL_THEME ?>js/custom.js'></script>

</body>
</html>