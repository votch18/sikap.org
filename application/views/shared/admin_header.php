
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel='icon' href='<?=base_url()?>filemanager/<?=$settings['site_favicon']?>' type='image/x-icon' >
    <title><?=$settings['site_name']?></title>
	
    <link href="<?=base_url()?>assets/admin/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet">
    <!-- This page CSS -->  
   
    <link href="<?=base_url()?>assets/admin/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/admin/main/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?=base_url()?>assets/admin/main/css/pages/dashboard4.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=base_url()?>assets/admin/main/css/colors/default-dark.css" id="theme" rel="stylesheet">
    
    <link href="<?=base_url()?>assets/admin/main/css/switch.css" id="theme" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/vendor/cropper/cropper.css" rel="stylesheet">

    <style>
        #sidebarnav > li.active {
            border: 1px solid #0099ff;
            border-width: 0 0 0 5px!important;
        }
       
    </style>

    <script src="<?=base_url()?>assets/admin/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=base_url()?>assets/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>

    <script src="<?=base_url()?>assets/admin/vendor/datatables/datatables.js"></script>
    <script src="<?=base_url()?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url()?>assets/admin/main/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url()?>assets/admin/main/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url()?>assets/admin/main/js/custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="<?=base_url()?>assets/admin/vendor/cropper/cropper.js"></script>

    <script>
        var fromTinyMCE = false;
    </script>
</head>

<body class="fix-header fix-sidebar card-no-border" >


<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '2872356789536829',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v8.0'
        });

    };

    function FBLogin(){
        FB.login(function(response) {
            if (response.authResponse) {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                    console.log(response);
                    console.log('Good to see you, ' + response.name + '.');
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        });
    }

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                accessToken = response.authResponse.accessToken
                getUserData(accessToken)
            }
            else {
                FBLogin();
            }
        });
    }

    function getUserData(accessToken){
        FB.api(
            '/me',
            {
                fields: 'id,email,first_name,last_name,middle_name',
                access_token: accessToken,
            },
            function(data) {
                var fbUser = {
                    userid: '<?=$admin["id"]?>',
                    fbid: data.id,
                }

                $.post('<?=base_url()?>admin/fbconnect', fbUser).done(function(res){
                    if (res.action == "success"){
                        swal.fire("Success!", "Your account has been linked!", "success");
                    }else{
                        swal.fire("Error!", "An error occured while linking your account with facebook!", "error");
                    }
                })
                //console.log(data);
            }
        )
    }


</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<!-- Main wrapper - style you can find in pages.scss style="zoom: 80%!important;"-->
    
    <div id="main-wrapper">
        
        <!-- Topbar header - style you can find in pages.scss -->
        
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                
                <!-- Logo -->
                
                <div class="navbar-header">
                    <span class="navbar-brand" href="<?=base_url()?>admin">
                    
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?=base_url()?>filemanager/<?=$settings['site_logo']?>" alt="homepage" class="dark-logo" style="width: 50px; height: 50px;"/>
        
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                        <h3 class="d-inline-block font-bold dark-logo">SIKAP, Inc.</h3>
                        </span>
                       
                </div>
                
                <!-- End Logo -->
                
                <div class="navbar-collapse">
                    
                    <!-- toggle and nav items -->
                    
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><span class="status text-success m-l-20"></span></a> </li>
                    </ul>
                    
                    <!-- User profile and search -->
                    
                    <ul class="navbar-nav my-lg-0">
                        
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                    $photo = !empty($admin['photo']) ? base_url().'uploads/users/'.$admin['photo'] : base_url().'assets/admin/images/avatar.png';
                                ?>
                                
                                <img src="<?=$photo?>" alt="<?=$admin['username']?>" class="profile-pic"  style="height: 30px; width: 30px;" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">                                        
                                            <div class="u-text mt-1">
                                                <h4><?=ucwords($admin['fname'].' '.$admin['lname'])?></h4>
                                                <p class="text-muted"><?=$admin['email']?></p>
                                                <a href="<?=base_url()?>admin/users/<?=$admin['username']?>" class="btn btn-rounded btn-warning btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>                                  
                                    <li><a href="#changePassModal" data-toggle="modal" data-target="#changePassModal" data-backdrop="static"><i class="ti-settings"></i> Change password</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?=base_url()?>admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <!-- End Topbar header -->
        
        
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">                        
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="nav-small-cap">POSTS</li>
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/news" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Features & News</span></a>
                        </li>
                        <!--<li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/announcements" aria-expanded="false"><i class="mdi mdi-bullhorn"></i><span class="hide-menu">Announcements</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/accreditations" aria-expanded="false"><i class="mdi mdi-library-books d-inline-block"></i><span class="hide-menu" style="width: 80%; vertical-align: middle;">Accreditation & Membership</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/awards" aria-expanded="false"><i class="mdi mdi-trophy d-inline-block"></i><span class="hide-menu" style="width: 80%; vertical-align: middle;">Awards & Recognition</span></a>
                        </li>
                        -->
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/programs" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Programs & Projects</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/slider" aria-expanded="false"><i class="mdi mdi-burst-mode"></i><span class="hide-menu">Slider</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="<?=base_url()?>admin/filemanager" aria-expanded="false"><i class="mdi mdi-inbox"></i><span class="hide-menu">Filemanager</span></a>
                        </li>
                        <li class="nav-small-cap">SETTINGS</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?=base_url()?>admin/pages" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Themes</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="<?=base_url()?>admin/pages">Pages</a></li>
                                <li><a href="<?=base_url()?>admin/templates">Templates</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?=base_url()?>admin/settings" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Maintenance</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="<?=base_url()?>admin/settings">Site Settings</a></li>
                                <?php
                                    if ($admin['id'] == '1'){
                                    ?>
                                        <li><a href="<?=base_url()?>admin/users">Users</a></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <div class="modal fade" id="dialogFilemanager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <button id="modal-close" class="btn btn-danger" data-dismiss="modal" style="position: absolute;top:10px;right:10px;z-index:1"><span style="font-size: 18px;">&times;</span></button>
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content p-0">
                        <div class="modal-body p-0">
                            <iframe src="<?php echo base_url()?>filemanager/iframe" style="width: 100%; height: 420px!important; border:none;background: transparent; z-index: 999;"></iframe>
                        </div>
                    </div>       
                </div>
            </div>
            <!-- Container fluid  -->
            
            <div class="container-fluid" id="main">

            <div style="position: absolute;">
                <div class="fb-root"></div>
            </div>


            