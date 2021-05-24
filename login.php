<?php
require_once 'include/dbconfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('index');
}

if(isset($_POST['login']))
{
 $umail = $_POST['email'];
 $upass = $_POST['password'];
 
  
 if($user->login($umail,$upass))
 {
  $user->redirect('index');
 }
 else
 {
  $error = "Email ose Fjalëkalimi nuk janë të sakta!";
 } 
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Panel Administrimi">
        <meta name="author" content="Albi">
        <link rel="shortcut icon" href="assets/images/favicon.png">
        <title>Panel Administrimi - <?php $page = $_SERVER['PHP_SELF']; echo $currentpage = ucwords(str_replace("_"," ",(basename($page,".php")))); ?></title>
    

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        
    </head>

    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <img alt="Bonoro" src="assets/images/logo.png" style="height:130px;">
                <h5 class="text-muted m-t-0 font-600">Panel Administrimi</h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Identifikohu</h4>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" method="POST">
                        <?php
                            if(isset($error))
                            {
                                  ?>
                                    <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo $error; ?>
                                    </div>
                                  <?php
                            }
                        ?>
            
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email" required placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" required placeholder="Fjalëkalimi">
                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-bordred btn-block waves-effect waves-light" name="login" type="submit">Hyr</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card-box-->

        </div>
        <!-- end wrapper page -->
	</body>
</html>
