   <!-- BEGIN: Content-->
   <div class="app-content content">
       <div class="content-wrapper">
           <div class="content-header row">
           </div>
           <div class="content-body">              
               <!--Product sale & buyers -->
               <div class="row">
                   <div class="col-lg-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title">USERS</h4>                               
                           </div>
                           <div class="card-content">
                               <div class="card-body">
                                   <table class="table">
                                    <thead>                                       
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th style="width: 200px; text-align: right;"></th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($users as $row){
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left pr-1"><span class="avatar avatar-sm avatar-online rounded-circle">
                                                        <img src="<?=base_url()?>assets/images/portrait/small/avatar-s-2.png" alt="avatar"></span>
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <h5 class="media-heading name m-0">
                                                            <?=ucwords($row['fname'].' '.$row['lname'])?>
                                                        </h5>
                                                        <span class="badge badge-warning"><?=$row['username']?></span>
                                                    </div>
                                                </div>
                                            </td>      
                                            <td><?=$row['email']?></td>
                                            <td style="width: 200px; text-align: right;">
                                                <button class="btn btn-danger" data-id="<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ft-trash"></i></button>
                                                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Log In"><i class="ft-arrow-right"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>               
               </div>
               <!--/ Product sale & buyers -->
           
           </div>
       </div>
   </div>
   <!-- END: Content-->

   <script>
   $(function(){
       $('body').on('click', '.btn-danger', function(e){
           e.preventDefault();

            let url = '<?=base_url()?>users/delete';
            let data = {
               id: $(this).attr('data-id')
            }

           let $row = $(this).parent().parent();


           swalPrompt("Are you sure you want to delete this user?", "Delete")
           .then((confirm) =>{
                if(confirm){
                   ajax(url, data).done(function(results){
                       if(results.message == "success"){
                            $row.remove();
                            swal("Success!", "You have successfully deleted a user.", "success");
                       }
                   })
                }
           })
       })
   })
   </script>