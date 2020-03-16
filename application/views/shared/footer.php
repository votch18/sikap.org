
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright  © <?=date('Y')?>                
            </span>
            <span class="float-md-right d-none d-lg-block">
                <a href="<?=base_url()?>">www.uTalking2.me</a>
            </span>
        </p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url()?>assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="<?=base_url()?>assets/vendors/js/charts/jquery.sparkline.min.ff.dela"></script>
    <script src="<?=base_url()?>assets/vendors/js/charts/raphael-min.js"></script>
    <script src="<?=base_url()?>assets/vendors/js/charts/morris.min.js"></script>
    <script src="<?=base_url()?>assets/vendors/js/extensions/unslider-min.js"></script>
    <script src="<?=base_url()?>assets/vendors/js/timeline/horizontal-timeline.103.de"></script>
    <script src="<?=base_url()?>assets/vendors/js/extensions/sweetalert.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url()?>assets/js/core/app-menu.min.js"></script>
    <script src="<?=base_url()?>assets/js/core/app.min.js"></script>
    <script src="<?=base_url()?>assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <script>
        $(function(){
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            var count = 0;

            //get notifications every second
            function notify() {
                ajax('<?=base_url()?>messages/get_unread_messages_count', null).done(function (results) {
                    var res = results != "" ? results.count : null;
                    console.log(res);
                    //if unread notification is present
                    if (res != null && res != 0) {
                        //check if unread notification
                        //if not yet displayed then display
                        //update counter value
                        if (count != res) {
                            $('.notification_count').text(res);
                            loadMessage();
                            count = res
                        }
                    } else {
                        $('.notification_count').html('');
                    }

                    setTimeout(function () {
                        notify()
                    }, 1000)

                })
            }

           
            function loadMessage(){
                ajaxHtml('<?=base_url()?>messages/get_unread_messages', null).done(function (results) {
                    $('.scrollable-container.media-list').html(results);
                })
            }

            let user = '<?=$user["username"]?>';
            if (user.trim().length != 0){
                setTimeout(function () {
                    notify()
                }, 1000)
            }
        })
    </script>

</body></html>