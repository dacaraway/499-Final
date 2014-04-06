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
            $flickr = new \Itp\API\FlickrSearch($tag,[
                'api_key' => Config::get('flickr.api_key')
            ]);
            $json = $flickr->getResults();
            $results = $json->photos->photo;

            Cache::put('flickr-itp', $results, .02);

        }

        //var_dump($results);

        return View::make("flickr/results", [
            'results' => $results
        ]);
    }
} 