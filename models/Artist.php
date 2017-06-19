<?php

namespace Models;

use Models\Model as ModelModel;

class Artist
{

    private $modelModel = null;
    public function __construct()
    {
        $this->modelModel = new ModelModel();
    }

    public function indexAllArtists()
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT artists.name AS artistName,
                           artists.img AS artistImg,
                           artists.id AS artistId FROM artists';
            try{
                $pdoSt = $pdo->query($sql);
                return $pdoSt->fetchAll();
            }catch (PDOException $e){
                return '';
            }
        }else {
            die('Quelque chose a posé problème lors de la récupération des artistes');
        }
    }

    public function indexFavoritesArtist($artistId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT artists.name AS artistName,
                           artists.img AS artistImg,
                           artists.id AS artistId FROM artists
                           WHERE artists.id = :artistId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':artistId' => $artistId,
                ]);
                return $pdoSt->fetch();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des artistes favoris');
        }
    }

    public function indexArtistInfo($artistId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT artists.name AS artistName, 
                            artists.img AS artistImg,
                            artists.description AS artistDescription,
                            labels.id AS labelId,
                            labels.name AS artistLabel
                            FROM artists
                            LEFT JOIN labels ON artists.label_id = labels.id
                            WHERE artists.id = :artistId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt -> execute([
                   ':artistId' => $artistId,
                ]);
                return $pdoSt -> fetch();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des information de l\'artiste');
        }
    }

    public function indexLabelArtists($labelId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT artists.name AS artistName,
                           artists.img AS artistImg,
                           artists.id AS artistId
                           FROM artists
                           WHERE label_id = :labelId';
            try{
                $pdoSt = $pdo -> prepare($sql);
                $pdoSt -> execute([
                   ':labelId' => $labelId,
                ]);
                return $pdoSt -> fetchAll();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des artistes du label ');
        }
    }

    public function addNewArtist($artistName, $artistImg, $artistBio, $artistLabel)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'INSERT INTO mediatheque.artists(`name`, `img`, `description`, `label_id`)
                           VALUES (:artistName, :artistImg, :artistBio, :artistLabel)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':artistName' => $artistName,
                    ':artistImg' => $artistImg,
                    ':artistBio' => $artistBio,
                    ':artistLabel' => $artistLabel
                ]);
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de l\'ajout du nouvel artiste');
        }
    }

}