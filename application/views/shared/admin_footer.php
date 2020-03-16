        </div>
        <footer class="footer"> © 2019 Admin Pro by wrappixel.com </footer>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
  
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?=base_url()?>assets/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=base_url()?>assets/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>

    <script src="<?=base_url()?>assets/admin/vendor/datatables/datatables.js"></script>
    <script src="<?=base_url()?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url()?>assets/admin/main/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url()?>assets/admin/main/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url()?>assets/admin/main/js/custom.min.js"></script>
    <!-- ============================================================== -->

    <script>
        $(function(){

            $('#dataTable').DataTable({
                "bLengthChange": false,
                "bInfo": false,
                "bSortable": false
            });

            let base_url = '<?=base_url()?>admin/';

            $( window ).on( 'hashchange', function( e ) {
                getPartial();
            });

            function getPartial(){
                let url = window.location.hash;

                url = (url == '#elf_l1_XA') ? history.back() : url;

                //remove hash
                url = url.replace(/#\//gi, '');
                //remove duplicate slash
                url = url.replace(/\/\//gi, '/');

                //get controller & method
                let controller = url.split('/')[0];
                let method = url.split('/')[1];
                
                //if empty url then load dashboard
                if (url == '' || url == '#/'){
                    load(base_url + 'dashboard');
                }else if(controller != '' || controller != 'home'){
                    load(base_url + url);
                }else{
                    url = '';
                    load(base_url + 'dashboard');
                }
               
                //push hash url to browser searchbar
                window.history.pushState('', document.title, base_url + '#/' + url);
            }

            function load(url){
                //$('.preloader').
                $.get( url, function(data) {                    
                    $("#main").html(data);
                })
                .done(function() {
                    //alert( "second success" );
                })
                .fail(function() {
                    //alert( "error" );
                })
                .always(function() {
                    //alert( "finished" );
                });
            }

            getPartial();

            $('body').on('click', '.btn_remove', function(e){
           e.preventDefault();

            let url = '<?=base_url()?>posts/delete';
            let data = {
               id: $(this).attr('data-id')
            }

           let $row = $(this).parent().parent().parent().parent();

           swalPrompt("Are you sure you want to delete this post?", "Delete")
           .then((confirm) =>{
                if(confirm){
                   ajax(url, data).done(function(results){
                        if(results.message == "success"){
                            $row.remove();
                            swal("Success!", "You have successfully deleted a post.", "success");
                        }
                   })
                }
           })
       })
        })
    </script>
</body>

</html>