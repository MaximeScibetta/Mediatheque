<?php
namespace Controllers;

use Models\Auth as AuthModel;
use Models\Artist as ArtistModel;

class Auth
{

    private $authModel = null;
    private $artistsModel = null;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->artistsModel = new ArtistModel();
    }

    public function getLogin()
    {
        if( isset($_SESSION['user']) ){
            header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=getAllArtists&r=artist');
        }
        return ['view' => 'views/userLogin.php'];
    }

    public function postLogin()
    {
        $errors = [];
        $password = sha1($_POST['password']);
        $email = $_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && $this->authModel->checkUser($email, $password)){
            $user = $this->authModel->checkUser($email, $password);
            $_SESSION['user'] = $user;
            if(empty($artists)){
                $artists = $this->artistsModel->indexAllArtists();
            }
            $view = 'views/indexArtists.php';
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors = [
                    'email' => $email . ' semble ne pas être un email valide.',
                ];
            }else{
                $errors = [
                    'password' => 'Il semblerait que vous vous êtes trompez de mot de passe.',
                ];
            }
            $view = 'views/userLogin.php';
        }
        return compact('view', 'artists', 'errors');
    }

    public function getLogout()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location:http://homestead.app'.$_SERVER['PHP_SELF']);
        exit;
    }

    public function getInscription()
    {
        if( isset($_SESSION['user']) ){
            header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=getAllArtists&r=artist');
        }
        return ['view' => 'views/userInscription.php'];
    }

    public function postInscription()
    {
        if( isset($_POST['confirm']) ){
            $errors = [];
            if( !empty($_POST['first_name']) ){
                $firstName = $_POST['first_name'];
            } else{
                $errors['first_name'] = 'Il semblerait que vous ayez oublié de rentrer votre prénom.';

            }

            if( !empty($_POST['last_name']) ){
                $lastName = $_POST['last_name'];
            } else{
                $errors['last_name'] = 'Il semblerait que vous ayez oublié de rentrer votre prénom.';
            }

            if( !empty($_POST['email']) ){
                if( filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) ){
                    if( $_POST['email'] == $_POST['confirm_email'] ){
                        $email = $_POST['confirm_email'];
                    }else{
                        $errors = [
                            'email' => 'Il semblerait que les emails ne soient pas identique, vérifiez avant de recommencer.',
                        ];
                    }
                } else{
                    $errors['email'] = 'Il semblerait que '. $_POST['email'].' ne soit pas un email valide.';
                }
            }else{
                $errors['email'] = 'Il semblerait que vous n\'ayez pas rentré votre email.';
            }

            if( !empty($_POST['password'])){
                if( $_POST['password'] == $_POST['confirm_password'] ){
                    $password =  sha1($_POST['confirm_password']);
                }else{
                    $errors['password'] = 'Il semblerait que les mots de passe ne soient pas identique, vérifiez avant de recommencer.';
                }
            }else{
                $errors['password'] =  'Il semblerait que vous n\'ayez pas rentré de mot de passe';
            }
            if( isset($firstName) && isset($lastName) && isset($email) && isset($password)){
                $id = uniqid();
                $favoritesArray = [
                    'albums' => [],
                    'labels' => [],
                    'artists' => []
                ];
                $favorites = json_encode($favoritesArray);
                $this->authModel->inscription($id, $firstName, $lastName, $email, $password, $favorites);
                $view = 'views/userLogin.php';
                $success['inscription'] = 'Vous vous êtes bien inscrit. Connectez-vous !';
            }else{
                $view = 'views/userInscription.php';
            }
            return compact('view', 'errors' );
        }
    }

    public function postGuestUser()
    {
        if(empty($artists)){
                $artists = $this->artistsModel->indexAllArtists();
            }
            $view = 'views/indexArtists.php';
            return compact('artists', 'view');
    }
}