<script src="<?=base_url()?>vendor/ckeditor5/build/ckeditor.js"></script>
<script src="<?=base_url()?>vendor/studio-42/elfinder/js/elfinder.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?=ucwords($title)?></h3>
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
                    <div class="float-right" >
                        <h5 class="d-inline">Publish?</h5>
                        <label class="switch m-0 p-0" style="vertical-align: middle;">
                            <input type="checkbox" <?=!empty($post['status']) && $post['status'] == "1" ? "checked" : ""?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    
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
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h5 class="">Featured Image</h5>
                <div class="col-md-12" style="background:#e9e9e9; height: 200px;">
                    <div class="row">
                    <?php
                         $photo = !empty($post['photo']) ? $post['photo'] : base_url().'assets/admin/images/noimage.png';
                    ?>
                        <img id="img-uploader" class="img-responsive" src="<?=$photo?>" style="display:block;margin:auto; width: 100%; height: 200px;max-height: 200px"/>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#dialogFilemanager">
                        <div style="display: block; margin-top: -180px; text-align: center; width: 100%;">
                            <span class="fa fa-cloud-upload" style="font-size: 45px;"></span><br/><br/>
                            <span style="display: block">Choose from File Manager <br>(<?=$url == 'slider' ? '1920w x 832h' : '754w x 390h'?>)</span>
                        </div>
                        <input type="hidden" name="image" value="<?=!empty($post['photo']) ? $post['photo'] : ''?>"/>
                    </a>                    
                </div>
                <sub>Ideal image size (<?=$url == 'slider' ? '1920w x 832h' : '754w x 390h'?>)</sub>
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



<div class="d-none">
<?php
    $data['connector'] = base_url().'filemanager/connector';
    $this->load->view('filemanager/iframe_filemanager',$data);
?>
</div>

