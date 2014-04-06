<?php


namespace Itp\API;


class FlickrSearch {

    public $tag;
    public function __construct($tag){
        $this->tag = $tag;
    }

    public function getResults(){
        $endpoint = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=c9a47e4f7820988abba5bd83283b1115&';
        $endpoint .= 'tags='.$this->tag;
        $endpoint .= '&format=json&nojsoncallback=1';

       $json = file_get_contents($endpoint);
       return json_decode($json);
    }


}