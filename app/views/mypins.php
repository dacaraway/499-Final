<?php
use \Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
?>

<html>

<link rel="stylesheet" href="/css/bootstrap.css">

<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
                <li><a href="/dashboard">Home</a></li>
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
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">Don't want it anymore?</h1>
            </div>
            <form action= "/delete" method="post">
                <div class="modal-body">
                    <h3> Are you sure you would like to delete this pin?</h3>
                    <input id="picture-url" type="hidden" name="url"  />
                    <input id="picture-cat" type="hidden" name="cat"  />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" style= "width:200px"  value="Delete">
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<h1 align="center">
    <?php echo $category[0]->category;?>
</h1>

<?php

$flash = $session->getFlashBag()->get('statusMessage');

if($flash):
?>

<div align = "center" class="alert alert-success">
    <?php
    echo $flash[0];
    endif; ?>
</div>


<div id="container">
    <?php
    foreach($results as $pic):
        $url = $pic->link;
        $cat = $pic->category_id;
        $desc = "";
        if($pic->description){
            $desc = $pic->description;
        }
        ?>
            <div id="inside" class="item" align="center">
                <?php
                echo "<img src=".$url." class='item2'>";
                echo $desc;
                   ?>
                <div align="right">
                    <?php
                    echo "<a data-toggle='modal' href='#myModal' data-url=".$url." data-cat=".$cat." class='btn btn-xs btn-default'>x</a>";
                    ?>
                </div>
            </div>
        <?php
        //<figcaption>Rapunzel, clothed in 1820’s period fashion</figcaption>
    endforeach;
    ?>
</div>

<script>
    $(function () {
        var count = $('.item img').each(function () {
            var $this = $(this);
            $this.load(function () {
                $this.attr('width', $this.width());
                $this.attr('height', $this.height());
                console.log(count);
                if (--count == 0) run();
            });
        }).length;
        console.log(count);
    });

</script>
<script src="/js/masonry.pkgd.min.js"></script>
<script>
    function run() {
        var ms = new Masonry($('#container')[0], { columnWidth: 30, itemSelector: '.item' });
    }
</script>


</body>
</html>