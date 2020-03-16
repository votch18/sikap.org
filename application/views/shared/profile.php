<?php
$photo = empty($user['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$user['photo'].'?'.strtotime("now");
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
                <h4 class="card-title"><?=ucwords($user['fname'].' '.$user['lname'])?></h4>
                <ul class="list-inline clearfix mt-2">
                    <li class="mr-3"><h2 class="block"><?=count($posts)?></h2> Posts</li>
                    <li class="mr-3"><h2 class="block"><?=count($comments)?></h2> Comments</li>
                </ul>
            </div>
            <div class="card-body">
                <a href="<?=base_url()?>posts/submit/" class="btn bg-blue btn-block white"><i class="ft-edit-3"></i>&nbsp;<span>NEW POST</span></a>
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
                    formData.append("id", '<?=$user['id']?>');
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