<script>
$(function(){
    // elfinder folder hash of the destination folder to be uploaded in this CKeditor 5
    const uploadTargetHash = 'l1_Lw';

// elFinder connector URL
const connectorUrl = '<?=base_url()?>filemanager/connector';

ClassicEditor
    .create( document.querySelector( '#editor' ), {
        
        toolbar: {
            items: [
                'undo',
                'redo',                            
                'CKFinder',
                '|',
                'heading',               
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'indent',
                'outdent',
                '|',                             
                'insertTable',
                'blockQuote',
                'alignment',
                'fontBackgroundColor',
                'fontColor',
                'highlight',
                '|',    
                'strikethrough',
                'subscript',
                'superscript',
                'underline',   
                '|',    
                'mediaEmbed'
            ]
        },
        language: 'en',
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
            ]
        },
        licenseKey: '',
        
    } )
    .then( editor => {
        window.editor = editor;
        
        editor.model.document.on( 'change:data', () => {
            savePosts();
        } );
        const ckf = editor.commands.get('ckfinder'),
            fileRepo = editor.plugins.get('FileRepository'),
            ntf = editor.plugins.get('Notification'),
            i18 = editor.locale.t,
            // Insert images to editor window
            insertImages = urls => {
                const imgCmd = editor.commands.get('imageUpload');
                if (!imgCmd.isEnabled) {
                    ntf.showWarning(i18('Could not insert image at the current position.'), {
                        title: i18('Inserting image failed'),
                        namespace: 'ckfinder'
                    });
                    return;
                }
                editor.execute('imageInsert', { source: urls });
            },
            // To get elFinder instance
            getfm = open => {
                return new Promise((resolve, reject) => {
                    // Execute when the elFinder instance is created
                    const done = () => {
                        if (open) {
                            // request to open folder specify
                            if (!Object.keys(_fm.files()).length) {
                                // when initial request
                                _fm.one('open', () => {
                                    _fm.file(open)? resolve(_fm) : reject(_fm, 'errFolderNotFound');
                                });
                            } else {
                                // elFinder has already been initialized
                                new Promise((res, rej) => {
                                    if (_fm.file(open)) {
                                        res();
                                    } else {
                                        // To acquire target folder information
                                        _fm.request({cmd: 'parents', target: open}).done(e =>{
                                            _fm.file(open)? res() : rej();
                                        }).fail(() => {
                                            rej();
                                        });
                                    }
                                }).then(() => {
                                    // Open folder after folder information is acquired
                                    _fm.exec('open', open).done(() => {
                                        resolve(_fm);
                                    }).fail(err => {
                                        reject(_fm, err? err : 'errFolderNotFound');
                                    });
                                }).catch((err) => {
                                    reject(_fm, err? err : 'errFolderNotFound');
                                });
                            }
                        } else {
                            // show elFinder manager only
                            resolve(_fm);
                        }
                    };

                    // Check elFinder instance
                    if (_fm) {
                        // elFinder instance has already been created
                        done();
                    } else {
                        // To create elFinder instance
                        _fm = $('<div/>').dialogelfinder({
                            // dialog title
                            title : 'File Manager',
                            // connector URL
                            url : connectorUrl,
                            // start folder setting
                            startPathHash : open? open : void(0),
                            // Set to do not use browser history to un-use location.hash
                            useBrowserHistory : false,
                            // Disable auto open
                            autoOpen : false,
                            // elFinder dialog width
                            width : '80%',
                            // set getfile command options
                            commandsOptions : {
                                getfile: {
                                    oncomplete : 'close',
                                    multiple : true
                                }
                            },
                            // Insert in CKEditor when choosing files
                            getFileCallback : (files, fm) => {
                                let imgs = [];
                                fm.getUI('cwd').trigger('unselectall');
                                $.each(files, function(i, f) {
                                    if (f && f.mime.match(/^image\//i)) {
                                        imgs.push(fm.convAbsUrl(f.url));
                                    } else {
                                        editor.execute('link', fm.convAbsUrl(f.url));
                                    }
                                });
                                if (imgs.length) {
                                    insertImages(imgs);
                                }

                                //trigger save after insert image
                                savePosts();
                            }
                        }).elfinder('instance');
                        done();
                    }
                });
            };

        // elFinder instance
        let _fm;

        if (ckf) {
            // Take over ckfinder execute()
            ckf.execute = () => {
                getfm().then(fm => {
                    fm.getUI().dialogelfinder('open');
                });
            };
        }

        // Make uploader
        const uploder = function(loader) {
            let upload = function(file, resolve, reject) {
                getfm(uploadTargetHash).then(fm => {
                    let fmNode = fm.getUI();
                    fmNode.dialogelfinder('open');
                    fm.exec('upload', {files: [file], target: uploadTargetHash}, void(0), uploadTargetHash)
                        .done(data => {
                            if (data.added && data.added.length) {
                                fm.url(data.added[0].hash, { async: true }).done(function(url) {
                                    resolve({
                                        'default': fm.convAbsUrl(url)
                                    });
                                    fmNode.dialogelfinder('close');
                                }).fail(function() {
                                    reject('errFileNotFound');
                                });
                            } else {
                                reject(fm.i18n(data.error? data.error : 'errUpload'));
                                fmNode.dialogelfinder('close');
                            }
                        })
                        .fail(err => {
                            const error = fm.parseError(err);
                            reject(fm.i18n(error? (error === 'userabort'? 'errAbort' : error) : 'errUploadNoFiles'));
                        });
                }).catch((fm, err) => {
                    const error = fm.parseError(err);
                    reject(fm.i18n(error? (error === 'userabort'? 'errAbort' : error) : 'errUploadNoFiles'));
                });
            };

            this.upload = function() {
                return new Promise(function(resolve, reject) {
                    if (loader.file instanceof Promise || (loader.file && typeof loader.file.then === 'function')) {
                        loader.file.then(function(file) {
                            upload(file, resolve, reject);
                        });
                    } else {
                        upload(loader.file, resolve, reject);
                    }
                });
            };
            this.abort = function() {
                _fm && _fm.getUI().trigger('uploadabort');
            };
        };

        // Set up image uploader
        fileRepo.createUploadAdapter = loader => {
            return new uploder(loader);
        };
        
        
        
    } )
    .catch( error => {
        console.error( error );
    } );


    let form_original_data = $("#savePosts").serialize();
    let editor_content = $('.ck-content').html();

    //publish
    $('input[type=checkbox]').click(function(e){
       e.preventDefault();
        publishedPosts();
    })

    $('input[type=text], textarea, .ck-cotent').on('keypress keyup change blur',function(){
        savePosts();
    })

    $('#dialogFilemanager').on('hidden.bs.modal', function () {
        console.log('sample');
        savePosts();
    });

    $('.ck-content').on('change keypress keyup paste', function(){
        savePosts();
    })

    $('input[name=title]').on('keyup',function(){
        $('#url').text(function(){
            url = $('input[name=title]').val().trim().replace(/[^a-z0-9+]+/gi, '-').toLowerCase()
            $('input[name=url]').val(url)
            $('#preview').attr('href', '<?=base_url()?>preview/<?=$url?>/' + url)
            return url
        })
    })

    function savePosts(){
        if (form_original_data != $("#savePosts").serialize() || editor_content != $('.ck-content').html()){
            form_original_data = $("#savePosts").serialize();
            editor_content = $('.ck-content').html();

            let data = { 
                postid: $('input[name=postid]').val(),
                title: $('input[name=title]').val(),
                description: $('textarea[name=description]').val(),
                post: $('.ck-content').html(),
                type: $('input[name=type]').val(),
                image: $('input[name=image]').val()                
            }

            console.log(data);

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
    
})
        
    </script>

    <style>
    .ck .ck-content {
        min-height: 500px!important;
    }
    
    </style>