<div class="navbar navbar-horizontal navbar-light navbar-shadow mb-3" style="width: 100%; ">
    <div class="navbar-container" style="max-width: 1200px; margin: 60px auto 0;">
        <ul class="nav navbar-nav d-inline-block">
            <li class="nav-item d-inline-block mr-1 pl-1 pr-1">
                <a class="nav-link" href="<?=base_url()?>users/profile/">
                    <i class="ft-file-text"></i><span class="d-none d-md-inline-block">Posts</span>
                </a>
            </li>
            <li class="nav-item d-inline-block mr-1 pl-1 pr-1">
                <a class="nav-link" href="<?=base_url()?>users/comments/">
                    <i class="ft-message-square"></i><span class="d-none d-md-inline-block">Comments</span>
                </a>
            </li>
            <li class="nav-item d-inline-block mr-1 pl-1 pr-1" style="border: 1px solid #2196f3; border-width: 0 0 3px 0;">
                <a class="nav-link" href="<?=base_url()?>users/activities/">
                    <i class="ft-activity"></i><span class="d-none d-md-inline-block">Activities</span>
                </a>
            </li>

        </ul>
    </div>
</div>

<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 0 auto;">
    <div class="content-wrapper pt-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!--Content -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card rounded m-0" style="margin-bottom: 10px!important;">
                        <div class="card-content">
                            <div class="card-body" style="vertical-align: middle;">
                            <h4 class="card-title">ACTIVITIES</h4>
                                <h6 class="card-subtitle text-muted">List of user activities.</h6>
                                <table class="table" id="dataTable">   
                                    <thead class="d-none">
                                        <th></th>
                                        <th></th>
                                    </thead>                                
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php $this->load->view('shared/profile') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<script>
    $(function () {
        $('#dataTable').dataTable({
            "pageLength": 25,
            "bLengthChange": false,
            "searching": true,
            "info": true,
            "ordering": false,
            "autoWidth": false
        });

        $('body').on('click', '.btn_delete', function (e) {
            e.preventDefault();
            let url = '<?=base_url()?>comments/delete';
            let data = {
                id: $(this).attr('data-id'),
                file: $(this).attr('data-filename'),
            }

            let $row = $(this).parent().parent();

            swalPrompt("Are you sure you want to delete this comment?", "Delete")
                .then((confirm) => {
                    if (confirm) {
                        ajax(url, data).done(function (results) {
                            if (results.message == "success") {
                                $row.remove();
                                swal("Success!", "You have successfully deleted a comment.",
                                    "success");
                            } else {
                                swal("Oh Snap!",
                                    "An error occured while deleting your comment.",
                                    "error");
                            }
                        })
                    }
                })
        })

    })
</script>