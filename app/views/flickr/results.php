<html>
    <head>
        <title>Search Results</title>
    </head>
    <body>
        <h1 align="center">
            Here are all your pictures!!
        </h1>
        <h5 align = "center">
            Images take time to load... be patient!
        </h5>
    </body>
</html>

<?php
    foreach($results as $pic):
        $url = "'http://farm".$pic->farm.".staticflickr.com/".$pic->server."/".$pic->id."_".$pic->secret.".jpg'";

        echo "<img src=".$url.">";

    endforeach;