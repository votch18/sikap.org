             
 <script src="<?=base_url()?>assets/admin/vendor/dropzone/dropzone.js"></script>

<?php
    $photo = !empty($users['photo']) ? base_url().'uploads/users/'.$users['photo'] : base_url().'assets/admin/images/avatar.png';
    ?>
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="m-t-30 text-center">
                    <a class="btn_upload" href="">
                        <img src="<?=$photo?>?<?=strtotime("now")?>" class="img-circle" style="height: 150px; width: 150px">
                    </a>
                    
                    <h4 class="card-title m-t-10"><?=ucwords($users['fname'].' '.$users['lname'])?></h4>
                    <h6 class="card-subtitle"><?=ucwords($users['role_desc'])?></h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="tab-pane pt-1" id="settings" aria-labelledby="settings-tab" role="tabpanel">
                    <h3>User Profile</h3>
                    <hr/>
                    
                    <form method="post" id="frmUserInfo">
                        <input type="hidden" name="id" value="<?=$users['id']?>">
                        <input type="hidden" name="username" value="<?=$users['username']?>">
                        <input type="hidden" name="role" value="<?=$users['role']?>">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="small">First name</label>
                                <input type="text" name="fname" class="form-control static-label" value="<?=$users['fname']?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small">Last name</label>
                                <input type="text" name="lname" class="form-control static-label" value="<?=$users['lname']?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="small">Email</label>
                            <input type="email" name="email" class="form-control static-label" value="<?=$users['email']?>">                                 
                        </div>
                        <div class="form-group">
                            <label class="small">Contact No.</label>
                            <input type="text" name="contactno" class="form-control static-label" value="<?=$users['contactno']?>">                                 
                        </div>
                        <hr/>
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary " value="Save Changes">
                        </div> 
                    </form>
      
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Drop Zone -->
<div class="hidden" id="dropzone">   
</div>

<script>
    $(function(){
         //DropZone
         var myDropzone = new Dropzone("#dropzone", {
            url: '<?=base_url()?>index.php/users/do_upload',
            uploadMultiple: false,
            acceptedFiles: '.jpeg, .jpg, .png',
            init: function () {
                //send all the form data along with the files:
                this.on("sending", function (data, xhr, formData) {
                    formData.append("id", '<?=$admin['id']?>');
                });

                this.on("uploadprogress", function (progress) {
                    console.log(progress)
                })

                this.on("success", function () {
                    Swal.fire("Success!", "You have successfully change your profile picture.", "success");
                })

                this.on("error", function () {
                    Swal.fire("An error occured while uploading your file.", "Error!");
                })

                this.on("maxfilesexceeded", function () {
                    Swal.fire("You have exceed the allowed number of files.", "Error!");
                })
                this.on("complete", function () {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        this.removeAllFiles();
                        //loadAttachments();
                        window.location.reload();
                    }
                })
            }
        });

        //upload agenda attachment
        $('body').on('click', '.btn_upload', function (e) {
            e.preventDefault();

            myDropzone.hiddenFileInput.click();
        })

      
        $('#frmUserInfo').on('submit', function(e){
            e.preventDefault();

            let url = '<?=base_url()?>users/save_user';
            let data = $(this).serialize();

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
                    $('.status').html('Saving record...')
                },
                success: function(res){
                    
                    if(res.message == 'success'){
                    
                        Swal.fire("Success!", "User successfully saved!", "success");
                       
                        setTimeout(function(){                           
                            $('.status').html('')
                            window.location.reload();
                        }, 1500)
                    }
                    else{
                        Swal.fire("Error!", res.message, "error");
                    }
                }
            })

        })

    })
</script>
