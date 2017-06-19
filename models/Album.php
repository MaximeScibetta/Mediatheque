<?php

namespace Models;

use Models\Model as ModelModel;

class Album
{
    private $modelModel = null;
    public function __construct()
    {
        $this->modelModel = new ModelModel();
    }

    public function indexAllAlbums()
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT albums.name AS albumName, 
                           albums.img AS albumImg,
                           albums.id AS albumId,
                           labels.id AS labelId,
                           labels.name AS albumLabel,
                           artists.name AS artistAlbum,
                           artists.id as artistId
                           FROM albums
                           LEFT JOIN artists ON albums.artist_id = artists.id
                           LEFT JOIN labels ON albums.label_id = labels.id';
            try{
                $pdoSt = $pdo->query($sql);
                return $pdoSt->fetchAll();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des albums');
        }
    }

    public function indexFavoritesAlbum($albumId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT albums.name AS albumName, 
                           albums.img AS albumImg,
                           albums.id AS albumId,
                           labels.id AS labelId,
                           labels.name AS albumLabel,
                           artists.name AS artistAlbum,
                           artists.id as artistId
                           FROM albums
                           LEFT JOIN artists ON albums.artist_id = artists.id
                           LEFT JOIN labels ON albums.label_id = labels.id
                           WHERE albums.id = :albumId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':albumId' => $albumId,
                ]);
                return $pdoSt->fetch();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des albums favoris');
        }
    }
    
    public function indexAlbumInfo($albumId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT albums.name AS albumName, 
                            labels.name AS albumLabel,
                            labels.id AS labelId,
                            albums.id AS albumId,
                            albums.img AS albumImg,
                            albums.music AS albumMusic, 
                            artists.name AS albumArtist
                            FROM albums
                            LEFT JOIN artists ON albums.artist_id = artists.id
                            LEFT JOIN labels ON albums.label_id = labels.id
                            WHERE albums.id = :albumId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt -> execute([
                   ':albumId' => $albumId,
                ]);
                return $pdoSt->fetch();
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des informations de l\'album');
        }
    }

    public function indexArtistAlbums($artistId)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'SELECT albums.name AS albumName,
                           albums.img AS albumImg,
                           albums.id AS albumId,
                           albums.label_id AS labelId,
                           labels.name AS albumLabel
                           FROM albums
                           LEFT JOIN labels ON albums.label_id = labels.id
                           LEFT JOIN artists ON albums.artist_id = artists.id
                           WHERE albums.artist_id = :artistId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':artistId' => $artistId,
                ]);
                return $pdoSt->fetchAll();
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de la récupération des albums de l\'artiste');
        }
    }

    public function addNewAlbum($albumTitle, $albumImg, $albumMusic, $albumArtist, $albumLabel)
    {
        $pdo = $this->modelModel->connectDB();
        if($pdo){
            $sql = 'INSERT INTO mediatheque.albums(`name`, `img`, `music`, `artist_id`, `label_id`)
                           VALUES (:title, :img, :music, :author, :label)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt ->execute([
                   ':title' => $albumTitle,
                    ':img' => $albumImg,
                    ':music' => $albumMusic,
                    ':author' => $albumArtist,
                    ':label' => $albumLabel,
                ]);
            }catch(PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé problème lors de l\'ajout du nouvel album');
        }
    }


}