<?php

namespace Controllers;

use Models\Label as LabelModel;
use Models\Artist as ArtistModel;

class Label extends Controller
{
    private $labelModel = null;
    private $artistModel = null;
    public function __construct()
    {
        $this->labelModel = new LabelModel();
        $this->artistModel = new ArtistModel();
    }

    public function getAllLabels()
    {
        $this->checkLogin();
        if( $this->labelModel->indexAllLabels()){
            $labels = $this->labelModel->indexAllLabels();
            $errors = [];
            $view = 'views/indexLabels.php';
        }else{
            die('Il semblerait qu\'il y ait eu un problème lors de la récupération des labels.');
        }
        return compact('view', 'labels', 'errors');
    }

    public function getInfos()
    {
        $this->checkLogin();
        if( isset($_GET['id']) ){
            $labelId = $_GET['id'];
            $labelInfos = $this->labelModel->indexLabelInfo($labelId);
            $labelArtists = $this->artistModel->indexLabelArtists($labelId);
            $labelAlbums = $this->labelModel->indexLabelAlbums($labelId);
            $errors = [];
            $view = 'views/indexLabelInfos.php';
        }
        return compact('view', 'labelInfos', 'labelArtists', 'labelAlbums','errors');
    }

    public function getAddLabel()
    {
        if( isset($_SESSION['user']) ){
            $artists = $this->artistModel->indexAllArtists();
            $view = 'views/addLabel.php';
        }
        return compact('view', 'artists') ;
    }

    public function postNewLabel()
    {
        if(isset($_POST['postLabel'])){
            if( !empty($_POST['labelName'])){
                $labelName = $_POST['labelName'];
            }else{
                $errors['labelName'] = 'Il semblerait que le nom n est pas indiqué';
            }
            if( !empty($_POST['labelDirector'])){
                $labelDirector = $_POST['labelDirector'];
            }else{
                $errors['labelDirector'] = 'Il semblerait que le directeur du label n est pas indiqué';
            }
            if( !empty($_POST['labelBio'])){
                $labelBio = $_POST['labelBio'];
            }else{
                $errors['labelBio'] = 'Il semblerait que la biographie n est pas indiqué';
            }

            if(isset($_FILES['labelImg'])){
                if(!$_FILES['labelImg']['error']){
                    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if(in_array($_FILES['labelImg']['type'], $allowedTypes)){
                        $typeParts = explode('/', $_FILES['labelImg']['type']);
                        $ext = '.' . $typeParts[count($typeParts)-1];
                        $sourceFile  = $_FILES['labelImg']['tmp_name'];
                        $destFile = './assets/images/' . time() . rand(1000,9999) . $ext;
                        list($srcWidth, $srcHeight) = getimagesize($_FILES['labelImg']['tmp_name']);
                        $destWidth = $destHeight = 0;
                        $srcResource = imagecreatefromjpeg($_FILES['labelImg']['tmp_name']);

                        $desiredDestheight = 200;
                        $desiredDestWidth = 200;
                        $imgRatio = $desiredDestheight / $desiredDestWidth;
                        if ( ( $srcHeight / $srcWidth ) == $imgRatio ){
                            $destHeight = $desiredDestheight;
                            $destWidth = $desiredDestWidth;
                        }elseif (($srcHeight / $srcWidth ) > $imgRatio){
                            $destHeight = $desiredDestheight;
                            $destWidth = ($srcWidth / $srcHeight) * $desiredDestheight;
                        }elseif (($srcHeight / $srcWidth ) < $imgRatio){
                            $destHeight = ($srcHeight / $srcWidth) * $desiredDestWidth;
                            $destWidth = $desiredDestWidth;
                        }

                        $destResource = imagecreatetruecolor($destWidth, $destHeight);
                        imagecopyresampled( $destResource, $srcResource,
                            0, 0, 0, 0,
                            $destWidth, $destHeight,
                            $srcWidth, $srcHeight
                        );
                        imagejpeg($destResource, $destFile, 100);
                        $labelImg = $destFile;
                    }else{
                        $errors['labelImg'] = 'Il semblerait que le format de l\'image ne soit pas adéquat. Essayer avec du .jpeg, .jpg ou .png.';
                    }
                }else{
                    $errors['labelImg'] = 'Il semblerait que vous n\'aillez pas rajouter d\'image.';
                }
            }

            if( isset($labelName) && isset($labelBio) && isset($labelImg) && isset($labelDirector) ){
                $this->labelModel->addNewLabel($labelName, $labelImg, $labelDirector ,$labelBio);
                $view = 'views/indexLabels.php';
                $success['addLabel'] = 'Le label '.$labelName.' a bien été rajouté.';
                $labels = $this->labelModel->indexAllLabels();
                return compact('view', 'success', 'labels');
            }else{
                $view = 'views/addLabel.php';
                return compact('view', 'errors');
            }
        }
    }
}