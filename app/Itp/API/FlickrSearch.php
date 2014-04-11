<?php


namespace Itp\API;


class FlickrSearch {

    public $tag;

    public function __construct($tag){
        $this->tag = $tag;
    }

    public function getResults(){
        $endpoint = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=084474c4a75ff5137f816739c3e991e2&';
        $endpoint .= 'text='.$this->tag;
        $endpoint .= '&tag='.$this->tag;
        $endpoint .= '&format=json&nojsoncallback=1';

       $json = file_get_contents($endpoint);
       return json_decode($json);
    }



    public static function validate(){
        $apiKey = "084474c4a75ff5137f816739c3e991e2";
        $secret = "1d9ec2c62ac3667b";
        $perms = "write";

        $f = new phpFlickr($apiKey, $secret);

        //Redirect to flickr for authorization
        if(empty($_GET['frob'])){
            $f->auth($perms);
        }else {
            //If authorized, print the token
            $tokenArgs = $f->auth_getToken($_GET['frob']);
            echo "<pre>"; var_dump($tokenArgs); echo "</pre>";
        }
    }

    public static function findUploaded($id){

       $endpoint = "https://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=084474c4a75ff5137f816739c3e991e2&photo_id=".$id."&format=json&nojsoncallback=1";
       $json = file_get_contents($endpoint);
       return json_decode($json);


    }

    function uploadPhoto($path, $title) {
        $apiKey = "084474c4a75ff5137f816739c3e991e2";
        $apiSecret = "1d9ec2c62ac3667b";
        $permissions  = "write";
        $token        = "72157643659340655-b649e2fe19adeb9a";

        $f = new phpFlickr($apiKey, $apiSecret, true);
        $f->setToken($token);
        return $f->sync_upload($path, $title);
    }

    public function upload(){
        $error=0;
        $f = null;
        if($_POST){
            /* Check if both name and file are filled in */
            if(!$_POST['name'] || !$_FILES["file"]["name"]){
                $error=1;
            }else{
                /* Check if there is no file upload error */
                if ($_FILES["file"]["error"] > 0){
                    echo "Error: " . $_FILES["file"]["error"] . "<br />";
                }else if($_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/png" && $_FILES["file"]["type"] != "image/gif"){
                    /* Filter all bad file types */
                    $error = 3;
                }else if(intval($_FILES["file"]["size"]) > 2097152){
                    /* Filter all files greater than 512 KB */
                    $error = 4;
                }else{
                    $dir= dirname($_FILES["file"]["tmp_name"]);
                    $newpath=$dir."/".$_FILES["file"]["name"];
                    rename($_FILES["file"]["tmp_name"],$newpath);
                    /* Call uploadPhoto on success to upload photo to flickr */
                    $status = $this->uploadPhoto($newpath, $_POST["name"]);
                    return $status;
                    if(!$status) {
                        $error = 2;
                    }
                }
            }
        }
        return $error;

    }


}