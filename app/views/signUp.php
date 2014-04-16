<html>
<link rel="stylesheet" href="/css/noSpace.css">
<head></head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/login">Return to Login</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="jumbotron"  style="background-color: blueviolet">
  <h1 align="center" style="color: #ffffff">Pin Your Interests!</h1>
  <p align="center" style="color: #ffffff">Daria Caraway's Final ITP 499 Project</p>
</div>

<?php
use \Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

if($session->get('status') == 'badSignin'){
    $flash = $session->getFlashBag()->get('statusMessage');

    if($flash): ?>
        <div align = "center" class="alert alert-danger">
        <?php
        echo $flash[0];
    endif;   ?>
    </div>
    <?php
    $session->clear();

}
if($session->get('status') == 'badValidation'){
    $flash = $session->getFlashBag()->get('statusMessage');
    if($flash): ?>
        <div align = "center" class="alert alert-danger">
        <?php
        echo $flash[0];
    endif;   ?>
    </div>
    <?php
    $session->clear();

}
?>

<h1 align="center">Sign Up!</h1>

<form method="post" align="center" action="/signUp-process">
    <br>
    <div style="color: blueviolet">
        Email: <input type="text" style="width: 300px" name="email" />
    </div>
    <br>
    <div style="color: blueviolet">
        Username: <input type="text" style="width: 300px" name="username" />
    </div>
    <br>
    <div style="color: blueviolet">
        Password: <input type="text" style="width: 300px" name="password" />
    </div>
    <br>
    <div style="color: blueviolet">
        Re-Enter Password: <input type="text" style="width: 300px" name="password2" />
    </div>
    <br>
    <div>
        <input type="submit" class="btn btn-default" style= "width:200px"  value="SignUp">
    </div>
    <br><br><br>

</form>


</body>


</html>

