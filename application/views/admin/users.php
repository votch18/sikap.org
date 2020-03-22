<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Users</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <button class="btn btn-success float-right">Add user</button>
    </div>   
</div>

<div class="row m-b-5">
   
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th></th>
                        </tr>
                    </thead>
              
                <tbody>
                    <?php
                        foreach($users as $row){
                            $photo = !empty($admin['photo']) ? base_url().'assets/uploads/users/'.$row['photo'] : base_url().'assets/admin/images/avatar.png';
                    ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left pr-1"><span class="avatar avatar-sm avatar-online rounded-circle">
                                        <img src="<?=$photo?>" alt="avatar" style="width: 40px; height: 40px; border-radius: 50%;"></span>
                                    </div>
                                    <div class="media-body media-middle">
                                        <h5 class="media-heading name m-0">
                                            <?=ucwords($row['fname'].' '.$row['lname'])?>
                                        </h5>
                                        <span class="badge badge-warning"><?=$row['role_desc']?></span>
                                    </div>
                                </div>
                            </td>      
                            <td><?=$row['username']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['contactno']?></td>
                            <td style="width: 160px; text-align: right;">
                                <button class="btn btn-primary btn-sm" data-id="<?=$row['id']?>" ><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                <button class="btn btn-danger btn-sm" data-id="<?=$row['id']?>" ><i class="fa fa-trash"></i>&nbsp;Delete</button>
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

<script>
   $(function(){
       $('body').on('click', '.btn-danger', function(e){
           e.preventDefault();

            let data = {
               id: $(this).attr('data-id')
            }

            let $row = $(this).parent().parent();

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
                        url: '<?=base_url()?>users/delete',
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
   })
   </script>