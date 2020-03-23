<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<div class="page-header" style="background: url('<?=$banner?>')">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?=ucwords($url)?></h1>
            </div>
        </div>
    </div>
</div>

    <div class="portfolio-wrap">
        <div class="container">
            <div class="row portfolio-container">
                <?php
foreach($posts as $row) {
                ?>
                <a href="<?=$row['featured_img']?>" data-toggle="lightbox" data-gallery="example-gallery" >
                    <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                        <div class="portfolio-cont">
                            <img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>" class="img-fluid">

                            <h3 class="entry-title"><a href="#"><?=$row['title']?></a></h3>
                            <h4><?=$row['description']?></h4>
                        </div>
                    </div>
                    </a>
                <?php
}
?>
            
            </div>

        </div>
    </div>

<style>

    .ekko-lightbox-nav-overlay {
        position: absolute;
        top: 50%;
        vertical-align: middle;
        width: 100%;
    }

    .ekko-lightbox-nav-overlay > a:nth-child(2) {
        float: right;
        margin-right: 30px;
    }
</style>
    
    <script>
        jQuery(function($) {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        });

    </script>