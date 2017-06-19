<?php

namespace Controllers;

use Models\Album as AlbumModel;
use Models\Label as LabelModel;
use Models\Artist as ArtistModel;

class Album extends Controller
{
    private $albumModel = null;
    private $labelModel = null;
    private $artistModel = null;

    public function __construct()
    {
        $this->albumModel = new AlbumModel();
        $this->labelModel = new LabelModel();
        $this->artistModel = new ArtistModel();
    }

    public function getAllAlbums()
    {
        $this->checkLogin();
        if( $this->albumModel->indexAllAlbums() ){
            $albums = $this->albumModel->indexAllAlbums();
            $errors = [];
            $view = 'views/indexAlbums.php';
        }else{
            die('Il semblerait qu\'il y ait eu un problème lors de la récupération des labels.');
        }
        return compact('view', 'albums', 'errors');
    }

    public function getInfos()
    {
        $this->checkLogin();
        if( isset($_GET['id']) ){
            $albumId = $_GET['id'];
            $albumInfos = $this->albumModel->indexAlbumInfo($albumId);
            $albumMusic = json_decode($albumInfos->albumMusic);
            $errors =[];
            $view = 'views/indexAlbumInfos.php';
        }
        return compact('view', 'albumInfos', 'albumMusic', 'errors');
    }

    public function getAddAlbum()
    {
        $this->checkLogin();
        if( isset($_SESSION['user']) ){
            $labels = $this->labelModel->indexAllLabels();
            $artists = $this->artistModel->indexAllArtists();
            $view = 'views/addAlbum.php';
        }
        return compact('view', 'labels', 'artists');
    }
    public function addMusic()
    {
        $this->checkLogin();
        if( isset($_GET['addMusic']) ){
            $labels = $this->labelModel->indexAllLabels();
            $artists = $this->artistModel->indexAllArtists();
            $addMusicNumber = $_GET['numberMusic'];
            $_SESSION['nbrMusic'] = $_GET['numberMusic'];
            $view = 'views/addAlbum.php';
        }
        return compact('view', 'labels', 'artists', 'addMusicNumber');
    }

    public function postNewAlbum()
    {
        if( !empty($_POST['albumName']) ){
                $albumTitle = $_POST['albumName'];
            } else{
                $errors['albumName'] = 'Il semblerait que le nom de l\'album n\'est pas indiqué';
            }

            if( isset($_FILES['albumImg']) ){
                if(!$_FILES['albumImg']['error']) {
                    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (in_array($_FILES['albumImg']['type'], $allowedTypes)) {
                        $typeParts = explode('/', $_FILES['albumImg']['type']);
                        $ext = '.' . $typeParts[count($typeParts) - 1];
                        $sourceFile = $_FILES['albumImg']['tmp_name'];
                        $destFile = './assets/images/' . time() . rand(1000, 9999) . $ext;
                        list($srcWidth, $srcHeight) = getimagesize($_FILES['albumImg']['tmp_name']);
                        $destWidth = $destHeight = 0;
                        $srcResource = imagecreatefromjpeg($_FILES['albumImg']['tmp_name']);

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
                        $albumImg = $destFile;
                        var_dump($albumImg);
                    } else{
                        $errors['albumImg'] = 'Il semblerait que le type l\'image ajouter n\'aie pas le format adéquat, ré-essayer avec du .jpeg, .jpg ou .png';
                    }
                }else{
                    $errors['albumImg'] = 'Il semblerait que vous n\'aillez pas ajouté l\'image de l\'album.';
                }
            }

            if( !empty($_POST['albumLabel'])){
                $albumLabel = $_POST['albumLabel'];
            }else{
                $errors['albumLabel'] = 'Il semblerait que le label n\'est pas indiqué';
            }

            if ( isset($_SESSION['nbrMusic'])){
                $albumMusic = array();
                for($i=1; $_SESSION['nbrMusic'] >= $i; $i++){
                    if( !empty($_POST['musicTitle'.$i]) ){
                        $music = [
                            'id' => $_POST['id'.$i],
                            'title' => $_POST['musicTitle'.$i],
                            'feat' =>
                                explode( ',',$_POST['featName' . $i])
                            ,
                        ];
                        array_push( $albumMusic, $music );
                    }else{
                        $errors['musicTitle'.$i] = 'Il semblerait que le label n\'est pas indiqué pour la musique numéro '.$i;
                    }
                    $album = json_encode($albumMusic, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |JSON_NUMERIC_CHECK);
                }
            }else{
                $errors['numberMusic'] = 'Il semblerait que vous n\'aillez pas indiqué pour le nombre de musique sur l\'album';
            }

            if( !empty($_POST['albumArtist'])){
                $albumArtist = $_POST['albumArtist'];
            }else{
                $errors['albumArtist'] = 'Il semblerait que le l\'artiste n\'est pas indiqué';
            }

            if( isset($albumTitle) && isset($albumImg) && isset($albumLabel) && isset($album) && isset($albumArtist) ){
                $this->albumModel->addNewAlbum($albumTitle, $albumImg, $album, $albumArtist, $albumLabel);
                $view = 'views/indexAlbums.php';
                $success['addAlbum'] = 'L\'album '.$albumTitle.' a bien été rajouté';
                $_SESSION['nbrMusic'] = null;
                $albums = $this->albumModel->indexAllAlbums();
                return compact('view', 'success', 'albums');
            }else{
                $labels = $this->labelModel->indexAllLabels();
                $artists = $this->artistModel->indexAllArtists();
                $view = 'views/addAlbum.php';
                return compact('view', 'errors', 'labels', 'artists');
            }
        }

}