<?php
namespace Models;

use Models\Model as ModelModel;

class User
{

    private $modelModel = null;
    public function __construct()
    {
        $this->modelModel = new ModelModel();
    }

    public function addFavorites($userId, $favorites)
    {
        $pdo = $this->modelModel->connectDB();

        if($pdo){
            $sql = 'UPDATE mediatheque.users SET favorites = :favorites WHERE id = :userId';
            try {
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':favorites' => $favorites,
                    ':userId' => $userId,
                ]);
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé porblème lors de l\'ajout du favoris');
        }
    }

    public function indexFavorites($userId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT favorites FROM users WHERE users.id = :userId';
            try{
                $pdoSt = $pdo -> prepare($sql);
                $pdoSt->execute([
                    ':userId' => $userId,
                ]);
                return $pdoSt->fetch();
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose  a posé problèem lors de la récupération des favoris');
        }
    }
}