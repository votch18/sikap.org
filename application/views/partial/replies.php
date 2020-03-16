<?php
    foreach($data as $reply) {
?>
<div class="audio-comment p-lg-1" style="border-radius: 5px; background: #f5f5f5;">    
    <span class="avatar avatar-online d-inline-block" style="vertical-align: middle!important;">
        <?php
            $photo = empty($reply['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$reply['photo'];
        ?>
        <img src="<?=base_url().$photo?>" alt="avatar">
    </span>
    <span class="blue-grey"><strong><?=$reply["username"]?></strong> on <?=$this->util->get_chat_time($reply["seconds"], $reply["date"])?></span>
    <hr style="margin: 5px 0;"/>
    <div id="waveform_reply_<?=$reply["id"]?>"></div>
    
    <script>                                                
        var wavesurfer = WaveSurfer.create({
            container: '#waveform_reply_<?=$reply["id"]?>',
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
        
        wavesurfer.load('<?=base_url()?>uploads/audio/<?=$reply["filename"]?>');
    </script>
    <div class="mt-1">       
        <?php
            if ($user['id'] == $reply['userid']){
                ?>
                    <a class="blue-grey text-bold-700 hover-gray btn_remove_reply" data-id="<?=$reply['id']?>" data-file="<?=$reply["filename"]?>"><i class="ft-trash fa-lg"></i>&nbsp;Remove</a> 
                <?php
            }
        ?>
    </div>  
</div>
<?php
}
?>
