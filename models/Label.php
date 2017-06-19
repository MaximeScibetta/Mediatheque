<?php

namespace Models;

use Models\Model as ModelModel;


class Label
{
    private $modelModel = null;
    public function __construct()
    {
        $this->modelModel = new ModelModel();
    }

    public function indexAllLabels()
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT labels.name, labels.img, labels.director, labels.id FROM labels';
            try{
                $pdoSt = $pdo->query($sql);
                return $pdoSt->fetchAll();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des labels');
        }
    }

    public function indexFavoritesLabel($labelId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT labels.img  ,
                           labels.name ,
                           labels.director ,
                           labels.description,
                           labels.id
                           FROM labels
                           WHERE id = :labelId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':labelId' => $labelId,
                ]);
                return $pdoSt->fetch();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des labels favoris');
        }
    }

    public function indexLabelInfo($labelId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT labels.img AS labelImg,
                           labels.name AS labelName,
                           labels.director AS labelDirector,
                           labels.description AS labelDescription
                           FROM labels
                           WHERE id = :labelId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    'labelId' => $labelId,
                ]);
                return $pdoSt->fetch();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupératation des informations du label');
        }
    }

    public function indexLabelAlbums($labelId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT albums.name AS albumName,
                           albums.img AS albumImg,
                           albums.id AS albumId,
                           albums.label_id AS labelId,
                           labels.name AS albumLabel,
                           artists.name as artistAlbum
                           FROM albums
                           LEFT JOIN artists ON albums.artist_id = artists.id
                           LEFT JOIN labels ON albums.label_id = labels.id
                           WHERE albums.label_id = :labelId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':labelId' => $labelId,
                ]);
                return $pdoSt->fetchAll();
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des albums du label');
        }
    }

    public function addNewLabel($labelName, $labelImg, $labelDirector, $labelBio)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'INSERT INTO labels(`name`, `img`, `director`, `description`)
                           VALUES (:labelName, :labelImg, :labelDirector, :labelBio)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                   ':labelName' => $labelName,
                    ':labelImg' => $labelImg,
                    ':labelDirector' => $labelDirector,
                    ':labelBio' => $labelBio
                ]);
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de l\'ajout du nouveau label');
        }
    }
}