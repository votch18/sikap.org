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
                    </div>
                </div>
            </div>
        </div>
    </div>                        
<?php
    }
?>