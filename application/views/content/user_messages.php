<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/pages/app-chat.min.css">
<div class="app-content content" style="height: calc(100% - 32px); width: 100%; overflow-x: none;">
    <div class="sidebar-left">
        <div class="sidebar">          
            <!-- app chat sidebar start -->
            <div class="chat-sidebar card">
                <span class="chat-sidebar-close">
                    <i class="feather icon-x"></i>
                </span>
                <div class="chat-sidebar-search" style="z-index: 1; background: #fff; border: none!important;">
                    <div class="d-flex align-items-center">                       
                        <fieldset class="form-group position-relative mx-75 mb-0 ml-1">
                            <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                           
                        </fieldset>
                    </div>
                </div>
                <div class="chat-sidebar-list-wrapper pt-2" style="overflow-y: scroll;">
                   
                    <h6 class="px-2 pb-25 mb-0">MESSAGES</h6>
                    <ul class="chat-sidebar-list">
                        <?php

                        foreach($thread as $row){
                            $avatar = empty($row['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$row['photo'].'?';
                        ?>
                            <li data-id="<?=$row["threadid"]?>" data-name="<?=ucwords($row["fname"].' '.$row["lname"])?>" data-avatar="<?=base_url().$avatar?>"> 
                                <div class="d-flex align-items-center">
                                    <div class="avatar m-0 mr-50"><img
                                            src="<?=base_url().$avatar?>" height="36"
                                            width="36" alt="sidebar user image">
                                        <i></i>
                                    </div>
                                    <div class="chat-sidebar-name pl-1">
                                        <h6 class="mb-0"><?=ucwords($row["fname"].' '.$row["lname"])?></h6><span class="text-muted"><?=$row["message"]?></span>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                        ?>                        
                    </ul>
                  
                </div>
            </div>
            <!-- app chat sidebar ends -->
        </div>
    </div>
    <div class="content-right">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app chat overlay -->
                
                <!-- app chat window start -->
                <section class="chat-window-wrapper">
                    <div class="chat-start">
                        <span
                            class="ft-message-square chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                        <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
                        <button
                            class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
                            Conversation!</button>
                    </div>
                    <div class="chat-area d-none">
                        <div class="chat-header">
                            <header class="d-flex justify-content-between align-items-center" style="padding: 10px;">
                                <div class="d-flex align-items-center">
                                    <div class="chat-sidebar-toggle d-block d-lg-none mr-1">
                                        <i class="ft-menu font-large-1 cursor-pointer"></i>
                                    </div>
                                    <div class="avatar chat-profile-toggle m-0 mr-1">
                                        <img id="receiver_avatar" src="<?=base_url()?>assets/images/portrait/small/avatar-s-11.png"
                                            alt="avatar" height="36" width="36">
                                        <i></i>
                                    </div>
                                    <h6 class="mb-0" id="receiver_name"></h6>
                                </div>                                
                            </header>
                        </div>
                        <!-- chat card start -->
                        <div class="card chat-wrapper shadow-none mb-0">
                            <div class="card-content">
                                <div class="card-body chat-container" style="overflow-y: scroll;">
                                    <div class="chat-content" id="chat_content">
                                        <!-- load through ajax -->
                                    </div>                                   
                                </div>
                            </div>
                            <div class="card-footer chat-footer px-2 py-1 pb-0">
                                <form class="d-flex align-items-center" id="sendMessage">
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
                <!-- app chat window ends -->
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>assets/js/pages/app-chat.min.js"></script>

<script>
    $(function(){

        let sender = '<?=$user["id"]?>';
        let receiver = '';
        let count = 0;

        
        $('body').on('click', '.chat-sidebar-list > li', function(e){
            e.preventDefault();
            receiver = $(this).attr('data-id');
            $('#receiver_name').text($(this).attr('data-name'));
            $('#receiver_avatar').attr('src', $(this).attr('data-avatar'));

            reloadChat()
        })

        $('#sendMessage').on('submit', function(e){
                e.preventDefault();

                chatMessagesSend();
            })
                        
            function chatMessagesSend() {
                let chatMessageSend = $('input[name="message"]');
                let msg = chatMessageSend.val();
               
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

            if (receiver.trim().length != 0){
                    setTimeout(function () {
                    reloadChat()
                }, 1000)
            }
    })
</script>