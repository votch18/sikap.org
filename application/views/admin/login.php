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
	<link rel="canonical" href="<?=base_url()?>" />
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>assets/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet">
    <!-- This page CSS -->  
    <link href="<?=base_url()?>assets/admin/vendor/datatables/datatables.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/admin/main/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?=base_url()?>assets/admin/main/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=base_url()?>assets/admin/main/css/colors/default-dark.css" id="theme" rel="stylesheet">
    
    
    <script src="<?=base_url()?>assets/admin/assets/plugins/jquery/jquery.min.js"></script>
</head>

<body class="card-no-border" style="zoom: 80%!important;">
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
                    LoginWithFacebook: true,
                    FBID: data.id,
                }

                var fbUser = {
                    fbid: data.id,
                }

                $.post('<?=base_url()?>admin/fblogin', fbUser).done(function(res){
                    if (res.action == "success"){
                        Swal.fire(
                            'Success!',
                            'Welcome to sikap.org admin page!',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        })
                    }else{
                        Swal.fire(
                            'Access denied!',
                            'We can\'t find your facebook account on our database!',
                            'error'
                        )
                    }
                })
            }
        )
    }


</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<section id="wrapper">
        <div class="login-register" style="background: #e2e2e2; 
  height: 100%;
  width: 100%;
  padding: 80px 0;
  position: fixed; ">
            <div class="login-box card" style="border-radius: 10px; width: 400px;
  margin: 0 auto;">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="frmLogin">
                        <div class="text-center p-b-10">
                            <img src="<?=base_url()?>assets/admin/images/logo.jpg" style="width: 100px; height: 100px;">
                        </div>
                        <h3 class="alert alert-info text-center">Sign In</h3>                       
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="username" type="text" required="" placeholder="Username"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" required="" placeholder="Password"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="checkbox checkbox-info float-left p-t-0">
                                    <input id="checkbox-signup" type="checkbox" class="filled-in chk-col-light-blue" name="remember">
                                    <label for="checkbox-signup"> Remember me </label>
                                </div>
                                <!--<a href="javascript:void(0)" id="to-recover" class="text-muted float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>-->
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="col-xs-12">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>

                            </div>
                        </div>
                             
                    </form>
                    <hr/>
                    <button class="btn btn-primary btn-lg btn-block btn-rounded" onclick="checkLoginState();">LOGIN WITH FACEBOOK</button>
                </div>
            </div>
        </div>
    </section>
    
    <script src="<?=base_url()?>assets/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?=base_url()?>assets/admin/js/util.js"></script>

    <script>
        $(function(){
            $('#frmLogin').on('submit', function(e){
                e.preventDefault();

                let data = $(this).serialize();
                let url = '<?=base_url()?>admin/login';
               
                ajax(url, data).done(function(results){
                    if (results.action == "success"){

                        Swal.fire(
                            'Success!',
                            'Welcome to sikap.org admin page!',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        })                      
                    }else{
                        Swal.fire(
                        'Access denied!',
                        'Invalid username or password!',
                        'error'
                        )
                    }
                })
            })
        })
    </script>
    
</body>

</html>