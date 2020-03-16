<?php
    foreach($data as $comment) {
?>
<div class="audio-comment p-lg-1" style="border-radius: 5px; background: #f5f5f5;">    
    <span class="avatar avatar-online d-inline-block" style="vertical-align: middle!important;">
        <?php
            $photo = empty($comment['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$comment['photo'];
        ?>
        <img src="<?=base_url().$photo?>" alt="avatar">
    </span>
    <span class="blue-grey"><strong><?=$comment["username"]?></strong> on <?=$this->util->get_chat_time($comment["seconds"], $comment["date"])?></span>
    <hr style="margin: 5px 0;"/>
    <h5 class="text-bold-500 black mb-2"><?=$comment['title']?></h5> 
    <div id="waveform_comment_<?=$comment["id"]?>"></div>
    
    <script>                                                
        var wavesurfer = WaveSurfer.create({
            container: '#waveform_comment_<?=$comment["id"]?>',
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
    <div class="mt-1">       
        <?php
            if ($user['id'] == $comment['userid']){
                ?>
                    <a class="blue-grey text-bold-700 hover-gray btn_remove_comment" data-id="<?=$comment['id']?>" data-file="<?=$comment["filename"]?>"><i class="ft-trash fa-lg"></i>&nbsp;Remove</a> 
                <?php
            }
        ?>
    </div>  
</div>
<?php
}
?>
