<?php
use \Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

if($session->get('status') == 'badLogin'){
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

<html>
<link rel="stylesheet" href="/css/bootstrap.css">
<head></head>

<body>
<div class="jumbotron" style="background-image: url(http://us.123rf.com/400wm/400/400/martinusg/martinusg0901/martinusg090100052/4167445-bright-and-colorful-thumb-tacks-close-up.jpg); background-size: 100%;">
    <h1 align="center" style="color: #ffffff">Pin Your Interests!</h1>
  <p align="center" style="color: #ffffff">Daria Caraway's Final ITP 499 Project</p>
</div>




<form method="post" align="center" action="/login-process">
    <br>
    <div style="color: blueviolet">
        Username: <input type="text" style="width: 300px" name="username" />
    </div>
    <br>
    <div style="color: blueviolet">
        Password: <input type="text" style="width: 300px" name="password" />
    </div>
    <br>
    <div>
        <input type="submit" class="btn btn-default" style= "width:200px"  value="Login">
    </div>
    <br><br><br>

    <a href="/signUp">Sign Up</a>

</form>


</body>


</html>
