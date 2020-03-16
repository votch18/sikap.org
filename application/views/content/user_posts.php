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

<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 60px auto 0;">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">          
            <!--Content -->           
            <div class="row">
                <div class="col-lg-4">
                   <?php $this->load->view('shared/profile') ?>
                </div>
                <div class="col-lg-8">
                    <div class="card rounded" style="margin-bottom: 10px!important;">   
                        <div class="card-content">
                            <div class="card-body" style="vertical-align: middle;">
                                <ul class="nav nav-tabs no-hover-bg nav-underline" role="tablist">
                                    <li class="nav-item" >
                                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#post" aria-controls="post" role="tab" aria-selected="true">
                                            <i class="ft-file-text"></i><span class="d-none d-md-inline-block">Posts</span>
                                        </a>          
                                    </li>          
                                    <li class="nav-item" >
                                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" aria-controls="link1" role="tab" aria-selected="false">
                                        <i class="ft-message-square"></i><span class="d-none d-md-inline-block">Comments</span>
                                        </a>          
                                    </li>
                                    <li class="nav-item" >
                                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" aria-controls="link1" role="tab" aria-selected="false">
                                        <i class="ft-user"></i><span class="d-none d-md-inline-block">Profile</span>
                                        </a>          
                                    </li>
                                 
                                </ul>

                                <div class="tab-content pt-1">
                                    <div class="tab-pane active in pt-1" id="post" aria-labelledby="posts-tab" role="tabpanel">
                                    <h3>Posts</h3>
                                    <hr/>    
                                    <?php
                                        foreach($posts as $post){
                                        ?>
                                    
                                            <div class="card rounded" style="margin-bottom: 10px!important;">                            
                                                <div class="card-content" style="padding: 0 0 10px !important;">
                                                    <div class="card-body" style="padding: 10px!important;">
                                                        <div style="width: 50px; float: left; text-align: center; ">
                                                            <span class="avatar avatar-online" style="vertical-align: middle!important;">
                                                            <?php
                                                                $photo = empty($post['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$post['photo'].'?'.strtotime("now");
                                                            ?>
                                                                <img src="<?=base_url().$photo?>" alt="avatar">
                                                            </span>
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
                                                            <span class="blue-grey">Posted by <a href="<?=base_url()?>users/profile/<?=$post['username']?>"><?=$post['username']?></a> on <?=$this->util->get_chat_time($post["seconds"], $post["date"])?></span>
                                                            <hr style="margin: 5px 0;"/>
                                                            <h5 class="text-bold-500 black mb-2"><?=$post['title']?></h5> 
                                                            <a href="<?=base_url()?>posts/view/<?=$post['slug']?>">
                                                                <div class="post_content">
                                                                    <?=$post['post']?>
                                                                </div>
                                                            </a>
                                                            <div class="mt-1">
                                                                <a href="<?=base_url()?>posts/view/<?=$post['slug']?>" class="blue-grey text-bold-700 hover-gray"><i class="ft-message-square fa-lg"></i>&nbsp;<?=$post["comments"]?>&nbsp;Comments</a>
                                                                <?php
                                                                    if ($user['id'] == $post['userid']){
                                                                        ?>
                                                                            <a class="blue-grey text-bold-700 hover-gray btn_delete" data-id="<?=$post['postid']?>"><i class="ft-trash fa-lg"></i>&nbsp;Remove</a> 
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                        
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="tab-pane pt-1" id="comments" aria-labelledby="comments-tab" role="tabpanel">
                                        <h3>Comments</h3>
                                        <hr/>          
                                        <div id="comments_con">

                                        </div>                                                           
                                    </div>
                                    <div class="tab-pane pt-1" id="settings" aria-labelledby="settings-tab" role="tabpanel">
                                        <h3>User Profile</h3>
                                        <hr/>
                                        <form method="post" id="frmUserInfo">
                                            <input type="hidden" name="id" value="<?=$user['id']?>">
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <label class="small">FIRST NAME</label>
                                                    <input type="text" name="fname" class="form-control static-label" value="<?=$user['fname']?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small">LAST NAME</label>
                                                    <input type="text" name="lname" class="form-control static-label" value="<?=$user['lname']?>">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="small">EMAIL</label>
                                                <input type="email" name="email" class="form-control static-label" value="<?=$user['email']?>">                                 
                                            </div>
                                            <div class="form-group">
                                                <textarea name="bio" class="form-control" row="10" placeholder="About you"><?=$user['bio']?></textarea>
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
</div>
<!-- END: Content-->

<script>
    $(function(){       
       
        $('body').on('click', '.btn_delete', function(e){
            e.preventDefault();
            let url = '<?=base_url()?>posts/delete';
            let data = {
               id: $(this).attr('data-id')
            }

           let $row = $(this).parent().parent().parent().parent().parent();

            swalPrompt("Are you sure you want to delete this post?", "Delete")
           .then((confirm) =>{
                if(confirm){
                   ajax(url, data).done(function(results){
                       if(results.message == "success"){
                            $row.remove();
                            swal("Success!", "You have successfully deleted a post.", "success");
                       }else{
                            swal("Oh Snap!", results.message, "error");
                       }
                   })
                }
           })
        })

        $('body').on('click', '#comments-tab', function(e){
            e.preventDefault();

            let url = '<?=base_url()?>comments/get_comments_by_userid';
           
            ajaxHtml(url, null).done(function(results){
                $('#comments_con').html(results);
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
                            }, 800);
                            
                        }else{
                            swal("Oh Snap!", results.message, "error");
                        }
                    })
                }
            })
        })


        $('#frmUserInfo').on('submit', function(e){
            e.preventDefault();

            let url = '<?=base_url()?>users/update_info';
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

<style>
wave > wave {
    border: none!important;
}
</style>
