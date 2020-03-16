<?php
    $prev_sender = '';
    $message = '';
    $count = 0;
    $limit = count($data) - 1;
    for($x = 0; $x <= $limit; $x++) {
        $count++;
        if ($limit == $x) $prev_sender = '';
        
        $row = $data[$x];
        $sender_photo = empty($row['sender_photo']) ?  'assets/images/user.png' : 'uploads/users/'.$row['sender_photo'];
        
        $avatar = '<div class="chat-avatar">
                        <a class="avatar m-0">
                            <img src="'.base_url().$sender_photo.'" alt="avatar" height="36" width="36">
                        </a>
                    </div>';
        
        $is_left = $row['sender'] == $user['id'] ? '' : 'chat-left';

        $message .= '<div class="chat-message">
                        <p>'.$row['message'].'</p>
                        <span class="chat-time">'.$this->util->get_chat_time($row['seconds'], $row['date']).'</span>
                    </div>';
        

        if ($row['sender'] != $prev_sender){
?>
        <div class="chat <?=$is_left?>">
            <?=$avatar?>
            <div class="chat-body">
            <?=$message?>
            </div>
        </div>

            <?php
                $message = '';
            }
        $prev_sender = $row['sender'];
    }
?>