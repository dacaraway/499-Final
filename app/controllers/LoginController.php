<?php

use \Symfony\Component\HttpFoundation\RedirectResponse;
use \Symfony\Component\HttpFoundation\Session\Session;
use \Carbon\Carbon;

class LoginController extends BaseController {

    public function validate(){
        $username = Input::get('username');
        $password = Input::get('password');

        $session = new Session();

        $valid = Database::validateUser($username, $password);

        if($valid){
            $session->set('username', $username);
            $session->set('id', $valid[0]->id);
            $time = Carbon:: now(new DateTimeZone('Europe/London'));
            $session->set('time', $time);
            $session->getFlashBag()->set('statusMessage', 'You have successfully logged in!');
            $response = new RedirectResponse('/dashboard');
            return $response->send();

        }

        else{
            $response = new RedirectResponse('/login');
            $session->set('status', 'badLogin');
            $session->getFlashBag()->set('statusMessage', 'Incorrect credentials');
            return $response->send();
        }

    }

    public function logout(){

        $session = new Session();
        $session-> clear();
        $response = new RedirectResponse('/login');
        return $response->send();
    }

    public function signUp(){
        $session = new Session();

        $username = Input::get('username');
        $email = Input::get('email');
        $password = Input::get('password');
        $password2 = Input::get('password2');

        if($password == $password2){
            $validation = Database::validateSignin(Input::all());
            if($validation->passes()){
                $id = Database::newUser($username,$password, $email);

                $session->set('username', $username);
                $session->set('id', $id);
                $time = Carbon:: now(new DateTimeZone('Europe/London'));
                $session->set('time', $time);
                $session->getFlashBag()->set('statusMessage', 'You have successfully signed up!  Start Pinning!');
                $response = new RedirectResponse('/dashboard');
                return $response->send();
            }
            else{
                $response = new RedirectResponse('/signUp');
                $session->set('status', 'badValidation');
                $errors = $validation->messages();
                $session->getFlashBag()->set('statusMessage', $errors->first());

                return $response->send();
            }




        }

        else{
            $response = new RedirectResponse('/signUp');
            $session->set('status', 'badSignin');
            $session->getFlashBag()->set('statusMessage', 'The password fields did not match');
            return $response->send();
        }




    }

}

