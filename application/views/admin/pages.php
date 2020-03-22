<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Pages</h3>
    </div>
    <div class="col-md-7">
        <a href="<?=base_url()?>admin/pages/create" class="btn btn-success float-right"><i class="fa fa-plus"></i>&nbsp;Add new page</a>
    </div>

</div>
   
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
           
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Template</th>
                        <th>Sequence</th>
                        <th>Banner Image</th>
                        <th></th>
                    </tr>
                </thead>
          
                <?php                  
                foreach($pages as $row){
                   
                ?>
                    <tr> 
                        <td>
                            <?=ucwords($row['name'])?>
                        </td>
                        <td>
                            <?=$row['url']?>
                        </td>
                        <td>
                            <?=$row['template']?>
                        </td>
                      
                        <td>
                            <?=$row['sequence']?>
                        </td>
                        <td>
                            <?=$row['banner']?>
                        </td>
                        <td>
                        <a href="<?=base_url()?>admin/pages/edit/<?=$row['id']?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                            <?php
                                if ($row['isdefault'] != "1"){
                                    ?>
                                       
                                        <a href="" class="btn btn-danger btn_remove btn-sm" data-id="<?=$row['id']?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
        $('input[type=checkbox]').click(function(e){
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

    })
</script>