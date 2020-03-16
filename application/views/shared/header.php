<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr" >

<head>    
    <?php
        if (@$_SERVER['HTTPS'] != "on") {
            ?>
            <script>               
                function redrToHttps()
                {
                    var splitUrl = (window.location.href).split("://");
                    if (splitUrl[0] !== 'https') {
                        var httpURL = window.location.hostname + window.location.pathname + window.location.search;
                        var httpsURL = "https://" + httpURL;
                        window.location = httpsURL;
                    }
                }
                //redrToHttps();
            </script>
            <?php
        }
    ?>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="JM de Leon">
    <title>utalking2</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fonts/meteocons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendors/css/extensions/sweetalert.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/pages/timeline.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/pages/app-chat.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url()?>assets/vendors/js/vendors.min.js"></script>
    <script src="<?=base_url()?>assets/js/util.js"></script>
    <!-- BEGIN Vendor JS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout 2-columns menu-collapsed horizontal-menu <?=!empty($url) && $url == 'messages' ? 'chat-application fixed-navbar pace-done' : ''?>" data-open="click"
    data-menu="horizontal-menu" data-col="2-columns">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99"
            style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-border navbar-light fixed-top"
        data-nav="brand-center">
        <div class="navbar-wrapper">
            <div class="row" style="width: 100%; overflow-y: none; margin-left: 0!important;">
                <div class="col-2 col-sm-3 col-md-4">

                    <a class="navbar-brand pl-0 d-none d-md-block d-lg-block d-xl-block" href="<?=base_url()?>" style="padding: 10px; margin-top: 3px;">
                        <img class="brand-logo" alt=" admin logo" src="<?=base_url()?>assets/images/logo.png" style="height: 30px; width: auto;">
                        <span class="font-weight-bold" style="color: #1da1f2!important;">utalking2</span>
                    </a>
                    
                    <a class="navbar-brand pl-0 d-block d-md-none d-lg-none d-xl-none" href="<?=base_url()?>" style="padding: 10px; margin-top: 3px;">
                        <img class="brand-logo" alt=" admin logo" src="<?=base_url()?>assets/images/logo.png"
                            style="height: 30px; width: auto;">
                    </a>

                </div>
                <div class="col-8 col-sm-6 col-md-4">
                    <div style="padding: 7px; max-width: 400px; margin: 2px auto 0; vertical-align: middle;" class="w-100">
                        <form method="get" action="<?=base_url()?>">
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <input type="text" name="q" class="form-control has-icon-left" placeholder="Search">
                                <div class="form-control-position">
                                    <i class="fa fa-search secondary"></i>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="col-2 col-sm-3 col-md-4 pr-2">
                    <div class="float-right" style="padding: 7px; padding-right: -15px; margin-right: -15px; ">
                        <?php
                        if (!isset($user["username"])){
                        ?>
                        <div class="d-none d-md-block d-lg-block d-xl-block">
                            <a class="btn btn-outline-primary teal font-bold d-inline-block p-0 text-bold-500" href="<?=base_url()?>"
                                style="min-width: 120px; vertical-align: middle; padding: 7px!important; margin-top: 3px;" data-toggle="modal" data-target="#loginModal"
                                data-backdrop="static">
                                LOG IN
                            </a>
                            <a class="btn bg-info white font-bold d-inline-block p-0 text-bold-500"  href="<?=base_url()?>"
                                style="min-width: 120px; vertical-align: middle; padding: 7px!important; margin-top: 3px;" data-toggle="modal" data-target="#signupModal"
                                data-backdrop="static" data-keyboard="false">
                                SIGN UP
                            </a>
                        </div>
                        
                        <?php
                        }else{
                            $photo = empty($user['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$user['photo'].'?'.strtotime("now");
                        ?>
                        <div class="d-none d-md-block d-lg-block d-xl-block"> 
                            <div class="d-inline-block">
                                <a class="nav-link btn-header" href="<?=base_url()?>posts/submit/" data-toggle="tooltip" data-placement="bottom" title="Create Post">
                                <i class="ft-edit-3 fa-lg"></i>
                                </a>                                               
                            </div>
                            <div class="d-inline-block dropdown dropdown-notification nav-item">
                                <a class="nav-link btn-header" href="#" data-toggle="dropdown" aria-expanded="true">
                                <i class="ft-mail fa-lg"></i>
                                <span class="badge badge-pill badge-warning badge-up notification_count"></span>
                                </a>        
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="width: 24rem;">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6>
                                    </li>
                                    <li class="scrollable-container media-list">
                                    </li>
                                    <li class="dropdown-menu-footer">
                                        <a class="dropdown-item text-muted text-center" href="<?=base_url()?>messages">Read all messages</a></li>
                                </ul>                                       
                            </div>
                            <div class="d-inline-block">                          
                                <a class="dropdown-toggle nav-link dropdown-user-link white" href="#" data-toggle="dropdown" style="border: 1px solid #ccd6e6; border-radius: 5px;">
                                    <span class="avatar avatar-online" style="vertical-align: middle!important;">
                                        <img src="<?=base_url().$photo?>" alt="avatar" style="height: 30px; width: 30px;">
                                    </span>
                                    <span class="blue d-none d-sm-inline-block d-md-inline-block d-lg-inline-block">&nbsp;<?=$user["username"]?></span>                                   
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mr-1" style="width: 200px;">                           
                                    <a class="dropdown-item p-1" href="<?=base_url()?>users/profile/"><i class="ft-user fa-lg"></i> My Profile</a>
                                    <a class="dropdown-item p-1" href="<?=base_url()?>messages/"><i class="ft-mail fa-lg"></i> Messages</a>                                
                                    <a class="dropdown-item p-1" href="" data-toggle="modal" data-target="#changePassModal"><i class="ft-settings fa-lg"></i> Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item p-1" href="<?=base_url()?>users/logout"><i class="ft-arrow-right fa-lg pull-right"></i> Logout</a>
                                </div>    
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="d-block d-md-none d-lg-none d-xl-none">                        
                            <a class="nav-link open-navbar-container collapsed blue" data-toggle="collapse" data-target="#navbar-mobile" aria-expanded="false"><i class="fa <?=!isset($user["username"]) ? 'fa-ellipsis-v' : 'fa-bars'?> fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-container content d-block d-md-none d-lg-none d-xl-none">
            <div class="navbar-collapse collapse" id="navbar-mobile" style="">                    
                <ul class="<?=!isset($user["username"]) ? 'nav navbar-nav' : ''?> w-100" style="padding: 10px 0;">
                        <?php
                        if (!isset($user["username"])){
                        ?>
                         <li class="ml-auto">
                            <a class="btn btn-outline-primary mr-1 teal font-bold d-inline-block p-0 text-bold-500" href="<?=base_url()?>"
                                style="min-width: 120px; vertical-align: middle; padding: 7px!important; margin-top: 3px;" data-toggle="modal" data-target="#loginModal"
                                data-backdrop="static">
                                LOG IN
                            </a>                    
                        </li>
                        <li class="mr-auto">
                            <a class="btn bg-info white font-bold d-inline-block p-0 text-bold-500"  href="<?=base_url()?>"
                                style="min-width: 120px; vertical-align: middle; padding: 7px!important; margin-top: 3px;" data-toggle="modal" data-target="#signupModal"
                                data-backdrop="static" data-keyboard="false">
                                SIGN UP
                            </a>
                        </li>
                        <?php
                        }else{
                            $photo = empty($user['photo']) ?  'assets/images/user.png' : 'uploads/users/'.$user['photo'].'?'.strtotime("now");
                        ?>                
                        <li class="d-block" style="cursor: pointer;">
                            <a class="dropdown-toggle nav-link dropdown-user-link white" href="#" data-toggle="dropdown" style="border: 1px solid #ccd6e6; border-radius: 5px;">
                                <span class="avatar avatar-online" style="vertical-align: middle!important;">
                                    <img src="<?=base_url().$photo?>" alt="avatar" style="height: 30px; width: 30px;">
                                </span>
                                <span class="blue d-inline-block">&nbsp;<?=$user["username"]?></span>                                   
                            </a>
                        </li>                          
                       
                        <li class="d-block" style="cursor: pointer;">
                            <a class="nav-link btn-header" href="<?=base_url()?>posts/submit/" data-toggle="tooltip" data-placement="bottom" title="Create Post">
                            <i class="ft-edit-3 fa-lg"></i>&nbsp; Create Post
                            </a>                                               
                        </li>
                        <li class="d-block" style="cursor: pointer;">
                            <a class="nav-link btn-header" href="<?=base_url()?>messages/" data-toggle="tooltip" data-placement="bottom" title="Messages">
                            <i class="ft-mail fa-lg"></i>&nbsp; Messages
                            <span class="pull-right badge badge-pill badge-warning notification_count"></span>
                            </a>                                               
                        </li>
                        <li class="d-block" style="cursor: pointer;">                         
                            <hr/>
                            <a class="nav-link btn-header" href="<?=base_url()?>users/logout"><i class="ft-arrow-right fa-lg pull-right"></i> Logout</a>
                        </li>
                        <?php
                        }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END: Header-->




    <!-- Login Modal -->
    <div class="modal fade text-left" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content mt-5">
                <div class="modal-header p-2">
                    <h4 class="modal-title" id="myModalLabel1">LOG IN</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-2">
                    <div class="alert d-none">Invalid username or password!</div>
                    <form method="post" id="frmLogin">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">EMAIL OR USERNAME</label>
                                <input type="text" class="form-control static-label" name="username" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">PASSWORD</label>
                                <input type="password" class="form-control static-label" name="password" />
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-min-width btn_signin" value="SIGN IN"/>
                    </form>
                    <hr />
                    <a href="#">Forgot password?</a>
                    <br />
                    <br />
                    Don't have an account? <a href="#" class="btn_signup_link">SIGN UP</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade text-left" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content mt-5">
                <div class="modal-header p-2">
                    <h4 class="modal-title" id="myModalLabel1">CHANGE PASSWORD</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-2">                  
                    <form method="post" id="frmChangePass">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">EMAIL OR USERNAME</label>
                                <input type="text" class="form-control static-label" name="username" value="<?=$user['username']?>" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">PASSWORD</label>
                                <input type="password" class="form-control static-label" name="password" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">CONFIRM PASSWORD</label>
                                <input type="password" class="form-control static-label" name="confirm_password" />
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-min-width btn_signin" value="CHANGE PASSWORD"/>
                    </form>
                  
                </div>

            </div>
        </div>
    </div>


    <!-- Signup Modal -->
    <div class="modal fade text-left" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content mt-5">
                <div class="modal-header p-2">
                    <h4 class="modal-title" id="myModalLabel1">SIGN UP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-2">
                    <form method="post" id="frmSignUP">
                        <div class="form-group row">
                            <div class="col-6">
                                <label class="small">FIRST NAME</label>
                                <input type="text" class="form-control static-label" name="fname" />
                            </div>
                            <div class="col-6">
                                <label class="small">LAST NAME</label>
                                <input type="text" class="form-control static-label" name="lname" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">EMAIL</label>
                                <input type="text" class="form-control static-label" name="email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">USERNAME</label>
                                <input type="text" class="form-control static-label" name="username" />
                            </div>
                        </div>                       
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">PASSWORD</label>
                                <input type="password" class="form-control static-label" name="password" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="small">CONFIRM PASSWORD</label>
                                <input type="password" class="form-control static-label" name="confirm_password" />
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-min-width" value="SIGN UP"/>
                    </form>
                    <hr />                   
                    Already registered? <a href="#" class="btn_signin_link">SIGN IN</a>
                </div>

            </div>
        </div>
    </div>


    <script>
        $(function(){

            $('body').on('click', '.btn_signin_link', function(e){
                e.preventDefault();

                $('#signupModal').modal('hide');
                $('#loginModal').modal('show');
            })


            $('body').on('click', '.btn_signup_link', function(e){
                e.preventDefault();

                $('#loginModal').modal('hide');
                $('#signupModal').modal('show');
            })

            //login
            $('#frmLogin').on('submit', function(e){
                e.preventDefault();
                e.stopPropagation();
                
                var data = $(this).serialize();
                var url = '<?=base_url()?>index.php/users/login';

                ajax(url, data).done(function(results){
                    if (results.data == "success"){
                        $('div.alert').html('<strong>Success!</strong> You will soon be redirected.')
                        $('div.alert').removeClass('alert-danger d-none d-block').addClass('alert-success d-block');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }else{                        
                        $('div.alert').removeClass('d-none').addClass('alert-danger d-block');
                    }
                })
            })


             //login
             $('#frmSignUP').on('submit', function(e){
                e.preventDefault();
                e.stopPropagation();
                
                var data = $(this).serialize();
                var url = '<?=base_url()?>index.php/users/signup';

                ajax(url, data).done(function(results){
                    if (results.data == "success"){
                        swal("Success!", "Please wait for a moment...!", "success");
                        setTimeout(() => {
                            window.location.reload();
                        }, 700);
                    }else{                        
                        swal("Error!", results.data, "error");
                    }
                })
            })

            //change password
            $('#frmChangePass').on('submit', function(e){
                e.preventDefault();
                e.stopPropagation();
                
                var data = $(this).serialize();
                var url = '<?=base_url()?>index.php/users/change_password';

                ajax(url, data).done(function(results){
                    if (results.message == "success"){
                        swal("Success!", "You have successfully change your password!", "success"); 
                        $('#changePassModal').modal('hide');                       
                    }else{                        
                        swal("Error!", results.message, "error");
                    }
                })
            })

        })
    </script>