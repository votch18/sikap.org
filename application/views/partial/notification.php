<?php
    foreach($data as $row) {
    $sender_photo = empty($row['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$row['photo'];
        
?>

<a href="<?=base_url()?>messages">
    <div class="media m-0 ml-1 p-0">
        <div class="media-left">
            <div class="avatar avatar-sm rounded-circle"><img
                    src="<?=base_url().$sender_photo?>" alt="avatar"><i></i></div>
        </div>
        <div class="media-body">
            <h6 class="media-heading"><?=$row['sender_name']?></h6>
            <p class="notification-text font-small-3 text-muted m-0"><?=$row['message']?></p>
            <small class="text-muted"><?=$this->util->get_chat_time($row['seconds'], $row['date'])?></small>
        </div>
    </div>
    <hr style="margin: 0;"/>
</a>

<?php
}
?>