<?php for($i=1; $_SESSION['nbrMusic'] >= $i; $i++) :?>
<fieldset>
    <legend style="display: block">Musique numéro <?= $i;?></legend>
    <label for="musicTitle<?= $i ;?>">Titre de la musique</label>
    <input type="text" name="musicTitle<?= $i ;?>" id="musicTitle<?= $i ;?>" value="<?php if(isset($_POST['postNewAlbum'])){
        echo $_POST['musicTitle'.$i] ;
    };?>">

    <label for="featName<?= $i ;?>">Nom des artistes présent sur la musique (séparé d'une virgule)</label>
    <input type="text" name="featName<?= $i ;?>" id="featName<?= $i ;?>" value="<?php if(isset($_POST['postNewAlbum'])){
        echo $_POST['featName'.$i] ;
    };?>">

    <input type="hidden" name="id<?= $i ;?>" value="<?= $i ;?>">
    <?php if( isset($data['errors']['musicTitle'.$i])  ) : ?>
        <div class="error">
            <?= $data['errors']['musicTitle'.$i] ;?>
        </div>
    <?php endif ;?>
</fieldset>
<?php endfor; ?>
