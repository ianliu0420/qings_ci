<html lang="en">
  <head>
    <title>qings management</title>
    <link href="<?php echo base_url() ?>public/extlib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/css/signin.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

      <form class="form-signin" role="form" method="post" action="<?php echo site_url("admin/login")?>">
        <h2 class="form-signin-heading">Qings cleaning</h2>
          
        <div><p style="color:red"><?php echo $errorinfo; ?></p></div>
        
        <input <?php if($username!=null){?>value="<?php echo $username;}?>" type="email" name="username" id="username" class="form-control" placeholder="Email address" required autofocus>
        <input value="" type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" name="reme" id="reme"> Remember me
        </label>
        <input name="ispost" id="ispost" value="1" type="hidden">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>public/extlib/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
