<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?=ucwords($title)?></h3>
    </div>
    <div class="col-md-7">
        <?php
            if (isset($create) && $create == true) {
                ?>
                <a href="<?=base_url()?>admin/<?=$action?>" class="btn btn-success float-right"><i class="fa fa-plus"></i>&nbsp;<?=ucwords('Create '.$url)?></a>
            <?php
            }
        ?>

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
                    $photo = !empty($post['featured_img']) ? $post['featured_img'] : base_url().'assets/admin/images/noimage.png';
                   
                ?>

                <tr class="con_<?=$post['postid']?>"> 
                               
                        <td>
                            <div class="activity-box">
                                <div class="activity-item m-0">
                                    <div class="m-r-10"><img src="<?=$photo?>" alt="<?=$post['title']?>" width="100"></div>
                                    <div>
                                        <h5 class="m-b-5 font-medium"><?=$post['title']?> <span class="badge <?=$post['status'] == 0 ? 'badge-secondary' : 'badge-success'?>"><?=$post['status'] == '0' ? 'draft' : 'published'?></span></h5>
                                        <h6 class="text-muted"><?=$post['name']?>  <span class="text-muted font-14 m-l-10">| <?=$this->util->get_chat_time($post['seconds'], $post['date'])?></span></h6>
                                        <p class="m-b-0"><?=$post['description']?></p>
                                    </div>
                                </div>    
                            </div>
                           
                        </td>
                        <td class="text-right" style="width: 250px;">
                            <?php
                            if (isset($publish) && $publish == true) {
                                ?>
                                <div class="m-b-15 d-inline-block">
                                    <h6 class="d-inline small">Publish?</h6>
                                    <label class="switch m-0 p-0" style="vertical-align: middle;">
                                        <input
                                            id="publish"
                                            type="checkbox" <?= !empty($post['status']) && $post['status'] == 1 ? "checked" : "" ?>
                                            data-id="<?= $post['postid'] ?>">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <span class="btn btn-info btn-sm btn_post" 
                                data-toggle="tooltip" title="Post to Facebook" 
                                data-url="<?=base_url().$url?>/<?=$post["slug"]?>"
                                data-picture="<?=$photo?>"><i class="fab fa-facebook-f"></i></span>

                                <?php
                            }
                            ?>
                            <?php
                            if (isset($create) && $create == true) {
                            ?>
                            <a href="<?=base_url()?>admin/<?=$url?>/edit/<?=$post['postid']?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                <?php
                            }
                            ?>
                            <?php
                            if (isset($delete) && $delete == true) {
                            ?>
                            <a href="" class="btn btn-danger btn_remove btn-sm" data-id="<?=$post['postid']?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                <?php
                            }
                            ?>
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


<script>
    $(function(){
        //publish
        $('#publish').click(function(e){
            e.preventDefault();
            
            let title = ($(this).prop("checked") ? 'Publish' : 'Unpublish' ) ;   
            
            let data = { 
                postid: $(this).attr('data-id'),            
                status: ($(this).prop("checked") ? 1 : 0 )             
            };

            Swal.fire({
                title: title + '?',
                text: 'Are you sure?',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: title,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '<?=base_url()?>posts/publish',
                        data: data,
                        dataType: 'json',
                        crossDomain: true,
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        error: function(res){
                            console.log('error')
                            console.log(res)
                        },
                        beforeSend: function(){
                            $('.status').html('Saving changes...')
                        },
                        success: function(res){
                            
                            if(res.message == 'success'){
                                
                                Swal.fire("Success!", title + "ed successfully!", "success");
            
                                setTimeout(function(){                           
                                    $('.status').html('')
                                }, 1500)
                            }
                            else{
                                $('.status').switchClass('text-success', 'text-danger').html('[error]')
                            }
                        }
                    })

                    if($(this).prop("checked") == true){
                        $(this).prop("checked", false);
                    }else{
                        $(this).prop("checked", true);
                    }
                    
                } 
            })
        })



       $('.btn_post').on('click', function(e){
           e.preventDefault();

           var url = $(this).data('url');
           var picture = $(this).data('picture');
            Swal.fire({
                title: 'Share to Facebook?',
                text: 'Are you sure?',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, post to facebook!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {

                    FB.getLoginStatus(function(response) {
                        if (response.status === 'connected') {
                            accessToken = response.authResponse.accessToken;

                            FB.api(
                                '/me',
                                {
                                    fields: 'id,email,first_name,last_name,middle_name',
                                    access_token: accessToken,
                                },
                                function(data) {

                                    FB.ui({
                                        method: 'feed',
                                        link: url,
                                        picture: picture
                                    }, function(response){});

                                    /*
                                    FB.api('/' + data.id +'/feed', 'post', { message: 'Facebook post tests!', access_token:response.authResponse.accessToken }, function(response) {
                                        if (!response || response.error) {
                                            console.log(response.error);
                                        } else {
                                            //alert('Post ID: ' + response.id);
                                            $.post('<?=base_url()?>admin/fbpost', { postid: postid, fbpostid: response.id}).done(function(res){
                                        if (res.action == "success"){
                                            swal.fire("Error!", "An error occured while posting to facebook!", "error");
                                        }else{
                                            swal.fire("Error!", "An error occured while posting to facebook!", "error");
                                        }
                                    })
                                }
                            });
                            */

                                }
                            )



                        }
                        else {
                            swal.fire("Error!", "Please connect with facebook to post!", "error");
                        }
                    });

                }
            })

        });

    })




</script>