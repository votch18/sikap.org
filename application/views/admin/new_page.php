<form method="post" id="savePage">
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?=ucwords($title)?></h3>
    </div>
    <div class="col-md-7">
        <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Save changes</button>
    </div>   
</div>

<input type="hidden" name="id" value="<?=!empty($page['id']) ? $page['id'] : 0?>">
<input type="hidden" name="url" value="<?=!empty($page['url']) ? $page['url'] : ''?>">

<div class="row m-b-5">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">            
                <div class="panel-heading">
                    <div class="float-right d-none" >
                        <h5 class="d-inline">Publish?</h5>
                        <label class="switch m-0 p-0" style="vertical-align: middle;">
                            <input type="checkbox" <?=!empty($page['status']) && $page['status'] == "1" ? "checked" : ""?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                        
                    <div class="form-group mt-10">
                        <input type="hidden" name="url"/>
                        <label class="small">Title</label>
                        <input class="form-control input-lg" name="name" placeholder="Page name" type="text" value="<?=!empty($page['name']) ? $page['name'] : ''?>" required autocomplete="off">
                    </div>
                    <div class="form-group mt-10">
                        <label class="small">Url</label>
                        <h4 class="permalink">
                            <span title="Permalink ">
                                <span class="fa fa-link"></span>&nbsp;
                                <?= base_url()?>
                                <span id="url" class="text-primary" style="border: 1px solid;"><?=!empty($page['url']) ? $page['url'] :''?></span>
                            </span> 
                        </h4>
                    </div>
                    <div class="form-group mt-10">
                        <label class="small">Template</label>
                        <select name="template" class="form-control" required>
                            <option value="0">Create new template</option>
                            <?php
                                foreach($templates as $template) {
                                ?>
                                <option value="<?=$template?>" <?=!empty($page['template'])  && $page['template'] == $template ? 'selected' : ''?>><?=$template?></option>
                                <?php
                                }
                            ?>
                        </select>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-dark float-right btn-sm" id="upload_btn" ><i class="mdi mdi-cloud-upload"></i> Upload & Crop</button>
                <h5 class="mt-2">Page banner</h5>
                <div class="col-md-12" style="background:#e9e9e9; height: 200px;">
                    <div class="row">
                    <?php
                         $photo = !empty($page['banner']) ? $page['banner'] : base_url().'assets/admin/images/noimage.png';
                    ?>
                        <img id="img-uploader" class="img-responsive" src="<?=$photo?>" style="display:block;margin:auto; width: 100%; height: 200px;max-height: 200px"/>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#dialogFilemanager">
                        <div style="display: block; margin-top: -180px; text-align: center; width: 100%;">
                            <span class="fa fa-cloud-upload" style="font-size: 45px;"></span><br/><br/>
                            <span style="display: block">Choose from File Manager <br>(1420w x 248h)</span>
                        </div>
                        <input type="hidden" name="image" value="<?=!empty($page['banner']) ? $page['banner'] : ''?>"/>
                    </a>                    
                </div>
                <sub>Ideal image size (1420w x 248h)</sub>
            </div>
        </div>
    </div>
</div>

</form>


<input type="file" name="uploadImage" style="display: none;">

<div class="modal" tabindex="-1" role="dialog" id="uploadModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload & Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <?php
                $photo = !empty($page['banner']) ? $page['banner'] : base_url().'assets/admin/images/noimage.png';
                ?>
                <div>
                    <img id="cropImage" class="img-responsive" src="<?=$photo?>" style="display:block;margin:auto; width: 100%; height: auto;"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn_save_crop">Crop & Save Image</button>
            </div>
        </div>
    </div>
</div>



<script>
$(function(){
  
    let form_original_data = $("#savePage").serialize();

    $('input[name=name]').on('keyup',function(){
        $('#url').text(function(){
            url = $('input[name=name]').val().trim().replace(/[^a-z0-9+]+/gi, '-').toLowerCase();
            $('input[name=url]').val(url);
            return url
        })
    })

    $("#savePage").submit(function(e){
        e.preventDefault();
       
        let data = { 
            id: $('input[name=id]').val(),
            name: $('input[name=name]').val(),
            template: $('select[name=template]').val(),  
            banner: $('input[name=image]').val(),
            url: $('input[name=url]').val(),
            status: ($('input[type=checkbox]').prop("checked") ? 1 : 0 )                   
        }

        $.ajax({
            type: 'POST',
            url: '<?=base_url()?>admin/pages/save',
            data: data,
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            error: function(res){
                console.log('error')
                console.log(res)
            },
            beforeSend: function(){
                $('.status').html('Saving changes...')
            },
            success: function(res){
                
                if(res.message == 'success'){                    
                    Swal.fire(
                        'Success!',
                        'Page created successfully!',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = '<?=base_url()?>admin/pages';
                        }
                    })       
                   
                }
                else{
                    $('.status').switchClass('text-success', 'text-danger').html('[error]')
                }
            }
        })
    })



    $('#upload_btn').on('click', function(e){
        e.preventDefault();

        $('input[name="uploadImage"]').trigger('click');
    })

    var cropper;
    var url = 'banner';

    $('input[name="uploadImage"]').change(function(e){

        var file = $(this)[0].files[0];
        var reader = new FileReader();
        var img_data = "";
        reader.onload = function(event) {
            $('#uploadModal').modal('show');
            $('#cropImage').attr('src', event.target.result);

            if (cropper != undefined){
                cropper.destroy();
            }

            var image = document.getElementById('cropImage');
            cropper = new Cropper(image, {
                aspectRatio: 1420 / 248,
                zoomable: false
            });


        };
        reader.readAsDataURL(file);
    })


    $('.btn_save_crop').on('click', function(e){
        var formData 	= new FormData();
        var canvas 		= cropper.getCroppedCanvas();
        formData.append('url', 'banner');
        formData.append('cropImage', canvas.toDataURL("image/jpeg"));

        swal.fire({
            title: 'Uploading ...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });
        $.ajax({
            url: "<?=base_url()?>posts/uploadCropImage",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(e) {
                    var percentage = Math.floor(e.loaded / e.total * 100);
                    swal.update({
                        title: 'Uploading (' + percentage + '%)',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    });
                };
                return xhr;
            }
        })
            .done(function(res){
                $('#uploadModal').modal('hide');

                $('input[name=image]').val('<?=base_url()?>filemanager/BANNER/' + res);
                $('#img-uploader').attr('src', '<?=base_url()?>filemanager/BANNER/' + res);
                swal.close();
            })
    })

})
        
    </script>
