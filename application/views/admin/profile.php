<?php
    $photo = !empty($admin['photo']) ? base_url().'uploads/users/'.$admin['photo'] : base_url().'assets/admin/images/avatar.png';
    ?>
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="m-t-30 text-center">
                    <a class="btn_upload" href="">
                        <img src="<?=$photo?>" class="img-circle" width="150">
                    </a>
                    
                    <h4 class="card-title m-t-10"><?=ucwords($admin['fname'].' '.$admin['lname'])?></h4>
                    <h6 class="card-subtitle"><?=ucwords($admin['role_desc'])?></h6>
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
                        <input type="hidden" name="id" value="<?=$admin['id']?>">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="small">FIRST NAME</label>
                                <input type="text" name="fname" class="form-control static-label" value="<?=$admin['fname']?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small">LAST NAME</label>
                                <input type="text" name="lname" class="form-control static-label" value="<?=$admin['lname']?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="small">EMAIL</label>
                            <input type="email" name="email" class="form-control static-label" value="<?=$admin['email']?>">                                 
                        </div>
                        <div class="form-group">
                            <label class="small">Contact No.</label>
                            <input type="email" name="contactno" class="form-control static-label" value="<?=$admin['email']?>">                                 
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
    <!-- Column -->
</div>


               
            <script src="<?=base_url()?>assets/vendors/dropzone/dropzone.js"></script>



<!-- Drop Zone -->
<div class="hidden" id="dropzone">   
</div>

<script>
    $(function(){
         //DropZone
         var myDropzone = new Dropzone("#dropzone", {
            url: '<?=base_url()?>index.php/admin/do_upload',
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
                    swal("Success!", "You have successfully change your profile picture.", "success");
                })

                this.on("error", function () {
                    swal("An error occured while uploading your file.", "Error!");
                })

                this.on("maxfilesexceeded", function () {
                   swal("You have exceed the allowed number of files.", "Error!");
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

            let url = '<?=base_url()?>admin/update_info';
            let data = $(this).serialize();

            ajax(url, data).done(function(results){
                if (results.message == "success"){
                    swal("Success!", "Your profile has been successfully updated.", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }else{
                    swal("Oh Snap!", "An error occured while updating your profile.", "error");
                }
            })

        })

    })
</script>
