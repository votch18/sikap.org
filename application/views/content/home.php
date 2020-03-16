<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 60px auto 0;">
    <div class="content-wrapper pt-0">
        <div class="content-header row">
        </div>
        <div class="content-body">           
            <!--Content -->
            <div class="row mt-2 text-center">
                <div class="col-12">
                    <h1 class="text-bold-500">Welcome to uTalking2.me</h1>
                    <h3>Where real discussions happen. Voice comments only.</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-8">
                    <?php
                    if (isset($user["username"])) {
                    ?>
                    <div class="card rounded m-0" style="margin-bottom: 10px!important;">                      
                        <div class="card-content">
                            <div class="card-body p-0" style="padding: 10px!important; vertical-align: middle;">
                                <form method="post" id="frmPost">
                                    <input type="text" class="form-control d-inline-block" name="title" style="width: 100%;" placeholder="Create Post">
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    }

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
                                        <a href="<?=base_url()?>posts/view/<?=$post['slug']?>">
                                            <h5 class="text-bold-500 black mb-2"><?=$post['title']?></h5> 
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
                </div>
                <div class="col-lg-4">
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
                            <a href="" class="btn bg-blue white text-bold-700 d-block m-1">VIEW ALL</a>
                                           
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

<script>
    $(function(){      
        let user = '<?=$user["username"]?>';

        $('body').on('click focus', 'input[name="title"]', function(e){
            e.preventDefault();
            window.location.href = '<?=base_url()?>posts/submit/';
        })

        let checkUser = () => {
            if (user.trim().length <= 0){
                swal({
                    title: 'Oh snap!',
                    text: 'You need to log in to upvote or downvote.',
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

        

    })
</script>