        
            
        
        </div>
    </div>
        <footer class="footer text-center" style="margin-left: 240px;"> © <?=date('Y')?> <a href="<?=base_url()?>">sikap.org</a> </footer>
</div>


 <!-- Change Password Modal -->
 <div class="modal fade text-left" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Change password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">                  
                    <form method="post" id="frmChangePass">
                        <input type="hidden" name="id" value="<?=$admin['id']?>">
                        <div class="form-group">                          
                            <label class="small">Username</label>
                            <input type="text" class="form-control static-label" name="username" value="<?=$admin['username']?>" readonly/>
                        </div>
                        <div class="form-group">
                            <label class="small">Password</label>
                            <input type="password" class="form-control static-label" name="password" />
                        </div>
                        <div class="form-group">
                            <label class="small">Confirm password</label>
                            <input type="password" class="form-control static-label" name="confirm_password" />
                        </div>
                        <input type="submit" class="btn btn-success btn-min-width btn_signin" value="Change password"/>
                    </form>
                  
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function(){


            let base_url = '<?=base_url()?>admin/';


            function highlightMenu(){
                $( "#sidebarnav li a" ).each(function( index ) {
                    $( this ).removeClass('active');
                    $( this ).parent().removeClass('active');

                    let hash = $( this ).attr('href').replace(base_url, '').split('/')[0];
                    let controller = window.location.href.replace(base_url, '').split('/')[0];
                    
                   

                    if ( controller.trim() == hash.trim()){
                        console.log(controller)
                        console.log(hash)

                        $( this ).addClass('active');
                        $( this ).parent().addClass('active');
                    }
                });
            }

            highlightMenu();

            $('#dataTable').DataTable({
                "bLengthChange": false,
                "bInfo": false,
                "bSortable": false,
                "ordering": false
            });


            $('body').on('click', '.btn_remove', function(e){
                e.preventDefault();

                    let url = '<?=base_url()?>posts/delete';
                    let id = $(this).attr('data-id');
                    let data = {
                        id: id
                    }

                let $row = $(this).closest('.con_' + id);

                Swal.fire({
                    title: 'Delete?',
                    text: 'Are you sure you want to delete this record?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            url: '<?=base_url()?>posts/delete',
                            data: data,
                            dataType: 'json',
                            crossDomain: true,
                            headers: {'X-Requested-With': 'XMLHttpRequest'},
                            error: function(res){
                                console.log('error')
                                console.log(res)
                            },
                            beforeSend: function(){
                                $('.status').html('Deleting record...')
                            },
                            success: function(res){
                                
                                if(res.message == 'success'){
                                
                                    Swal.fire("Success!", "Deleted successfully!", "success");
                                    $row.remove();
                                    setTimeout(function(){                           
                                        $('.status').html('')
                                    }, 1500)
                                }
                                else{
                                    $('.status').switchClass('text-success', 'text-danger').html('[error]')
                                }
                            }
                        })

                    } 
                })
            })

            //change password
            $('#frmChangePass').on('submit', function(e){
                e.preventDefault();
                e.stopPropagation();
                
                var data = $(this).serialize();
                var url = '<?=base_url()?>users/change_password';

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    crossDomain: true,
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    error: function(res){
                        console.log('error')
                        console.log(res)
                    },
                    beforeSend: function(){
                        $('.status').html('Updating password..')
                    },
                    success: function(res){
                        
                        if(res.message == 'success'){                        
                            Swal.fire("Success!", "Change password successfully!", "success");
                            $row.remove();
                            setTimeout(function(){                           
                                $('.status').html('')
                            }, 1500)
                        }
                        else{
                            $('.status').switchClass('text-success', 'text-danger').html('[error]')
                            Swal.fire("Error!", results.message, "error");
                        }
                    }
                })

            })
        })
    </script>
</body>

</html>