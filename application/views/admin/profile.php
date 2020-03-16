<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">          
            <!--Content -->           
            <div class="row">
                <div class="col-lg-4">
                <?php
                $photo = empty($admin['photo']) ?  'assets/images/user.png' : 'uploads/admin/'.$admin['photo'].'?'.strtotime("now");
                ?>
<script src="<?=base_url()?>assets/vendors/dropzone/dropzone.js"></script>

<div class="card profile-card-with-cover rounded">
    <div class="card-content">
        <div class="card-img-top img-fluid bg-cover height-100 bg-blue" style="border-radius: 5px 5px 0 0;"></div>
        <div class="card-profile-image" style="margin-top: -50px; text-align: center;">
            <a href="" class="btn_upload">
                <img src="<?=base_url().$photo?>" class="rounded-circle img-border box-shadow-1" alt="Card image" style="height: 100px; width: 100px;">
            </a>
        </div>
        <div class="profile-card-with-cover-content text-center">
            <div class="profile-details mt-2">
                <h4 class="card-title"><?=ucwords($admin['fname'].' '.$admin['lname'])?></h4>
             
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

    })

</script>
                </div>
                <div class="col-lg-8">
                    <div class="card rounded" style="margin-bottom: 10px!important;">   
                        <div class="card-content">
                            <div class="card-body" style="vertical-align: middle;">
                              
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
               
            </div>        
        </div>
    </div>
</div>
<!-- END: Content-->

<script>
    $(function(){       
       
      
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
