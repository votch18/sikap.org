<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Pages</h3>
    </div>
    <div class="col-md-7">
        <?php

        if (isset($create) && $create == true){
            ?>
            <a href="<?=base_url()?>admin/pages/create" class="btn btn-success float-right"><i class="fa fa-plus"></i>&nbsp;Add new page</a>
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
                        <th>Name</th>
                        <th>Url</th>
                        <th>Template</th>
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
                            <?=$row['banner']?>
                        </td>
                        <td style="width: 160px;">
                            <?php

                            if (isset($create) && $create == true) {
                                ?>
                                <a href="<?= base_url() ?>admin/pages/edit/<?= $row['id'] ?>"
                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                <?php

                            }
                            ?>
                            <?php
                                if ($row['isdefault'] != "1"){
                                    if (isset($delete) && $delete == true) {
                                        ?>
                                        <a href="" class="btn btn-danger btn_remove_page btn-sm" data-id="<?= $row['id'] ?>"><i
                                                class="fa fa-trash"></i>&nbsp;Delete</a>
                                        <?php
                                    }
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
        $('body').on('click', '.btn_remove_page', function(e){
            e.preventDefault();

                let url = '<?=base_url()?>admin/pages/delete';
                let id = $(this).attr('data-id');
                let data = {
                    id: id
                }

            let $row = $(this).parent().parent();

            Swal.fire({
                title: 'Delete?',
                text: 'Are you sure you want to delete this page?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        dataType: 'json',
                        crossDomain: true,
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        error: function(res){
                            console.log('error')
                            console.log(res)
                        },
                        beforeSend: function(){
                            $('.status').html('Deleting page...')
                        },
                        success: function(res){
                            
                            if(res.message == 'success'){
                            
                                Swal.fire("Success!", "Deleted successfully!", "success");
                                $row.remove();
                                setTimeout(function(){                           
                                    $('.status').html('')
                                }, 1500)
                            }
                            else{
                                $('.status').switchClass('text-success', 'text-danger').html('[error]')
                            }
                        }
                    })

                } 
            })
        })
    })
</script>