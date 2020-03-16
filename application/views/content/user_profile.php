<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/pages/app-chat.min.css">
<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 0 auto 0;">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">          
            <!--Content -->
           
            <div class="row">
                <div class="col-lg-4">                   
                    <div class="card profile-card-with-cover rounded">
                        <div class="card-content">
                            <div class="card-img-top img-fluid bg-cover height-100 bg-blue" style="border-radius: 5px 5px 0 0;"></div>
                            <div class="card-profile-image" style="margin-top: -50px; text-align: center;">
                                <?php
                                    $photo = empty($viewed_user['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$viewed_user['photo'].'?'.strtotime("now");
                                ?>
                                <a href="" class="btn_upload">
                                    <img src="<?=base_url().$photo?>" class="rounded-circle img-border box-shadow-1" alt="Card image" style="height: 100px; width: 100px;">
                                </a>
                            </div>
                            <div class="profile-card-with-cover-content text-center">
                                <div class="profile-details mt-2">
                                    <h4 class="card-title"><?=ucwords($viewed_user['fname'].' '.$viewed_user['lname'])?></h4>
                                    <ul class="list-inline clearfix mt-2">
                                        <li class="mr-3"><h2 class="block"><?=count($posts)?></h2> Posts</li>
                                        <li class="mr-3"><h2 class="block"><?=count($comments)?></h2> Comments</li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    
                                    <a href="#" class="btn bg-blue btn-block white btn_message" ><i class="ft-message-square"></i>&nbsp;<span>Send Message</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card rounded">
                        <div class="card-body">

                        <h3>Latest Posts</h3>
                                <hr/>
                                <?php
                                foreach($related_posts as $post){
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
                                                    <a href="<?=base_url()?>posts/view/<?=$post['slug']?>">
                                                        <span class="blue-grey">Posted by <a href="<?=base_url()?>users/profile/<?=$post['username']?>"><?=$post['username']?></a> on <?=$this->util->get_chat_time($post["seconds"], $post["date"])?></span>
                                                        <hr style="margin: 5px 0;"/>
                                                        <h5 class="text-bold-500 black mb-2"><?=$post['title']?></h5>                                            
                                                    </>
                                                    <div class="post_content">
                                                        <?=$post['post']?>
                                                    </div>
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
                    </div>               
                </div>
               
            </div>        
        </div>
    </div>
</div>
<!-- END: Content-->


    <!-- Signup Modal -->
    <div class="modal fade text-left" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <div class="chat-overlay"></div>
                <section class="chat-window-wrapper">                    
                    <div class="chat-area">
                        <div class="chat-header">
                            <header class="d-flex justify-content-between align-items-center" style="padding: 10px;">
                                <div class="d-flex align-items-center">                                   
                                    <div class="avatar chat-profile-toggle m-0 mr-1">
                                        <img src="<?=base_url().$photo?>"
                                            alt="avatar" height="36" width="36">
                                        <i></i>
                                    </div>
                                    <h6 class="mb-0"><?=ucwords($viewed_user['fname'].' '.$viewed_user['lname'])?></h6>                                    
                                </div>
                                <div class="chat-header-icons">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>                                   
                                </div>
                            </header>
                        </div>
                        <!-- chat card start -->
                        <div class="card chat-wrapper shadow-none mb-0">
                            <div class="card-content">
                                <div class="card-body chat-container">
                                    <div class="chat-content" id="chat_content">
                                        <!--load through ajax-->
                                    </div>                                     
                                </div>
                            </div>
                            <div class="card-footer chat-footer px-2 py-1 pb-0">
                                <form class="d-flex align-items-center" id="sendMessage">
                                    <input type="hidden" name="sender" value="<?=$user['id']?>">
                                    <input type="hidden" name="receiver" value="<?=$viewed_user['id']?>">
                                    <input type="text" name="message" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
                                    <button type="submit" class="btn btn-primary glow send d-lg-flex"><i
                                            class="ft-play"></i>
                                        <span class="d-none d-lg-block mx-50">Send</span></button>
                                </form>
                            </div>
                        </div>
                        <!-- chat card ends -->
                    </div>
                    </section>
                </div>

            </div>
        </div>
    </div>

    <script src="<?=base_url()?>assets/js/pages/app-chat.min.js"></script>
    <script>
        $(function(){            
            var count = 0;

            $('.card-body.chat-container').removeClass('ps');
            $('.card-body.chat-container').css({
                "overflow-y": "scroll",
            });

            
            let chatContainer = $(".chat-container");

            $('body').on('click', '.btn_message', function(e){
                e.preventDefault();

                let user = '<?=empty($user['id']) ? '' : $user['id']?>';

                if(user.trim().length == 0){
                    swal({
                        title: 'Oh snap!',
                        text: 'You need to log in to send a message.',
                        icon: 'error',
                        showCancelButton: false,
                        closeOnConfirm: false,
                        allowOutsideClick: false,
                        }).then(()=> {
                            $('#loginModal').modal('show');
                        }); 
                    return;
                }

                $('#messageModal').modal('show');
                
                loadConversation();

            })

            $('#sendMessage').on('submit', function(e){
                e.preventDefault();

                chatMessagesSend();
            })
                        
            function chatMessagesSend() {
                let chatMessageSend = $('input[name="message"]');
                let msg = chatMessageSend.val();
                let sender = $('input[name="sender"]').val()
                let receiver =  $('input[name="receiver"]').val();

                if ("" != msg) {                    
                    let url = '<?=base_url()?>messages/send_message';
                    let data = {
                        sender: sender,
                        receiver: receiver,
                        message: msg
                    }

                    ajax(url, data).done(function(results){
                        if (results.message == "success"){                            
                            loadConversation();
                            $('input[name="message"]').val('');
                        }
                    })
                }
            }

            function loadConversation(){
                let url = '<?=base_url()?>messages/get_conversation';
                let sender = $('input[name="sender"]').val();
                let receiver =  $('input[name="receiver"]').val();

                let data = {
                    sender: sender,
                    receiver: receiver
                }

                ajaxHtml(url, data).done(function(results){
                    $('#chat_content').html(results);

                    setTimeout(function(){
                        chatContainer.animate({
                                    scrollTop: chatContainer[0].scrollHeight
                                }, 1000);
                    }, 200)
                })
            }

            //get notifications every second
            function reloadChat() {
                let sender = $('input[name="sender"]').val();
                let receiver =  $('input[name="receiver"]').val();

                let data = {
                    sender: sender,
                    receiver: receiver
                }

                ajax('<?=base_url()?>messages/get_message_count', data).done(function (results) {
                    console.log(results.count);
                    var res = results.count;

                    //if unread notification is present
                    if (res != null || res != 0) {
                        //check if unread notification
                        //if not yet displayed then display
                        //update counter value
                        if (count != res) {
                            loadConversation();
                            
                            count = res;
                        }
                    } 
                    setTimeout(function () {
                        reloadChat()
                    }, 1000)
                    
                })
            }

            setTimeout(function () {
                reloadChat()
            }, 1000)


    })
    </script>