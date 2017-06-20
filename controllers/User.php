<?php

namespace Controllers;

use Models\User as UserModel;
use Models\Album as AlbumModel;
use Models\Artist as ArtistModel;
use Models\Label as LabelModel;

class User 
{
    private $userModel = null;
    private $albumModel = null;
    private $artistModel = null;
    private $labelModel = null;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->albumModel = new AlbumModel();
        $this->artistModel = new ArtistModel();
        $this->labelModel = new LabelModel();
    }

    public function getFavorites()
    {
        $userId = $_SESSION['user']->id;
        $favoritesJSON = $this->userModel->indexFavorites($userId);
        $favorites = json_decode($favoritesJSON->favorites, true);
        if(!empty($favorites['albums'])) {
            $albums = array();
            foreach ($favorites['albums'] as $albumId){
                array_push( $albums, $this->albumModel->indexFavoritesAlbum($albumId));
            }
        }

        if(!empty($favorites['labels'])) {
            $labels = array();
            foreach ($favorites['labels'] as $labelId){
                array_push( $labels, $this->labelModel->indexFavoritesLabel($labelId));
            }
        }

        if(!empty($favorites['artists'])) {
            $artists = array();
            foreach ($favorites['artists'] as $artistId){
                array_push( $artists, $this->artistModel->indexFavoritesArtist($artistId));
            }
        }
        $view = 'views/indexFavorites.php';

        return compact('view', 'favorites' , 'albums', 'labels', 'artists');
    }

    public function postFavorites()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $userId = $_SESSION['user']->id;
        $favoritesJSON = $this->userModel->indexFavorites($userId);
        $favoritesArray = json_decode($favoritesJSON->favorites, true);
        if(!array_search($id, $favoritesArray[$type])){
            array_push( $favoritesArray[$type], $id );
        }
        $favorites = json_encode($favoritesArray);
        $this->userModel->addFavorites($userId, $favorites);

        return $this->getFavorites();

    }

    public function deleteFavorites()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $userId = $_SESSION['user']->id;
        $favoritesJSON = $this->userModel->indexFavorites($userId);
        $favoritesArray = json_decode($favoritesJSON->favorites, true);
        $indexDeleted = array_search($id, $favoritesArray[$type]);
        unset($favoritesArray[$type][$indexDeleted]);
        $favorites = json_encode($favoritesArray);
        $this->userModel->addFavorites($userId, $favorites);

        return $this->getFavorites();
    }

}