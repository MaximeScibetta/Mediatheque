
<div class="inscription">
    <h1>Ajouter un nouvel artist</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <fieldset style="display:block";>
            <label for="artistName">Nom de l'artiste</label>
            <input type="text" id="artistName" name="artistName" value="<?php if(isset($_POST['postArtist'])){
                echo $_POST['artistName'] ;
            };?>">
            <?php if( isset($data['errors']['artistName']) ) : ?>
                <div class="error">
                    <?= $data['errors']['artistName'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

       <fieldset style="display:block";>
           <label for="artistBio">Biographie de l'artiste</label>
           <textarea name="artistBio" id="artistBio" cols="30" rows="10" placeholder="Écrivez la biographie de l'artiste"><?php if(isset($_POST['postArtist'])){echo $_POST['artistBio'] ;};?></textarea>
           <?php if( isset($data['errors']['artistBio']) ) : ?>
               <div class="error">
                   <?= $data['errors']['artistBio'] ;?>
               </div>
           <?php endif ;?>
       </fieldset>

        <fieldset style="display:block";>
            <label for="artistImg">Photo de l'artiste</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <input type="file" name="artistImg">
            <?php if( isset($data['errors']['artistImg']) ) : ?>
                <div class="error">
                    <?= $data['errors']['artistImg'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <label for="artistLabel">Label actuel de l'artist</label>
            <select name="artistLabel" id="artistLabel">
                <?php if(isset($_POST['postArtist'])){
                    echo '<option value="'.$_POST['artistLabel'].'"></option>';
                    }else{
                    echo '<option value=""></option>';
                };
                ?>

                <?php foreach ($data['labels'] as $label):?>
                    <option value="<?= $label->id; ?>"><?= $label->name; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if( isset($data['errors']['artistLabel']) ) : ?>
                <div class="error">
                    <?= $data['errors']['artistLabel'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <input type="submit" id="postArtist" name="postArtist" value="Ajouter l'artiste">

            <input type="hidden"
                   name="a"
                   value="postNewArtist">
            <input type="hidden"
                   name="r"
                   value="artist">
        </fieldset>
    </form>
</div>
