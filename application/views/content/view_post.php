<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 60px auto 0;">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body pt-1">           
            <!--Content -->
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card rounded">                            
                        <div class="card-content" style="padding: 0 0 10px !important;">
                            <div class="card-body" style="padding: 10px!important;">
                                <div style="width: 50px; float: left; height: 100%; text-align: center;">
                                    <a href="<?=base_url()?>users/">
                                        <span class="avatar avatar-online" style="vertical-align: middle!important;">
                                        <?php
                                            $photo = empty($post['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$post['photo'];
                                        ?>
                                            <img src="<?=base_url().$photo?>" alt="avatar">
                                        </span>
                                    </a>
                                    <br/>
                                    <a href="" class="btn hover-gray btn_upvote" data-id="<?=$post['postid']?>">
                                        <i class="fa fa-arrow-up"></i>
                                    </a>
                                    <span class="d-block text-center" id="vote_<?=$post['postid']?>"><?=$post['vote']?></span>
                                    <a href="" class="btn hover-gray btn_downvote" data-id="<?=$post['postid']?>">
                                        <i class="fa fa-arrow-down"></i>
                                    </a>
                                </div>
                                <div style="width: calc(100% - 50px); float: left;">
                                    <span class="blue-grey">Posted by <a href="<?=base_url()?>users/profile/<?=$post['username']?>"><?=$post["username"]?></a> on <?=$this->util->get_chat_time($post['seconds'], $post['date'])?></span>
                                    <hr style="margin: 5px 0;"/>
                                    <h4 class="text-bold-500 black mb-1"><?=$post['title']?></h4>
                                    <div class="post_content">
                                        <?=$post['post']?>
                                    </div>
                                    <div class="mt-1">
                                        <a class="blue-grey text-bold-700 hover-gray"><i class="ft-message-square fa-lg"></i>&nbsp;<?=$post['comments']?>&nbsp;Comments</a> 
                                        <?php
                                            if ($user['id'] == $post['userid']){
                                                ?>
                                                    <a class="blue-grey text-bold-700 hover-gray btn_remove" data-id="<?=$post['postid']?>"><i class="ft-trash fa-lg"></i>&nbsp;Remove</a> 
                                                <?php
                                            }
                                        ?>
                                    </div>              
                                   
                                    <hr style="margin: 10px 0 5px;"/>
                                   
                                    <!--Start Record Audio-->
                                    <link href="<?=base_url()?>assets/recorder/video-js.min.css" rel="stylesheet">
                                    <link href="<?=base_url()?>assets/recorder/videojs.wavesurfer.min.css" rel="stylesheet">
                                    <link href="<?=base_url()?>assets/recorder/videojs.record.min.css" rel="stylesheet">
                                    <script src="<?=base_url()?>assets/recorder/video.min.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/RecordRTC.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/adapter.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/wavesurfer.min.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/wavesurfer.microphone.min.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/videojs.wavesurfer.min.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/videojs.record.min.js"></script>
                                    <script src="<?=base_url()?>assets/recorder/browser-workarounds.js"></script>

                                    <link href="<?=base_url()?>assets/vendors/dropzone/dropzone.css" rel="stylesheet">
                                    <script src="<?=base_url()?>assets/vendors/dropzone/dropzone.js"></script>

                                    <div class="p-md-1">
                                        <?php
                                        if (isset($user["username"])){
                                        ?>                     
                                        <span class="blue-grey">Comment as <strong><?=$user["username"]?></strong></span>
                                        <br/>
                                        <?php
                                        }
                                        ?>   
                                        <div class="audio-comment bg-blue">                                            
                                            <div>
                                                <div class="text-center mt-2">
                                                    <i class="ft-mic fa-5x p-1 white"></i>
                                                    <h5 class="m-0 p-1 white" style="vertical-align: middle;" id="record-message">Tap to record a comment.</h5>  
                                                </div>    
                                                <div style="margin: 10px auto; width: 270px;" class="text-center">
                                                    <span onclick="recordAudio();" id="recorder-main" class="d-inline-block" style="background: rgba(0, 0, 0, 0.5); height: 68px; padding: 10px; border-radius: 50px; color: #fff!important; cursor: pointer;">
                                                        <button class="btn btn_record " style="background: red; border-radius: 50%; width: 48px; height: 48px; color: #fff;"><i class="fa fa-microphone fa-lg"></i></button>                                                                                                       
                                                        <h5 class="d-none m-0 p-0 ml-auto text-bold-500" style="vertical-align: middle; width: 50px;" id="record-timer"></h5>
                                                    </span>
                                                    <span id="record_post" class="d-none" style="background: rgba(0, 0, 0, 0.5); width: 68px; border-radius: 50px; margin: 0 auto; color: #fff!important;" data-toggle="tooltip" data-placement="bottom" title="Post comment">
                                                        <button class="btn d-inline-block" onclick="upload();"  style="background: green; border-radius: 50%; width: 48px; height: 48px; margin: 10px; color: #fff;"><i class="fa fa-check fa-lg"></i></button>                              
                                                    </span>                                                   
                                                    <span id="attach_post" class="d-none" style="background: rgba(0, 0, 0, 0.5); width: 68px; border-radius: 50px; margin: 0 auto; color: #fff!important;" data-toggle="tooltip" data-placement="bottom" title="Attach image or link">
                                                        <button class="btn d-inline-block" style="background: #adadad; border-radius: 50%; width: 48px; height: 48px; margin: 10px; color: #fff;"><i class="fa fa-paperclip fa-lg"></i></button>                              
                                                    </span>
                                                </div>   
                                            </div>  
                                        </div>     
                                    </div>                      
                                    <audio id="myAudio" class="video-js vjs-default-skin d-none"></audio>

                                    <!--End Record Audio-->
                                   
                                    <div class="p-md-1">    
                                        <!--Start Audio Player-->   
                                        <?php
                                        
                                        foreach($comments as $comment){
                                            $extn = strpos($comment["filename"], '.') !== false ? explode('.', $comment["filename"])[1] : '';                        
                                            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/audio/'.$comment["filename"]) && in_array($extn, array('ogg', 'wav'))){
                                        ?>
                                        <div class="audio-comment" style="background: #f5f5f5;">
                                            <span class="avatar avatar-online" style="vertical-align: middle!important;">
                                                <?php
                                                    $comment_photo = empty($comment['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$comment['photo'];
                                                ?>
                                                <img src="<?=base_url().$comment_photo?>" alt="avatar">
                                            </span>
                                            <span class="blue-grey"><strong><?=$comment["username"]?></strong> on <?=$this->util->get_chat_time($comment["seconds"], $comment["date"])?></span>
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
                                                    height: 50,
                                                    barGap: 2,
                                                    mediaControls: true,
                                                    autoCenter: true,
                                                    hideScrollbar: true,
                                                });
                                                
                                                wavesurfer.load('<?=base_url()?>uploads/audio/<?=$comment["filename"]?>');
                                            </script>
                                             <!--Image-->
                                             <?php
                                                if (!empty($comment['link'])){
                                            ?>
                                                <a href="<?=$comment['link']?>" class="pb-1" target="_blank"><i class="fa fa-link"></i>&nbsp;<?=$comment['link']?></a>
                                            <?php
                                                }
                                            ?>
                                            <!--Image-->
                                            <?php
                                                if (!empty($comment["link_photo"]) && file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/images/comments/'.$comment["link_photo"])){
                                            ?>
                                                <img src="<?=base_url()?>uploads/images/comments/<?=$comment['link_photo']?>" style="width: 100%; height: auto;">
                                            <?php
                                                }
                                            ?>

                                            <div class="mt-1 mb-1">
                                                <a class="blue-grey text-bold-700 hover-gray btn_reply" data-id="<?=$comment["id"]?>"><i class="ft-corner-up-left fa-lg"></i>&nbsp;&nbsp;Reply</a> 
                                                <a class="blue-grey text-bold-700 hover-gray btn_upvote_comment" data-id="<?=$comment["id"]?>"><i class="ft-arrow-up fa-lg"></i><span id="upvote_<?=$comment["id"]?>"><?=$comment['upvote']?></span>&nbsp;Up vote</a> 
                                                <a class="blue-grey text-bold-700 hover-gray btn_downvote_comment" data-id="<?=$comment["id"]?>"><i class="ft-arrow-down fa-lg"></i><span id="downvote_<?=$comment["id"]?>"><?=$comment['downvote']?></span>&nbsp;Down vote</a> 
                                                <?php
                                                    if ($user['id'] == $comment['userid']){
                                                        ?>
                                                            <a class="blue-grey text-bold-700 hover-gray btn_remove_comment" data-id="<?=$comment["id"]?>" data-file="<?=$comment["filename"]?>"><i class="ft-trash fa-lg"></i>&nbsp;Remove</a> 
                                                        <?php
                                                    }
                                                ?>
                                            </div>      
                                            <div id="recorder_<?=$comment["id"]?>" class="pl-md-2">
                                            <?php
                                                if ($comment["replies"] > 0) {
                                            ?>                                            
                                                <div class="card m-0" style="margin: 5px 0!important; padding: 5px; border-radius: 5px;">                     
                                                    <div id="heading_<?=$comment["id"]?>">                                                        
                                                        <a data-toggle="collapse" href="#collapse_<?=$comment["id"]?>" aria-expanded="false" aria-controls="accordion1" class="collapsed blue-grey text-bold-700 btn_view_replies" data-id="<?=$comment['id']?>">View replies</a><br />                           
                                                    </div>
                                                    <div id="collapse_<?=$comment["id"]?>" role="tabpanel" aria-labelledby="<?=$comment["id"]?>" class="collapse">
                                                        <div class="card-content p-0">
                                                            <div class="card-body p-0 reply_con_<?=$comment["id"]?>" style="padding:5px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                            <?php
                                                }
                                            ?>
                                             </div>
                                        </div>
                                            
                                        <?php
                                            }
                                        }
                                        ?>

                                        <div id="reply_recorder" class="d-none">
                                            <?php
                                            if (isset($user["username"])){
                                            ?>                     
                                            <span class="blue-grey">Reply as <strong><?=$user["username"]?></strong></span>
                                            <br/>
                                            <?php
                                            }
                                            ?>   
                                            <div class="bg-blue" style="padding: 5px; border-radius: 5px;" >                                                
                                                <div class="text-center mt-2">                                                   
                                                    <h5 class="d-inline-block m-0 p-0 white" style="vertical-align: middle;" id="reply-message">Tap to record a reply.</h5>                                        
                                                </div>    
                                                <div style="margin: 10px auto; max-width: 200px;" class="text-center">
                                                    <span onclick="recordAudioReply();" class="d-inline-block" style="background: rgba(0, 0, 0, 0.5); height: 68px; padding: 10px; border-radius: 50px; color: #fff!important; cursor: pointer;">
                                                        <button class="btn btn_record_reply " style="background: red; border-radius: 50%; width: 48px; height: 48px; color: #fff;"><i class="fa fa-microphone fa-lg"></i></button>                                                                                                       
                                                        <h5 class="d-none m-0 p-0 text-bold-500" style="vertical-align: middle;" id="reply-timer"></h5>
                                                    </span>
                                                    <span id="record_reply" class="d-none" style="background: rgba(0, 0, 0, 0.5); width: 68px; border-radius: 50px; margin: 0 auto; color: #fff!important;" data-toggle="tooltip" data-placement="bottom" title="Post reply">
                                                        <button class="btn d-inline-block" onclick="upload();"  style="background: green; border-radius: 50%; width: 48px; height: 48px; margin: 10px; color: #fff;"><i class="fa fa-check fa-lg"></i></button>                              
                                                    </span>
                                                </div>   
                                            </div>     
                                                                             
                                        </div>
                                           
                                        <!--End Audio Player--> 
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card rounded">
                        <div class="card-content">
                            <h5 class="p-1 text-bold-500 mb-0">
                                <span class="avatar avatar-online" style="vertical-align: middle!important;">
                                <?php
                                    $photo = empty($post['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$post['photo'];
                                ?>
                                    <img src="<?=base_url().$photo?>" alt="avatar">
                                </span>  
                                Topics posted by <a href="<?=base_url()?>users/profile/<?=$post['username']?>"><?=$post['username']?></a>
                            </h5>
                            <ul class="list-group list-group-flush">                               
                            <?php
                            $post_by_author = array_splice($related_posts, 0, 10);
                            foreach($post_by_author as $row){
                            ?>
                                <li class="list-group-item">
                                    <a href="<?=base_url()?>posts/view/<?=$row["slug"]?>" class="blue-grey">
                                        <h5 class="m-0"><?=$row["title"]?></h5>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                            <?php
                            if ( count($related_posts) > 10) {
                            ?>
                            <a href="<?=base_url()?>posts/lists/<?=$post['username']?>" class="btn bg-blue white text-bold-700 d-block m-1">VIEW ALL</a>
                            <?php
                            }
                            ?>         
                        </div>
                    </div>

                    <div class="card rounded">                       
                        <div class="card-content">
                            <h4 class="p-1 text-bold-500 mb-0 black">Latest</h4>
                            <ul class="list-group list-group-flush">                               
                            <?php
                            foreach($latest as $topic){
                            ?>
                                <li class="list-group-item">
                                    <a href="<?=base_url()?>posts/view/<?=$topic["slug"]?>" class="blue-grey">
                                        <h5 class="m-0"><?=$topic["title"]?></h5>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                            <a href="<?=base_url()?>" class="btn bg-blue white text-bold-700 d-block m-1">VIEW ALL</a>
                                           
                        </div>
                    </div>

                    <div class="card rounded">                       
                        <div class="card-content">                           
                            <h4 class="p-1 text-bold-500 mb-0 black"><i class="ft-trending-up"></i>&nbsp;Trending</h4>
                            <ul class="list-group list-group-flush">     
                            <?php
                            foreach($trending as $topic){
                            ?>
                                 <li class="list-group-item">
                                    <a href="<?=base_url()?>posts/view/<?=$topic["slug"]?>" class="blue-grey">
                                        <h5 class="m-0"><?=$topic["title"]?></h5>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>                           
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<!-- END: Content-->

<!-- Drop Zone -->


 <!-- Login Modal -->
 <div class="modal fade text-left" id="attachModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mt-5">
            <div class="modal-header p-2">
                <h4 class="modal-title" id="myModalLabel1">ATTACH LINK OR IMAGE TO COMMENT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-2">
            
                     
                <form method="post" id="frmAttach">
                    <input type="hidden" name="image_file" />
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="small">LINK</label>
                            <input type="text" class="form-control static-label" name="link" />
                        </div>
                    </div>
                    <div id="dropzone" style="text-align: center; width: 100%; height: 200px; border-radius: 5px; padding: 10px; border: 1px solid #cacaca;">                        
                            <h4>Click to upload image</h4>
                    </div>                    
                    <input type="submit" class="btn btn-success btn-min-width btn_upload_post mt-1 pull-right" value="POST COMMENT"/>
                </form>        

            </div>

        </div>
    </div>
</div>


<?php
//require login to record audio and post comment
//if (isset($user["username"])){
?>     
<!--Video JS-->
<script>

window.HELP_IMPROVE_VIDEOJS = false;

var options = {
    controls: true,
    width: 600,
    height: 300,
    plugins: {
        wavesurfer: {
            src: 'live',
            waveColor: '#36393b',
            progressColor: 'black',
            debug: true,
            cursorWidth: 1,
            msDisplayMax: 20,
            hideScrollbar: true
        },
        record: {
            audio: true,
            video: false,
            maxLength: 600,
            debug: true,
            timeSlice: 1000
        }
    }
};

// apply some workarounds for certain browsers
applyAudioWorkaround();

var segmentNumber = -1;
var is_ready = false;
var commentid = '';
var is_main_recorder = true;
var img_filename = '';

// create player
var player = videojs('myAudio', options, function() {
    // print version information at startup
    var msg = 'Using video.js ' + videojs.VERSION +
        ' with videojs-record ' + videojs.getPluginVersion('record') +
        ', videojs-wavesurfer ' + videojs.getPluginVersion('wavesurfer') +
        ', wavesurfer.js ' + WaveSurfer.VERSION + ' and recordrtc ' +
        RecordRTC.version;
    videojs.log(msg);
});

// error handling
player.on('deviceReady', function() {
    is_ready = true;
    if (is_main_recorder){
        $('.btn_record').html('<i class="fa fa-stop fa-lg"></i>');
        $('#record-message').text('Recording...');   
    }else{
        $('.btn_record_reply').html('<i class="fa fa-stop"></i>');
        $('#reply-message').text('Recording...');   
    }
    player.record().start();
});

// error handling
player.on('deviceError', function() {
    console.log('device error:', player.deviceErrorCode);
});

player.on('error', function(element, error) {
    console.error(error);
});

// user clicked the record button and started recording
player.on('startRecord', function() {
    console.log('started recording!');
});

// user completed recording and stream is available
player.on('finishRecord', function() {
    // the blob object contains the recorded data that
    // can be downloaded by the user, stored on server etc.
    console.log('finished recording: ', player.recordedData);
});

player.on('timestamp', function() {
    segmentNumber++;
    //console.log(new Date(segmentNumber * 1000).toISOString())
    if (segmentNumber >= 3600){
        if (is_main_recorder){
            $('#record-timer').removeClass('d-none').addClass('d-inline-block');
            $('#record-timer').text(new Date(segmentNumber * 1000).toISOString().substr(11, 8));
        }else{
            $('#reply-timer').removeClass('d-none').addClass('d-inline-block');
            $('#reply-timer').text(new Date(segmentNumber * 1000).toISOString().substr(11, 8));
        }
        
    }else{
        if (is_main_recorder){
            $('#record-timer').removeClass('d-none').addClass('d-inline-block');
            $('#record-timer').text(new Date(segmentNumber * 1000).toISOString().substr(14, 5));
        }else{
            $('#reply-timer').removeClass('d-none').addClass('d-inline-block');
            $('#reply-timer').text(new Date(segmentNumber * 1000).toISOString().substr(14, 5));
        }
       
    }
    
});


function upload() {
    
    if (is_main_recorder){
        $('#record-message').text('Uploading...');
        $('.btn_record').attr('disabled', true);
    }else{
        $('#reply-message').text('Uploading...');
        $('.btn_record_reply').attr('disabled', true);
    }
   
               
    var data = player.recordedData;
    if (player.recordedData.audio) {
        // for chrome for audio+video
        data = player.recordedData.audio;
    }

    var blob = data instanceof Blob ? data : data.blob;
    var fileType = blob.type.split('/')[0] || 'audio';
    var fileName = (Math.random() * 1000).toString().replace('.', '') + '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
   
    var formData = new FormData();
        formData.append('filename', fileName);
        formData.append('audio', blob);    
        formData.append('postid', '<?=$post["postid"]?>');    
        formData.append('userid', '<?=$user["id"]?>');
        formData.append('image_file', img_filename);
        formData.append('link', $('input[name="link"]').val());

    var url = '<?=base_url()?>index.php/comments/do_upload';
    
    if (!is_main_recorder){      
        url = '<?=base_url()?>index.php/comments/do_upload_reply';
        formData.append('commentid', commentid);
    }

    xhr(url, formData, function (fileName) {
    });

    function xhr(url, data, callback) {
    	var request = new XMLHttpRequest();
    	request.onreadystatechange = function () {
    		if (request.readyState == 4 && request.status == 200) {
                callback(location.href + request.responseText);
                console.log("Your comment has been successfully posted."); 
                setTimeout(() => {          
                    if (is_main_recorder){
                        $('#record-message').text('Success!...');
                    }else{
                        $('#reply-message').text('Success!...');
                    }                    
                }, 500);   
                
                setTimeout(() => {    
                    if (is_main_recorder){
                        $('#record-message').text('Tap to record a comment.');
                        $('.btn_record').removeAttr('disabled');   
                    }else{
                        $('#reply-message').text('Tap to record a reply.');
                        $('.btn_record_reply').removeAttr('disabled');   
                    }                    
                    player.record().destroy();
                    window.location.reload();
                }, 1000);   	
               
    		}
    	};
    	request.open('POST', url);
    	request.send(data);
    }

}

function recordAudio(){    
    is_main_recorder = true;
    //check if users is logged in
    let user = '<?=$user["username"]?>';
    if (user.trim().length <= 0){
        swal({
            title: 'Oh snap!',
            text: 'You need to log in to leave audio comments.',
            icon: 'error',
            showCancelButton: false,
            closeOnConfirm: false,
            allowOutsideClick: false,
            }).then(()=> {
                $('#loginModal').modal('show');
            }); 
       
        return;
    }

    if (player.record().isRecording() == false){                
        segmentNumber = 0;
        player.record().getDevice();  
        if (is_ready == false){           
            $('#record-message').html('Please wait...!'); 
        }
        $('#record_post').removeClass('d-inline-block').addClass('d-none');
        $('#attach_post').removeClass('d-inline-block').addClass('d-none');
    }else{
        player.record().stop(); 
        $('.btn_record').html('<i class="fa fa-undo fa-lg"></i>');
        $('#record_post').removeClass('d-none').addClass('d-inline-block');
        $('#attach_post').removeClass('d-none').addClass('d-inline-block');
        $('#record-message').html('Click <i class="ft-check"></i> to save comment.');         
    }   
}


function recordAudioReply(){    
    is_main_recorder = false;
    //check if users is logged in
    let user = '<?=$user["username"]?>';
    if (user.trim().length <= 0){
        swal({
            title: 'Oh snap!',
            text: 'You need to log in to leave audio comments.',
            icon: 'error',
            showCancelButton: false,
            closeOnConfirm: false,
            allowOutsideClick: false,
            }).then(()=> {
                $('#loginModal').modal('show');
            }); 
       
        return;
    }

    //console.log(player.record().isRecording());
    if (player.record().isRecording() == false){        
        segmentNumber = 0;
        player.record().getDevice();
        if (is_ready == false){           
            $('#reply-message').html('Please wait...!'); 
        }
        $('#record_reply').removeClass('d-inline-block').addClass('d-none');
    }else{
        player.record().stop();      
        $('.btn_record_reply').html('<i class="fa fa-undo"></i>');
        $('#record_reply').removeClass('d-none').addClass('d-inline-block');
        $('#reply-message').html('Click <i class="ft-check"></i> to save reply.');         
    }   
}


$(function(){
    let user = '<?=$user["username"]?>';

    $('body').on('click', '.btn_remove', function(e){
        e.preventDefault();

        let url = '<?=base_url()?>posts/delete';
        let data = {
            id: $(this).attr('data-id')
        }

        let con = $(this).parent().parent();

        swalPrompt("Are you sure you want to delete this post?", "Delete")
        .then((confirm) =>{
            if(confirm){
                ajax(url, data).done(function(results){
                    if(results.message == "success"){                        
                        swal("Success!", "You have successfully deleted a post.", "success");
                        setTimeout(() => {
                            con.remove();
                        }, 800);
                        
                    }else{
                        swal("Oh Snap!", results.message, "error");
                    }
                })
            }
        })
    })


    let checkUser = (message = '') => {
        
        if (user.trim().length <= 0){
            message = message.trim().length == 0 ? 'You need to log in to upvote or downvote.' : message;
            swal({
                title: 'Oh snap!',
                text: message,
                icon: 'error',
                showCancelButton: false,
                closeOnConfirm: false,
                allowOutsideClick: false,
                }).then(()=> {
                    $('#loginModal').modal('show');
                }); 
        
            return;
        }
    }

    $('body').on('click', '.btn_upvote', function(e){
        e.preventDefault();
        checkUser();
        let postid = $(this).attr('data-id');
            
        if (user.trim().length > 0){
            let url = '<?=base_url()?>posts/vote';
            let data = {
                vote: 1,
                postid: postid,
            }

            ajax(url, data).done(function(results){
                let vote = parseFloat($('#vote_' + postid).text());
                
                if (results.message == 'success'){
                    $('#vote_' + postid).text( results.vote );                     
                }
            })
        }

    })

    $('body').on('click', '.btn_downvote', function(e){
        e.preventDefault();
        checkUser();
        let postid = $(this).attr('data-id');

        if (user.trim().length > 0){
            let url = '<?=base_url()?>posts/vote';
            let data = {
                vote: 2,
                postid: postid,
            }

            ajax(url, data).done(function(results){
                if (results.message == 'success'){
                    $('#vote_' + postid).text( results.vote );           
                }
            })
        }
    })


    $('body').on('click', '.btn_reply', function(e){
        e.preventDefault();
        checkUser('You need to log in to leave audio comments.');

        if (user.trim().length > 0){
        commentid = $(this).attr('data-id');

        $("#reply_recorder").removeClass("d-none");
        $("#reply_recorder").prependTo('#recorder_' + commentid);
        }
    })

    $('body').on('click', '.btn_view_replies', function(e){
        let id = $(this).attr('data-id');

        let url = '<?=base_url()?>comments/get_replies';

        ajaxHtml(url, {id: id}).done(function (results){
            console.log(results)
            $('.reply_con_' + id).html(results);
        })

    })

    $('body').on('click', '.btn_remove_reply', function(e){
        e.preventDefault();
        
        let url = '<?=base_url()?>comments/delete_reply';
        let data = {
            id: $(this).attr('data-id'),
            file: $(this).attr('data-file'),
        }

        let con = $(this).parent().parent();

        swalPrompt("Are you sure you want to delete this reply?", "Delete")
        .then((confirm) =>{
            if(confirm){
                ajax(url, data).done(function(results){
                    if(results.message == "success"){                        
                        swal("Success!", "You have successfully deleted a reply.", "success");
                        setTimeout(() => {
                            con.remove();
                            //window.location.href = '<?=base_url()?>';
                        }, 800);
                        
                    }else{
                        swal("Oh Snap!", results.message, "error");
                    }
                })
            }
        })
    })

    $('body').on('click', '.btn_remove_comment', function(e){
        e.preventDefault();
        
        let url = '<?=base_url()?>comments/delete';
        let data = {
            id: $(this).attr('data-id'),
            file: $(this).attr('data-file'),
        }

        let con = $(this).parent().parent();

        swalPrompt("Are you sure you want to delete this comment?", "Delete")
        .then((confirm) =>{
            if(confirm){
                ajax(url, data).done(function(results){
                    if(results.message == "success"){                        
                        swal("Success!", "You have successfully deleted a comment.", "success");
                        setTimeout(() => {
                            con.remove();
                            //window.location.href = '<?=base_url()?>';
                        }, 800);
                        
                    }else{
                        swal("Oh Snap!", results.message, "error");
                    }
                })
            }
        })
    })

    $('body').on('click', '.btn_upvote_comment', function(e){
        e.preventDefault();
        checkUser();
        let postid = $(this).attr('data-id');
            
        if (user.trim().length > 0){
            let url = '<?=base_url()?>comments/vote';
            let data = {
                vote: 1,
                postid: postid,
                type: 2
            }

            ajax(url, data).done(function(results){                   
                $('#upvote_' + postid).text( results.upvote );    
                $('#downvote_' + postid).text( results.downvote );  
            })
        }

    })

    $('body').on('click', '.btn_downvote_comment', function(e){
        e.preventDefault();
        checkUser();
        let postid = $(this).attr('data-id');

        if (user.trim().length > 0){
            let url = '<?=base_url()?>comments/vote';
            let data = {
                vote: 2,
                postid: postid,                
                type: 2
            }

            ajax(url, data).done(function(results){
                $('#upvote_' + postid).text( results.upvote );    
                $('#downvote_' + postid).text( results.downvote );  
            })
        }
    })

    $('body').on('click', '#attach_post', function(e){
        e.preventDefault();

        $('#attachModal').modal('show');
        
    })

    //DropZone
    var myDropzone = new Dropzone("#dropzone", {
        url: '<?=base_url()?>index.php/comments/do_upload_image',
        uploadMultiple: false,
        autoProcessQueue: false,
        acceptedFiles: '.jpeg, .jpg, .png',
        init: function () {
            //send all the form data along with the files:
            this.on("sending", function (data, xhr, formData) {
            });

            this.on("uploadprogress", function (progress) {
                console.log(progress)
            })

            this.on("success", function (data, response) {
                //upload audio               
                img_filename = response.filename;
                upload();
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
                }
            })
        }
    });

    $('body').on('click', '.btn_upload_post', function(e){
        e.preventDefault();
        myDropzone.processQueue();
    })

    $('body').on('click', '#dropzone', function(e){
        e.preventDefault();

        myDropzone.removeAllFiles();
    })

})
</script>
<?php
//}
?>  

<style>
wave > wave {
    border: none!important;
}
</style>
