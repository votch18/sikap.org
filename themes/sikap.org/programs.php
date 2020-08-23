<div class="page-header" style="background: url('<?=$banner?>')">
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
            <div class="col-12">
                <div style="width: 100%; background: #EDF1F1; font-size: 16px!important; font-weight: bold; padding: 10px; margin-top: 20px;">
                    <ul class="list-inline programs">
                        <li class="list-inline-item wcf <?=$category == "women-children-and-family-development" ? "active" : ""?>">
                            <a href="/programs/?category=women-children-and-family-development">Women, Children & Family Development</a>
                        </li>
                        <li class="list-inline-item ip <?=$category == "indigenous-peoples-development" ? "active" : ""?>">
                            <a href="/programs/?category=indigenous-peoples-development">Indigenous Peoples Development</a>
                        </li>
                        <li class="list-inline-item glg <?=$category == "good-local-governance" ? "active" : ""?>">
                            <a href="/programs/?category=good-local-governance">Good Local Governance</a>
                        </li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item rled <?=$category == "rural-livelihood-and-enterprise-development" ? "active" : ""?>">
                            <a href="/programs/?category=rural-livelihood-and-enterprise-development">Rural Livelihood & Enterprise Development</a>
                        </li>
                        <li class="list-inline-item drr <?=$category == "disaster-risk-reduction-climate-change-adaptation" ? "active" : ""?>">
                            <a href="/programs/?category=disaster-risk-reduction-climate-change-adaptation">Disaster Risk Reduction/Climate Change Adaptation</a>
                        </li>
                    </ul>
                </div>
            </div>

        <?php

        if (empty($posts)){
            ?>
            <div class="col-12 mt-5">
                <div class="alert alert-danger">
                    <h3><i class="fa fa-exclamation-circle red"></i> No records found!</h3>
                </div>
            </div>
            <?php
        }
		foreach($posts as $row) {
        ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="cause-wrap">
                    <figure class="m-0">
                        <img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>">
                    </figure>

                    <div class="cause-content-wrap">
                        <header class="entry-header d-flex flex-wrap align-items-center">
                            <h3 class="entry-title w-100 m-0"><a href="<?=base_url().'programs/'.$row['slug']?>"><?=$row['title']?></a></h3>
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