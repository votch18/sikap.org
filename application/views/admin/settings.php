<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Settings</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <a href="#" class="btn btn-success float-right btn_save">Save changes</a>
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
                    <form method="POST">
                    <?php
                        foreach($data as $row){
                            ?> 
                            <tr>
                                <td><?=$row['description']?></td>
                                <td><?=$row['key_word']?></td>
                                <td>
                                    <input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
                                    <input type="text" name="value" value="<?=$row['value']?>" class="form-control">
                                </td>
                                
                            </tr>
                            <?php
                        }
                    ?>
                    </form>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(function(){
        
    })
</script>
