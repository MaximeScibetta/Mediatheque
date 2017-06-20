<?php

namespace Controllers;

use Models\Artist as ArtistModel;
use Models\Album as AlbumModel;
use Models\Label as LabelModel;

class Artist
{
    private $artistModel = null;
    private $albumModel = null;
    private $labelModel = null;

    public function __construct()
    {
        $this->artistModel = new ArtistModel();
        $this->albumModel = new AlbumModel();
        $this->labelModel = new LabelModel();
    }

    public function getAllArtists()
    {
        if($this->artistModel->indexAllArtists()){
            $artists = $this->artistModel->indexAllArtists();
            $errors = [];
            $view = 'views/indexArtists.php';
        }else{
            die('Il semblerait qu\'il y ait eu un problème lors de la récupération des artistes');
        }
        return compact('view', 'artists','errors');
    }

    public function getInfos()
    {
        $this->checkLogin();
        if( isset($_GET['id']) ){
            $artistId = $_GET['id'];
            $artistInfos = $this->artistModel->indexArtistInfo($artistId);
            $artistAlbums = $this->albumModel->indexArtistAlbums($artistId);
            $errors = [];
            $view = 'views/indexArtistInfos.php';
        }
        return compact('view', 'artistInfos','artistAlbums','errors');
    }

    public function getAddArtist()
    {
        if( isset($_SESSION['user']) ){
            $labels = $this->labelModel->indexAllLabels();
            $view = 'views/addArtist.php';
        }
        return compact('view', 'labels');
    }

    public function postNewArtist()
    {
        if(isset($_POST['postArtist'])){
            if( !empty($_POST['artistName'])){
                $artistName = $_POST['artistName'];
            }else{
                $errors['artistName'] = 'Il semblerait que le nom de l\'artiste n\'est pas indiqué';
            }
            if( !empty($_POST['artistBio'])){
                $artistBio = $_POST['artistBio'];
            }else{
                $errors['artistBio'] = 'Il semblerait que la biographie n\'est pas indiqué';
            }

            if(isset($_FILES['artistImg'])) {
                if (!$_FILES['artistImg']['error']) {
                    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (in_array($_FILES['artistImg']['type'], $allowedTypes)) {
                        $typeParts = explode('/', $_FILES['artistImg']['type']);
                        $ext = '.' . $typeParts[count($typeParts) - 1];
                        $sourceFile = $_FILES['artistImg']['tmp_name'];
                        $destFile = './assets/images/' . time() . rand(1000, 9999) . $ext;
                        list($srcWidth, $srcHeight) = getimagesize($_FILES['artistImg']['tmp_name']);
                        $destWidth = $destHeight = 0;
                        $srcResource = imagecreatefromjpeg($_FILES['artistImg']['tmp_name']);

                        $desiredDestheight = 200;
                        $desiredDestWidth = 200;
                        $imgRatio = $desiredDestheight / $desiredDestWidth;
                        if (($srcHeight / $srcWidth) == $imgRatio) {
                            $destHeight = $desiredDestheight;
                            $destWidth = $desiredDestWidth;
                        } elseif (($srcHeight / $srcWidth) > $imgRatio) {
                            $destHeight = $desiredDestheight;
                            $destWidth = ($srcWidth / $srcHeight) * $desiredDestheight;
                        } elseif (($srcHeight / $srcWidth) < $imgRatio) {
                            $destHeight = ($srcHeight / $srcWidth) * $desiredDestWidth;
                            $destWidth = $desiredDestWidth;
                        }

                        $destResource = imagecreatetruecolor($destWidth, $destHeight);
                        imagecopyresampled($destResource, $srcResource,
                            0, 0, 0, 0,
                            $destWidth, $destHeight,
                            $srcWidth, $srcHeight
                        );
                        imagejpeg($destResource, $destFile, 100);
                        $artistImg = $destFile;
                    } else {
                        $errors['artistImg'] = 'Il semblerait que le type l\'image ajouter n\'aie pas le format adéquat, ré-essayer avec du .jpeg, .jpg ou .png';
                    }
                } else {
                    $errors['artistImg'] = 'Il semblerait que vous n\'aillez pas ajouté l\'image de l\'artists.';
                }
            }

            if( !empty($_POST['artistLabel'])){
                $artistLabel = $_POST['artistLabel'];
            }else{
                $errors['artistLabel'] = 'Il semblerait que le label n\'est pas indiqué';
            }
            if( isset($artistName) && isset($artistBio) && isset($artistImg) && isset($artistLabel) ){
                $this->artistModel->addNewArtist($artistName, $artistImg, $artistBio, $artistLabel);
                $view = 'views/indexArtists.php';
                $success['addArtist'] = 'L\'artists '.$artistName.' a bien été rajouté';
                $artists = $this->artistModel->indexAllArtists();
                return compact('view', 'success', 'artists');
            }else{
                $labels = $this->labelModel->indexAllLabels();
                $artists = $this->artistModel->indexAllArtists();
                $view = 'views/addArtist.php';
                return compact('view', 'errors', 'labels', 'artists');
            }
        }
    }
}