
<!-- Modal -->
<div class="modal fade" id="accessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Access Rights</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="alert alert-info">Grant access rights for <b><?=$user["username"]?></b></h3>
                <ul class="list-group">
                    <?php

                    foreach ($access as $row) {
                        ?>
                        <li class="list-group-item"><?=$row["category"].' - '.$row["action"]?>
                            <label class="switch m-0 p-0" style="vertical-align: middle; float: right;">
                                <input type="checkbox" <?=!empty($row['access']) ? "checked" : ""?> data-access="<?=$row["id"]?>">
                                <span class="slider round"></span>
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('change', 'input[type="checkbox"]', function(e){
        e.preventDefault();
        $.post('<?=base_url()?>users/set_access_rights',
        { userid: '<?=$user['id']?>', access: $(this).data('access') })
        .done(function(res){
            if (res.message != "success"){
                Swal.fire("An error occurred while granting access for this user!", "", "error")
            }
        })
    })
</script>
