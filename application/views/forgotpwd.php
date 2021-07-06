<!DOCTYPE html>

<html>
<head>
        <title>aaaa Ticketing Tool</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?php echo site_url ('assets/image/favicon.png');?>"/>

        <link rel="stylesheet" href="<?php echo site_url ('assets/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo site_url ('assets/css/bootstrap.min.css.map');?>">
        <link rel="stylesheet" href="<?php echo site_url ('assets/css/mystyle.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url ('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo site_url ('assets/css/datatables.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url ('assets/css/bootstrap-multiselect.css');?>">
        <link rel="stylesheet" type="text/css" href="https://cmccs.superapp.com.my/assets/admin/jquery-toast-plugin/dist/jquery.toast.min.css">
<style type="text/css" >
  .error{
    color: red red !important;
  }
</style>
        
</head>
<body>
  <section class="background-login">
    <div class="container cover-caption">
        <div class="row">
            <div class="col-md-6 col-sm-8 offset-md-3 login-box">
                <div class="col-md-12 login-key">
                    <img src="<?php echo site_url ('assets/image/logo.png');?>">
                </div>
               <div class="col-md-12 login-title">
                    Forgot Password
                </div>
                             <form method="post" action="<?php echo site_url('forgotPasswordPost');?>">
                            <div class="form-group">
                                <label class="form-control-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="" required>
                                <div class="alert-danger"></div>
                            </div>
                            <div class="loginbttm">
                                 <button type="submit" class="btn btn-block btn-outline-primary" value="Login">SUBMIT</button>
                            </div>

                        </form>
                </div>
        </div>
      </div>
     </div> 
  </section>

<?php $this->load->view('admin/footer');
?>