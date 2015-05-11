<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Qings management</title>
    <link href="<?php echo base_url() ?>public/extlib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link href="<?php echo base_url() ?>public/css/datecustomer.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>public/css/style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" class="active">Qings Cleaning Management System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li id="nav1"><a href="<?php echo site_url()?>/comment/index">Survey Management</a></li>
            <li id="nav2"><a href="Payment_List.php">Work Management</a></li>
            <li id="nav3"><a href="<?php echo site_url()?>/pronewcode/index">Promotion Management</a></li>
            <li><a href="Logoff.php">Log out</a></li>
          </ul>
<!--           <form class="navbar-form navbar-right"> -->
<!--             <input type="text" class="form-control" placeholder="Search..."> -->
<!--           </form> -->
        </div>
      </div>
    </nav>
