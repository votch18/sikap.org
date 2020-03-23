<div class="page-header" style="background: url('<?=$banner?>')">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=ucwords($url)?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="news-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">

                <?php
					$row = $posts;
                ?>
                    <div class="news-content">
                        <a href="#"><img src="<?=$row['featured_img']?>" alt=""></a>

                        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="header-elements">
                                <div class="posted-date"><?= date_format(new DateTime($row['date']), 'F d, Y'); ?></div>

                                <h2 class="entry-title"><a href="<?=base_url().'news/'.$row['slug']?>"><?=$row['title']?></a></h2>

                                <div class="post-metas d-flex flex-wrap align-items-center">                                
                                    <span class="post-author">by <a href="#"><?=$row['name']?></a></span>
                                </div>
                            </div>

                        </header>

                        <div class="entry-content">
                           <?=$row['post']?>
                        </div>
                       
                    </div>
                  
                </div>

                <div class="col-12 col-lg-4">
                    <div class="sidebar">
                        <div class="search-widget">
                            <form class="flex flex-wrap align-items-center">
                                <input type="search" placeholder="Search...">
                                <button type="submit" class="flex justify-content-center align-items-center">GO</button>
                            </form>
                        </div>

                        <?php
                        if (count($news) > 0 ) {
                        ?>
                        <div class="popular-posts">
                            <h2>Announcements</h2>

                            <ul class="p-0 m-0">

                            <?php
                            foreach($news as $row) {
                                if (!$row['slug'] == $slug) {
                            ?>
                                <li class="d-flex flex-wrap justify-content-between align-items-center">
                                    <figure><a href="#"><img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>" style="width: 72px; height: auto;"></a></figure>

                                    <div class="entry-content">
                                        <h3 class="entry-title"><a href="<?=base_url().'annoucements/'.$row['slug']?>"><?=$row['title']?></a></h3>

                                        <div class="posted-date"><?= date_format(new DateTime($row['date']), 'F d, Y'); ?></div>
                                    </div>
                                </li>
                                <?php
                                }
                            }
                            ?>
                               
                            </ul>
                        </div>

                        <?php
                            }
                        ?>


                        <?php
                        if (count($announcements) > 0 ) {
                        ?>
                        <div class="popular-posts">
                            <h2>Announcements</h2>

                            <ul class="p-0 m-0">

                            <?php
                            foreach($announcements as $row) {
                                if (!$row['slug'] == $slug) {
                            ?>
                                <li class="d-flex flex-wrap justify-content-between align-items-center">
                                    <figure><a href="#"><img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>" style="width: 72px; height: auto;"></a></figure>

                                    <div class="entry-content">
                                        <h3 class="entry-title"><a href="<?=base_url().'annoucements/'.$row['slug']?>"><?=$row['title']?></a></h3>

                                        <div class="posted-date"><?= date_format(new DateTime($row['date']), 'F d, Y'); ?></div>
                                    </div>
                                </li>
                                <?php
                                }
                            }
                            ?>
                               
                            </ul>
                        </div>

                        <?php
                            }
                        ?>

                        <?php
                        if (count($publications) > 0) {
                        ?>
                        <div class="popular-posts">
                            <h2>Publications</h2>

                            <ul class="p-0 m-0">

                            <?php
                            foreach($publications as $row) {
                                
                            if (!$row['slug'] == $slug) {
                            ?>
                                <li class="d-flex flex-wrap justify-content-between align-items-center">
                                    <figure><a href="#"><img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>" style="width: 72px; height: auto;"></a></figure>

                                    <div class="entry-content">
                                        <h3 class="entry-title"><a href="<?=base_url().'publications/'.$row['slug']?>"><?=$row['title']?></a></h3>

                                        <div class="posted-date"><?= date_format(new DateTime($row['date']), 'F d, Y'); ?></div>
                                    </div>
                                </li>
                                <?php
                                }
                            }
                            ?>
                               
                            </ul>
                        </div>

                        <?php
                            }
                        ?>

<?php
                        if (count($awards) > 0) {
                        ?>
                        <div class="popular-posts">
                            <h2>Awards</h2>

                            <ul class="p-0 m-0">

                            <?php
                            foreach($awards as $row) {
                                if (!$row['slug'] == $slug) {
                            ?>
                                <li class="d-flex flex-wrap justify-content-between align-items-center">
                                    <figure><a href="#"><img src="<?=$row['featured_img']?>" alt="<?=$row['title']?>" style="width: 72px; height: auto;"></a></figure>

                                    <div class="entry-content">
                                        <h3 class="entry-title"><a href="<?=base_url().'awards/'.$row['slug']?>"><?=$row['title']?></a></h3>

                                        <div class="posted-date"><?= date_format(new DateTime($row['date']), 'F d, Y'); ?></div>
                                    </div>
                                </li>
                                <?php
                                }
                            }
                            ?>
                               
                            </ul>
                        </div>

                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
