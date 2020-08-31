<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Settings</h3>
    </div>
    <div class="col-md-7 align-self-center">
        
    </div>   
</div>
<?php
if (isset($view) && $view == true){
    ?>

    <div class="row m-b-5">
        <div class="col-md-12">
            <div class="alert alert-info small">Don't forget to click save changes button everytime you made changes.</div>
            <div class="card">
                <div class="card-body">
                    <h3>Website information</h3>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="site_name">
                        <label class="font-bold">Site name</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['site_name']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="site_desc">
                        <label class="font-bold">Description</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="value" class="form-control" rows="5"><?=$settings['site_desc']?></textarea>
                                    <sub>A meta description is an attribute within your meta tags that helps describe your page. This snippet of text may appear in the search engine results under your headline.</sub>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="site_tags">
                        <label class="font-bold">Keywords</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="value" class="form-control" rows="5"><?=$settings['site_tags']?></textarea>
                                    <sub>Meta keywords are ideas and topics that define what your content is about. In terms of SEO, they're the words and phrases that searchers enter into search engines, also called "search queries."</sub>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="site_logo">
                        <label class="font-bold">Logo</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="hidden" name="value" class="form-control" value="<?=$settings['site_logo']?>">
                                    <div class="col-md-12" style="background:#e9e9e9; height: 200px;">
                                        <div class="row">
                                            <?php
                                            $photo = !empty($settings['site_logo']) ? base_url().'filemanager/'.$settings['site_logo'] : base_url().'assets/admin/images/noimage.png';
                                            ?>
                                            <img id="img-uploader" class="img-responsive" src="<?=$photo?>" style="display:block;margin: 20px auto; width: 150px; height: 150px;max-height: 150px"/>
                                        </div>
                                        <a href="#" data-toggle="modal" data-target="#dialogFilemanager">
                                            <div style="display: block; margin-top: -160px; text-align: center; width: 100%;">
                                                <span class="fa fa-cloud-upload" style="font-size: 45px;"></span><br/><br/>
                                                <span style="display: block">Choose from File Manager <br>(100w x 100h)</span>
                                            </div>
                                            <input type="hidden" name="image" value="<?=!empty($page['banner']) ? $page['banner'] : ''?>"/>
                                        </a>
                                    </div>
                                    <sub>Ideal image size (100w x 100h)<br/>
                                        Note: Changes will take effect after reload.
                                    </sub>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <br/>
                    <h3>Additional information</h3>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="	site_about">
                        <label class="font-bold">About us</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="value" class="form-control" rows="5"><?=$settings['site_about']?></textarea>
                                    <sub>A short description about your website/company.</sub>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="address">
                        <label class="font-bold">Address</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="value" class="form-control" rows="5"><?=$settings['address']?></textarea>
                                    <sub>Your company address.</sub>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="contactno">
                        <label class="font-bold">Contact number</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['contactno']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="email">
                        <label class="font-bold">Email address</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['email']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <br/>
                    <h3>Social media links</h3>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="facebook">
                        <label class="font-bold">Facebook</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['email']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="twitter">
                        <label class="font-bold">Twitter</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['twitter']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="instagram">
                        <label class="font-bold">Instagram</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['instagram']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="youtube">
                        <label class="font-bold">Youtube</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['youtube']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <form method="POST">
                        <input type="hidden" name="keyword" value="linkedin">
                        <label class="font-bold">Linkedin</label>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="value" class="form-control" value="<?=$settings['linkedin']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success d-inline-block">Save changes</button>
                            </div>
                        </div>
                    </form>

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

    <?php
}else{
    ?>
    <div class="alert alert-danger">
        <h3>Access denied!</h3>
        <p>It seems that your are not allowed to access this page. Please contact system administrator.</p>
    </div>
    <?php
}
?>
