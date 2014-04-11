<?php

class FlickrController extends BaseController {


    public function search(){
        return View::make("flickr/search", [
        ]);
    }

    public function getResults(){
        $results = Cache::get('flickr-itp');

        if(!$results){
            $tag = Input::get('tag');
            $text = urlencode($tag);
            $flickr = new \Itp\API\FlickrSearch($text);
            $json = $flickr->getResults();
            $results = $json->photos->photo;

            Cache::put('flickr-itp', $results, .02);

        }

        //var_dump($results);

        return View::make("flickr/results", [
            'results' => $results
        ]);
    }

    public function validate(){
        \Itp\API\FlickrSearch::validate();
    }

    public function upload(){
        $flickr = new \Itp\API\FlickrSearch(null);
        $id = $flickr->upload();

        $uploaded = null;
        if($id != 1 && $id != 2 && $id != 3 && $id != 4 && !$_FILES['file']['error']) {
            $xml = simplexml_load_string($id);
            $photoid = $xml->photoid;
            $uploaded = \Itp\API\FlickrSearch::findUploaded($photoid);
            $info = $uploaded->photo;
            $url = "'http://farm".$info->farm.".staticflickr.com/".$info->server."/".$info->id."_".$info->secret.".jpg'";
            return View::make("flickr/uploaded", [
                'error' => $photoid,
                'uploaded' => $uploaded,
                'url' => $url
            ]);

        }
        if ($_FILES['file']['error']){
            $uploaded = $_FILES['file']['error'];
        }
        return View::make("flickr/uploaded", [
            'error' => $id,
            'uploaded' => $uploaded
        ]);

    }


}