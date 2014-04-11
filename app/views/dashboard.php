<?php

use \Symfony\Component\HttpFoundation\Session\Session;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use \Carbon\Carbon;


$session = new Session();

if($session->get("id") == null){
    $session->set('status', 'badLogin');
    $session->getFlashBag()->set('statusMessage', 'Please Login');
    $response = new RedirectResponse('/login');
    return $response->send();
}

$nowTime =  Carbon:: now(new DateTimeZone('Europe/London'));
$lastTime =  new Carbon($session->get('time'),new DateTimeZone('Europe/London') );
$string;



if ($nowTime->diffInSeconds($lastTime) < 60){
    $string = "Last Login: " .+ $nowTime->diffInSeconds($lastTime);
    $string.= " seconds ago";

}
else{
    $string = "Last Login: " .+ $nowTime->diffInMinutes($lastTime);
    $string .= " minutes ago";
}
?>

<html>

<link rel="stylesheet" href="/css/bootstrap.css">


<head>
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
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Pins <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/mypins/get/1">Animals</a></li>
                        <li><a href="/mypins/get/2">Clothing</a></li>
                        <li><a href="/mypins/get/3">Home</a></li>
                        <li><a href="/mypins/get/4">Photography</a></li>
                        <li class="divider"></li>
                        <li><a href="/mypins/get/5">Show All</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" method="get" action="/flickrResults">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="tag">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text">Username:
                    <?php
                    echo $session->get('username');
                    ?>
                </p>
                <p class="navbar-text">
                    <?php
                    echo $string;
                    ?>
                </p>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<?php

if($session->get('status') == 'badPic'){
    $flash = $session->getFlashBag()->get('statusMessage');

    if($flash): ?>
        <div align = "center" class="alert alert-danger">
        <?php
        echo $flash[0];
    endif;   ?>
    </div>
    <?php
}
else{
    $flash = $session->getFlashBag()->get('statusMessage');

    if($flash):
    ?>

    <div align = "center" class="alert alert-success">
        <?php
        echo $flash[0];
        endif; ?>
    </div>
<?php
}
?>


<div class="jumbotron"  style="background-color: blueviolet">
    <h1 align="center" style="color: #ffffff">Start Pinning Now!</h1>
    <form method="get" align="center" action="/flickrResults">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="tag">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <br>

    <br>

    <h1 align="center" style="color: #ffffff">Or Upload Your Own!</h1>
    <form  method="post" accept-charset="utf-8" enctype='multipart/form-data' action="/upload">
        <h4 align="center" style="color: #ffffff">Name your picture!</h4>
        <div style="color: blueviolet" align="center">
        <br>
            <input type="text" style="width: 300px" name="name"  />

        </div>
        <br>
        <div align="center" style="color: #ffffff">
        <h4>Picture:</h4>
        <br>
            <input type="file" name="file"/></p>
        </div>
        <br>
        <div align="center">
            <input type="submit" class="btn btn-default" style= "width:200px"  value="Upload">
        </div>
    </form>
</div>




</body>

</html>