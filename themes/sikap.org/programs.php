<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?=ucwords($url)?></h1>
            </div>
        </div>
    </div>
</div>


<div class="our-causes pt-0">
    <div class="container">
        <div class="row">

        <?php
		foreach($posts as $row) {
        ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="cause-wrap">
                    <figure class="m-0">
                        <img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>">
                    </figure>

                    <div class="cause-content-wrap">
                        <header class="entry-header d-flex flex-wrap align-items-center">
                            <h3 class="entry-title w-100 m-0"><a href="<?=base_url().'news/'.$row['slug']?>"><?=$row['title']?></a></h3>
                        </header>

                        <div class="entry-content">
                            <p class="m-0"><?=substr(strip_tags($row['post']), 0, 250)?></p>
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