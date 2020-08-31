<script src="<?=base_url()?>vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?=base_url()?>vendor/studio-42/elfinder/js/elfinder.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?=ucwords($title)?>
            <a href="<?=base_url()?>admin/<?=$url?>/create" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;<?=ucwords('New ')?></a>
        </h3>

    </div>
    <div class="col-md-7 align-self-center">

        <a id="preview" href="<?=base_url()?>preview/<?=$url?>/<?=!empty($post['slug']) ? $post['slug'] :''?>" class="float-right" target="_blank">Preview</a>
    </div>   
</div>

<form method="post" id="savePosts">
<input type="hidden" name="postid" value="<?=!empty($post['postid']) ? $post['postid'] : uniqid()?>">
<input type="hidden" name="type" value="<?=$type?>">

<div class="row m-b-5">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">            
                <div class="panel-heading">
                    <?php
                        if (isset($publish) && $publish == true){
                    ?>
                    <div class="float-right" >
                        <h5 class="d-inline">Publish?</h5>
                        <label class="switch m-0 p-0" style="vertical-align: middle;">
                            <input type="checkbox" <?=!empty($post['status']) && $post['status'] == "1" ? "checked" : ""?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <?php
                        }
                    ?>
                    <small>Automatically saved as <b class="text-success">draft</b> when <b>touched</b>.</small>                
                <input type="hidden" name="url"/>
				<input class="form-control input-lg m-t-10" name="title" placeholder="Title" type="text" value="<?=!empty($post['title']) ? $post['title'] : ''?>" required autocomplete="off">
                <h4 class="permalink m-t-10">
                    <span title="Permalink ">
                        <span class="fa fa-link"></span>&nbsp;
                        <?= base_url().$url?>/
                        <span id="url" class="text-primary" style="border: 1px solid;"><?=!empty($post['slug']) ? $post['slug'] :''?></span>
                    </span> 
                </h4>
				<textarea class="form-control input-lg" rows="5"  name="description" placeholder="Short description" required><?=!empty($post['description']) ? $post['description'] : ''?></textarea>
                <select name="category" class="form-control" style="<?=$url != "programs" ? "display: none;" : ""?>">
                    <option value="0">Select program category</option>
                    <?php
                        foreach ($categories as $category){
                            ?>
                                <option value="<?=$category["id"]?>" <?=!empty($post['program_category']) && $post['program_category'] == $category["id"] ? 'selected' : ''?>><?=$category["description"]?></option>
                            <?php
                        }
                    ?>
                </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-dark float-right btn-sm" id="upload_btn" ><i class="mdi mdi-cloud-upload"></i> Upload & Crop</button>
                <h5 class="">Featured Image</h5>
                <div class="col-md-12 m-t-15" style="background:#e9e9e9; height: 200px;">
                    <div class="row">
                    <?php
                         $photo = !empty($post['photo']) ? $post['photo'] : base_url().'assets/admin/images/noimage.png';
                    ?>
                        <img id="img-uploader" class="img-responsive" src="<?=$photo?>" style="display:block;margin:auto; width: 100%; height: 200px;max-height: 200px"/>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#dialogFilemanager">
                        <div style="display: block; margin-top: -180px; text-align: center; width: 100%;">
                            <span class="fa fa-cloud-upload" style="font-size: 45px;"></span><br/><br/>
                            <span style="display: block">Choose from File Manager <br>(<?=$url == 'slider' ? '770w x 350h' : '750w x 390h'?>)</span>
                        </div>
                        <input type="hidden" name="image" value="<?=!empty($post['photo']) ? $post['photo'] : ''?>"/>
                    </a>                    
                </div>
                <sub>Ideal image size (<?=$url == 'slider' ? '770w x 350h' : '750w x 390h'?>)</sub>
            </div>
        </div>
    </div>
</div>

<div class="row m-t-0 <?=in_array($url, array('gallery', 'slider')) ? 'd-none' : ''?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <textarea name="content" id="editor" class="form-control">
                <?=!empty($post['post']) ? $post['post'] : ''?>
            </textarea>
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
                $photo = !empty($post['photo']) ? $post['photo'] : base_url().'assets/admin/images/noimage.png';
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


<div class="d-none">
<?php
    $data['connector'] = base_url().'filemanager/connector';
    $this->load->view('filemanager/iframe_filemanager',$data);
?>
</div>

<script>

