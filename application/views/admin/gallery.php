<link href="<?=base_url()?>assets/admin/main/css/pages/user-card.css" id="theme" rel="stylesheet">
<link href="<?=base_url()?>assets/admin/main/css/magnific-popup.css" id="theme" rel="stylesheet">

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?=ucwords($title)?></h3>
    </div>
    <div class="col-md-7">
        <a href="<?=base_url()?>admin/<?=$action?>" class="btn btn-success float-right"><i class="fa fa-plus"></i>&nbsp;<?=ucwords('Create '.$url)?></a>
    </div>

</div>


<div class="card-columns el-element-overlay">
    <?php                  
        foreach($posts as $post){
            $photo = !empty($post['featured_img']) ? $post['featured_img'] : base_url().'assets/admin/images/noimage.png';
            
        ?>             
        <div class="card con_<?=$post['postid']?>">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <a class="image-popup-vertical-fit" href="<?=$photo?>"> <img src="<?=$photo?>" alt="<?=$post['title']?>"> </a>
                </div>
                <div class="el-card-content">
                    <h3 class="box-title"><?=$post['title']?></h3> <small><?=$post['description']?></small>
                    <br> 
                    </div>
                    <div class="text-center m-t-10">
                        <a href="<?=base_url()?>admin/<?=$url?>/edit/<?=$post['postid']?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                        <a href="" class="btn btn-danger btn_remove btn-sm" data-id="<?=$post['postid']?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                    </div>
            </div>
        </div>    
    <?php
        }
    ?>
</div>

<script src="<?=base_url()?>assets/admin/main/js/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url()?>assets/admin/main/js/jquery.magnific-popup-init.js"></script>