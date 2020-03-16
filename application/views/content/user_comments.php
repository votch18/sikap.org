<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendors/css/tables/datatable/datatables.min.css">
<script src="<?=base_url()?>assets/vendors/js/tables/datatable/datatables.min.js"></script>

<!--Start Record Audio-->
<link href="<?=base_url()?>assets/recorder/video-js.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/recorder/videojs.wavesurfer.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/recorder/videojs.record.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/recorder/examples.css" rel="stylesheet">
<script src="<?=base_url()?>assets/recorder/video.min.js"></script>
<script src="<?=base_url()?>assets/recorder/RecordRTC.js"></script>
<script src="<?=base_url()?>assets/recorder/adapter.js"></script>
<script src="<?=base_url()?>assets/recorder/wavesurfer.min.js"></script>
<script src="<?=base_url()?>assets/recorder/wavesurfer.microphone.min.js"></script>
<script src="<?=base_url()?>assets/recorder/videojs.wavesurfer.min.js"></script>
<script src="<?=base_url()?>assets/recorder/videojs.record.min.js"></script>
<script src="<?=base_url()?>assets/recorder/browser-workarounds.js"></script>

<div class="navbar navbar-horizontal navbar-light navbar-shadow mb-3" style="width: 100%; ">  
    <div class="navbar-container" style="max-width: 1200px; margin: 60px auto 0;">
        <ul class="nav navbar-nav d-inline-block" >
            <li class="nav-item d-inline-block mr-1 pl-1 pr-1" >
                <a class="nav-link" href="<?=base_url()?>users/profile/">
                    <i class="ft-file-text"></i><span class="d-none d-md-inline-block">Posts</span>
                </a>          
            </li>          
            <li class="nav-item d-inline-block mr-1 pl-1 pr-1" style="border: 1px solid #2196f3; border-width: 0 0 3px 0;" >
                <a class="nav-link" href="<?=base_url()?>users/comments/">
                <i class="ft-message-square"></i><span class="d-none d-md-inline-block">Comments</span>
                </a>          
            </li>
            <li class="nav-item d-inline-block mr-1 pl-1 pr-1" >
                <a class="nav-link" href="<?=base_url()?>users/activities/">
                <i class="ft-activity"></i><span class="d-none d-md-inline-block">Activities</span>
                </a>          
            </li>
          
        </ul>
    </div>
</div>

<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 0 auto;">
    <div class="content-wrapper pt-0">
        <div class="content-header row">
        </div>
        <div class="content-body">          
            <!--Content -->
           
            <div class="row">
                <div class="col-lg-8">
                    <div class="card rounded m-0" style="margin-bottom: 10px!important;">   
                        <div class="card-content">
                            <div class="card-body" style="vertical-align: middle;">
                                <h4 class="card-title">COMMENTS</h4>
                                <h6 class="card-subtitle text-muted">List of comments you have recorded.</h6>
                                <table class="table" id="dataTable">   
                                    <thead class="d-none">
                                        <th></th>
                                        <th></th>
                                    </thead>                                
                                    <tbody>
                                        <?php
                                        $prev_title = "";
                                        foreach($comments as $comment){
                                            if ($prev_title != $comment['title']) {
                                        ?>
                                         <tr>
                                                <td>
                                                    <h4 class=" text-bold-500 black pt-2">  
                                                        <?=$comment['title']?>
                                                        <span class="text-muted small"><i class="ft-user"></i> <?=$comment['username']?></span>   
                                                    </h4>                                                                                 
                                                </td>     
                                                <td>  
                                                </td>                                        
                                            </tr>
                                            <?php
                                            }

                                            $extn = strpos($comment["filename"], '.') !== false ? explode('.', $comment["filename"])[1] : '';                        
                                            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/posts/'.$comment["filename"]) && in_array($extn, array('ogg', 'wav'))){

                                            ?>
                                            <tr>
                                                <td style="width: calc(100% - 120px);">
                                                <div class="audio-comment ml-2">
                                                    <span><?=$comment["username"]?> on <?=$this->util->get_chat_time($comment["seconds"], $comment["date"])?></span>
                                                    <hr style="margin: 5px 0;"/>
                                                    <div id="waveform_<?=$comment["id"]?>"></div>                                                        
                                                    <script>                                                
                                                        var wavesurfer = WaveSurfer.create({
                                                            container: '#waveform_' + '<?=$comment["id"]?>',
                                                            waveColor: 'grey',
                                                            progressColor: 'blue',
                                                            backend: 'MediaElement',
                                                            barWidth: 2,
                                                            cursorWidth: 1,
                                                            height: 100,
                                                            barGap: 2,
                                                            mediaControls: true,
                                                            autoCenter: true,
                                                            hideScrollbar: true,
                                                        });
                                                        
                                                        wavesurfer.load('<?=base_url()?>uploads/posts/<?=$comment["filename"]?>');
                                                    </script>

                                                </div>                                                 
                                                </td>
                                                <td style="vertical-align: middle; text-align: right; width: 60px;">                                                   
                                                    <button class="btn btn-danger btn_delete" data-id="<?=$comment['id']?>"   data-filename="<?=$comment['filename']?>"data-toggle="tooltip" data-placement="top" title="Delete"><i class="ft-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                            $prev_title = $comment['title'];
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                   <?php $this->load->view('shared/profile') ?>
                </div>
            </div>        
        </div>
    </div>
</div>
<!-- END: Content-->

<script>
    $(function(){       
        $('#dataTable').dataTable({
            "pageLength": 25, 
            "bLengthChange": false,
            "searching": false,
            "info": true,
            "ordering": false,
            "autoWidth": false
        });

        $('body').on('click', '.btn_delete', function(e){
            e.preventDefault();
            let url = '<?=base_url()?>comments/delete';
            let data = {
               id: $(this).attr('data-id'),
               file: $(this).attr('data-filename'),
            }

           let $row = $(this).parent().parent();

            swalPrompt("Are you sure you want to delete this comment?", "Delete")
           .then((confirm) =>{
                if(confirm){
                   ajax(url, data).done(function(results){
                       if(results.message == "success"){
                            $row.remove();
                            swal("Success!", "You have successfully deleted a comment.", "success");
                       }else{
                            swal("Oh Snap!", "An error occured while deleting your comment.", "error");
                       }
                   })
                }
           })
        })

    })
</script>