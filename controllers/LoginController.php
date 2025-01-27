<?php


namespace Controllers;

use Models\ActiveDirectory;
use MVC\Router;


use Google_Client;
use Google_Service_Oauth2;
use Models\Inventory;
use Models\Users;

class LoginController{
    
    public static function login(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $ad = new ActiveDirectory($_POST);

            $auth = $ad->auth();

            if (!$_POST["user"] || !$_POST["password"]) {
                header("Location: /login?error=1");
            }
            else{

                $adData = $ad->consultData();
                $userData = Inventory::filter("usuarioPC","=",$_POST["user"]);
                $userData=array_shift($userData);

                $userRole = array_shift(Users::filter("ad_user","=",$_POST["user"]));

                if($auth){
                    $_SESSION["login"]=true;
                    $_SESSION["log_type"] = "user";
                    $_SESSION["username"] = $_POST["user"];
                    $_SESSION["name"] = (!empty($adData))? $adData["displayname"] :$userData->nombre . " " . $userData->apellido ;
                    $_SESSION["charge"] = $userRole->area;
                    $_SESSION["role"] = $userRole->role??"USER";

                    header("Location: /");
                }else{
                    header("Location: /login?error=2");
                    
                }

            }




        }
        $router->render("login");
    }


    public static function logout(){

        session_start();

        $_SESSION = [];

        header("Location: /login");


    }

    public static function redirect(){
        // init configuration 
        $clientID = '955799568045-v3rim16b2uh01eop27g5a1v2dk73umnu.apps.googleusercontent.com';
        $clientSecret = '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';
        $redirectUri = 'https://' . $_SERVER["HTTP_HOST"]. '/redirect';
        
        // create Client Request to access Google API 
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");
        // authenticate code from Google OAuth Flow 
        if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
        // get profile info 
    
        
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
        $picture =  $google_account_info->picture;
        

        if(is_null($_GET["hd"]) || !$_GET["hd"] === "asistentevirtualsas.com" ){
            header("Location : /login?error");
        }
        session_start();

        $userRole = array_shift(Users::filter("mail","=",$email));
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["picture"] = $picture;
        $_SESSION["log_type"] = "email";
        $_SESSION["login"] = true;
        $_SESSION["role"] = $userRole->role??"USER";
        

        header("Location: /");

        // now you can use this profile info to create account in your website and make user logged in. 
        } else {
            header("Location: " . $client->createAuthUrl());
        }


    }



}





?>