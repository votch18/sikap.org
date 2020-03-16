<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?=ucwords($title)?></h3>
    </div>
    <div class="col-md-7">
        <a href="<?=base_url()?>admin/#/<?=$action?>" class="btn btn-success float-right"><i class="fa fa-plus"></i><?=ucwords(str_replace('/', ' ', $action))?></a>
    </div>

</div>
   
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                       
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
          
                <?php                  
                foreach($posts as $post){
                    $photo = !empty($post['featured_img']) ? base_url().'filemanager/'.$post['featured_img'] : base_url().'assets/admin/images/noimage.png';
                   
                ?>

                <tr> 
                               
                        <td>
                            <div class="activity-box">
                                <div class="activity-item">
                                    <div class="m-r-10"><img src="<?=$photo?>" alt="<?=$post['title']?>" width="100"></div>
                                    <div>
                                        <h5 class="m-b-5 font-medium"><?=$post['title']?> <span class="badge <?=$post['status'] == '0' ? 'badge-secondary' : 'badge-success'?>"><?=$post['status'] == '0' ? 'draft' : 'published'?></span></h5>
                                        <h6 class="text-muted"><?=$post['name']?>  <span class="text-muted font-14 m-l-10">| <?=$this->util->get_chat_time($post['seconds'], $post['date'])?></span></h6>
                                        <p class="m-b-0"><?=$post['description']?></p>
                                    </div>
                                </div>    
                            </div>
                           
                        </td>
                        <td class="text-right">
                            <a href="<?=base_url()?>admin/#/news/edit/<?=$post['postid']?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                        </td>
                    </tr>
                  
                <?php
                }
                ?>
                  </table>
            </div>
        </div>
    </div>
</div>