$(function(){

    tinymce.init({
        selector: 'textarea#editor',
        plugins: 'print preview paste importcss searchreplace autolink save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons autoresize',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: false,
        statusbar: false,
        toolbar: 'fullscreen  | undo redo | bold italic underline strikethrough subscript superscript | formatselect fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap | insertfile link | table customLink',
        toolbar_sticky: true,
        quickbars_insert_toolbar: false,
        image_advtab: true,
        force_br_newlines: true,
        force_p_newlines: false,
        forced_root_block: '',
        importcss_append: true,
        height: 550,
        setup: function (editor) {
            editor.ui.registry.addButton('customLink', {
                icon: 'image',
                tooltip: 'Attach files',
                onAction: function () {
                    fromTinyMCE = true;

                    jQuery.noConflict();
                    $('#dialogFilemanager').modal('show');
                }
            });
        },

        //image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: 'sliding',
        //contextmenu: "link image imagetools table",
        init_instance_callback: function (editor) {

            editor.on('input change', function (e) {
                savePosts();
            });
        }
    });

    let form_original_data = $("#savePosts").serialize();
    let editor_content = tinymce.activeEditor.getContent();

    //publish
    $('input[type=checkbox]').click(function(e){
       e.preventDefault();
        publishedPosts();
    })


    $('#dialogFilemanager').on('hidden.bs.modal', function () {
        savePosts();
    });

    $('input[name=title]').on('keyup',function(){
        $('#url').text(function(){
            url = $('input[name=title]').val().trim().replace(/[^a-z0-9+]+/gi, '-').toLowerCase()
            $('input[name=url]').val(url)
            $('#preview').attr('href', '<?=base_url()?>preview/<?=$url?>/' + url)
            return url
        })
    })

    function savePosts(){
        if (form_original_data != $("#savePosts").serialize() || editor_content != tinymce.activeEditor.getContent()){
            form_original_data = $("#savePosts").serialize();
            editor_content = tinymce.activeEditor.getContent();

            let data = { 
                postid: $('input[name=postid]').val(),
                title: $('input[name=title]').val(),
                description: $('textarea[name=description]').val(),
                post: tinymce.activeEditor.getContent(),
                type: $('input[name=type]').val(),
                image: $('input[name=image]').val()   ,
                category: $('select[name=category]').val()
            }

            $.ajax({
                type: 'POST',
                url: '<?=base_url()?>posts/create',
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
    }


    function publishedPosts(){
      
        let title = ($('input[type=checkbox]').prop("checked") ? 'Publish' : 'Unpublish' ) ;   
        
        let data = { 
            postid: $('input[name=postid]').val(),            
            status: ($('input[type=checkbox]').prop("checked") ? 1 : 0 )             
        };

        Swal.fire({
            title: title + '?',
            text: 'Are you sure?',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: title,
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>posts/publish',
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
                           
                            Swal.fire("Success!", title + "ed successfully!", "success");

                            setTimeout(function(){                           
                                $('.status').html('')
                                window.location.href = '<?=base_url()?>admin/<?=$url?>';
                            }, 1500)
                        }
                        else{
                            $('.status').switchClass('text-success', 'text-danger').html('[error]')
                        }
                    }
                })

                if($('input[type=checkbox]').prop("checked") == true){
                    $('input[type=checkbox]').prop("checked", false);
                }else{
                    $('input[type=checkbox]').prop("checked", true);
                }
               
            } 
        })
        
    }

    $('#upload_btn').on('click', function(e){
        e.preventDefault();

        $('input[name="uploadImage"]').trigger('click');
    })

    var cropper;
    var url = '<?=$url?>';

    $('input[name="uploadImage"]').change(function(e){

        var file = $(this)[0].files[0];
        var reader = new FileReader();
        var img_data = "";
        reader.onload = function(event) {
            jQuery.noConflict();
            $('#uploadModal').modal('show');
            $('#cropImage').attr('src', event.target.result);

            if (cropper != undefined){
                cropper.destroy();
            }

            var image = document.getElementById('cropImage');
            if (url == 'slider'){
                cropper = new Cropper(image, {
                    aspectRatio: 770 / 350,
                    zoomable: false
                });
            }else{
                cropper = new Cropper(image, {
                    aspectRatio: 750 / 390,
                    zoomable: false
                });
            }


        };
        reader.readAsDataURL(file);
    })


    $('.btn_save_crop').on('click', function(e){
        var formData 	= new FormData();
        var canvas 		= cropper.getCroppedCanvas();
        formData.append('url', '<?=$url?>');
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
                jQuery.noConflict();
                $('#uploadModal').modal('hide');

                $('input[name=image]').val('<?=base_url()?>filemanager/<?=strtoupper($url)?>/' + res);
                $('#img-uploader').attr('src', '<?=base_url()?>filemanager/<?=strtoupper($url)?>/' + res);
                swal.close();
                savePosts();
            })
        })

    $('select[name=category]').change(function(e){
        e.preventDefault();
        savePosts();
    })

})
        
    </script>