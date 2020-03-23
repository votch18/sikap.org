<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Settings</h3>
    </div>
    <div class="col-md-7 align-self-center">
        
    </div>   
</div>

<div class="row m-b-5">    
    <div class="col-md-12">
        <div class="alert alert-info small">Don't forget to click save changes button everytime you made changes.</div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Key</th>
                            <th>Value</th>
                         
                        </tr>
                    </thead>
              
                <tbody>
                  
                    <?php
                        foreach($data as $row){
                            ?> 
                            <form method="POST">
                                <tr>
                                    <td><?=$row['description']?></td>
                                    <td><?=$row['key_word']?></td>
                                    <td>
                                        <input type="hidden" name="keyword" value="<?=$row['key_word']?>" class="form-control">
                                        <textarea name="value" class="form-control"><?=$row['value']?></textarea>
                                    </td>
                                    <td style="width: 100px;">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                                    </td>
                                </tr>
                            </form>
                            <?php
                        }
                    ?>
                  
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(function(){

        $('body').on('click', '.btn_save', function(e){
            $("form").submit();
        })


        $("form").submit(function(e){
            e.preventDefault();

            let data = $(this).serialize();

            console.log(data);

            $.ajax({
                type: 'POST',
                url: '<?=base_url()?>admin/save_settings',
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
                        setTimeout(function(){                           
                            $('.status').html('')
                            Swal.fire("Success!", "Changes successfully saved!", "success");
                        }, 1500)
                    }
                    else{
                        $('.status').switchClass('text-success', 'text-danger').html('[error]')
                    }
                }
            })
        })
    })
</script>
