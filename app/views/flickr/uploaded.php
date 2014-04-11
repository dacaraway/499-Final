
<html>
<link rel="stylesheet" href="/css/bootstrap.css">

<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>

</head>
<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">Pin It!</h1>
            </div>
            <form action= "/pin" method="post">
                <div class="modal-body">
                    <h3> Please Choose a Category</h3>
                    <input id="picture-url" type="hidden" name="url"  />
                    <select name="category">
                        <option value="1">Animals</option>
                        <option value="2">Clothing</option>
                        <option value="3">Home</option>
                        <option value="4">Photography</option>
                    </select>
                <h3>Add a Description:</h3>
                <input type="text" style="width: 300px" name="desc"  />
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" style= "width:200px"  value="Finish">
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>

</html>


<?php
/**
 * Created by PhpStorm.
 * User: Daria
 * Date: 4/8/14
 * Time: 4:15 PM
 */
use \Symfony\Component\HttpFoundation\Session\Session;
use \Symfony\Component\HttpFoundation\RedirectResponse;


if (isset($_POST['name']) && $error != 1 && $error != 2 && $error != 3 && $error != 4 && !$_FILES['file']['error']) {
    $session = new Session();
    $session->getFlashBag()->set('statusMessage', 'Item Uploaded!');

echo "<img src=".$url.">";
echo "<a data-toggle='modal' href='#myModal' data-url=".$url." class='btn btn-primary btn-lg'>Pin It!</a>";

}

else {
    $session = new Session();
    $session->set('status', 'badPic');


    if($error == 1){
        $session->getFlashBag()->set('statusMessage', 'Please provide both name and a file');


    }else if($error == 2) {
        $session->getFlashBag()->set('statusMessage', 'nable to upload your photo, please try again');

    }else if($error == 3){
        $session->getFlashBag()->set('statusMessage', 'Please upload JPG, JPEG, PNG or GIF image ONLY');

    }else if($error == 4){
        $session->getFlashBag()->set('statusMessage', 'Image size greater than 512KB, Please upload an image under 512KB');

    }
    else{
        $session->getFlashBag()->set('statusMessage', 'Image size is too large');

    }

    $response = new RedirectResponse('/dashboard');
    return $response->send();
}



