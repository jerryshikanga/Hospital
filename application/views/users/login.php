<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Bracket Responsive Bootstrap3 Admin</title>

  <link href="<?php echo base_url(); ?>assets/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">
<section>
    <div class="signinpanel">
        <div class="row">
            <div class="col-md-7">
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> bracket <span>]</span></h1>
                    </div><!-- logopanel -->
                    <div class="mb20"></div>
                    <h5><strong>Welcome to Hospital Management System!</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Patients Management</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Doctors Management</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                </div><!-- signin0-info -->
            </div><!-- col-sm-7 -->
            <div class="col-md-5">
                <?php echo validation_errors('<p class="error">'); ?>
                <!--  <?php echo validation_errors(); ?> -->
                <?php echo form_open('users/verifylogin'); ?>
                    <h4 class="nomargin text-center">Sign In</h4>
                    <p class="mt5 mb20 text-center">Login to access your account.</p>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control uname" placeholder="Username" name="username" autofocus/>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control pword" placeholder="Password" name="password"/>
                    </div>
                    <a href="#"><small>Forgot Your Password?</small></a>
                    <button class="btn btn-success btn-block">Sign In</button>
                </form>
            </div><!-- col-sm-5 -->
        </div><!-- row -->
        <div class="signup-footer">
            <div class="text-center">
                &copy; 2016. All Rights Reserved
            </div>
        </div>
    </div><!-- signin -->
</section>
</body>
</html>
