<?php

class Database{

    public static function validateUser($username, $password){
        $query = DB::table('users')
            ->select('username', 'password', 'id')
            ->where('username', '=', $username)
            ->where('password', '=', SHA1($password));

        return $query->get();
    }

    public static function insert($link,$category, $id, $desc){
        DB::table('pictures')
            ->insert(
                array(
                    'user_id' => $id,
                    'category_id' => $category,
                    'link' => $link,
                    'description' => $desc
                )
            );

    }
    public static function delete($link,$category, $id){
        DB::table('pictures')
            ->where('user_id', '=', $id)
            ->where('category_id', '=', $category)
            ->where('link', '=', $link)
            ->delete();



    }


    public static function newUser($username, $password, $email){
        $id =DB::table('users')
            ->insertGetId(
                array(
                    'username' => $username,
                    'email' => $email,
                    'password' => SHA1($password)
                )
            );
        return $id;


    }

    public static function validateSignin($input){
        return Validator::make($input, [
            'email' => 'required|email',
            'username' => 'required|alpha_num|min:4',
            'password' => 'required|alpha_num|min:6'
        ]);
    }

    public static function find($category, $id){
        if($category == 5){
            $query = DB::table('pictures')
                ->select('link', 'user_id', 'category_id', 'description')
                ->where('user_id', '=', $id);

            return $query->get();
        }

        $query = DB::table('pictures')
            ->select('link', 'category_id', 'user_id', 'description')
            ->where('user_id', '=', $id)
            ->where('category_id', '=', $category);

        return $query->get();

    }

    public static function getCat($cat){
        $query = DB::table('categories')
            ->select('id', 'category')
            ->where('id', '=', $cat);

        return $query->get();
    }

}