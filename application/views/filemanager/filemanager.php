<div class="col-md-12 row">
    <div class="page-titles p-l-10">
        <h3 class="text-themecolor">Filemanager</h3>
        <sub>Manage your photos and files.</sub>
    </div>
    <div class="col-12">
        <?php
        if (isset($view) && $view == true){
            ?>
            <iframe src="<?php echo base_url()?>filemanager/iframe" style="width: 100%; height: 800px!important; border:none;background: transparent;"></iframe>
            <?php
        }else{
            ?>
            <div class="alert alert-danger">
                <h3>Access denied!</h3>
                <p>It seems that your are not allowed to access this page. Please contact system administrator.</p>
            </div>
            <?php
        }
        ?>
    </div>

</div>