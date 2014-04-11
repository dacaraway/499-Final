<?php
/**
 * Created by PhpStorm.
 * User: Daria
 * Date: 4/7/14
 * Time: 5:52 PM
 */

use \Symfony\Component\HttpFoundation\Session\Session;
use \Symfony\Component\HttpFoundation\RedirectResponse;


class DBController extends BaseController {

    public function insert(){
        $session = new Session();
        $id = $session->get('id');
        $url = Input::get('url');
        $desc = Input::get('desc');
        $category = Input::get('category');

        Database::insert($url,$category, $id, $desc);

        $session->getFlashBag()->set('statusMessage', 'Item Pinned!');
        $redirect = '/mypins/get/5';
        $response = new RedirectResponse($redirect);
        return $response->send();


    }
    public function deletePin(){
        $session = new Session();
        $id = $session->get('id');
        $url = Input::get('url');
        $category = Input::get('cat');
        Database::delete($url,$category, $id);

        $session->getFlashBag()->set('statusMessage', 'Pin Removed!');

        $redirect = '/mypins/get/5';
        $response = new RedirectResponse($redirect);
        return $response->send();
    }


}
