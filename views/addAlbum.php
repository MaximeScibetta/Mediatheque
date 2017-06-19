
<div class="inscription">
    <h1>Ajouter un nouvel album</h1>
    <form action="index.php" method="get">
        <fieldset style="display:block";>
            <label for="numberMusic">Ajouter le nombre de musique souhaité</label>
            <input type="number" id="numberMusic" name="numberMusic"  value="<?php if(isset($_POST['postNewAlbum']) || isset($_GET['addMusic'])){
                echo $_SESSION['nbrMusic'] ;
            };?>">
            <input type="submit" id="addMusic" name="addMusic" value="Ajouter les musiques">

            <input type="hidden"
                   name="a"
                   value="addMusic">
            <input type="hidden"
                   name="r"
                   value="album">
            <?php if( isset($data['errors']['numberMusic']) ) : ?>
                <div class="error">
                    <?= $data['errors']['numberMusic'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>
    </form>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <?php if( isset($_SESSION['nbrMusic']) ) :?>
            <?php include('partials/_addMusic.php'); ?>
        <?php endif;?>
        <fieldset style="display:block";>
            <label for="albumName">Nom de l'album</label>
            <input type="text" id="albumName" name="albumName" value="<?php if(isset($_POST['postNewAlbum'])) { echo $_POST['albumName'];} ;?>">
            <?php if( isset($data['errors']['albumName']) ) : ?>
            <div class="error">
                <?= $data['errors']['albumName'] ;?>
            </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>

            <label for="albumImg">Photo de l'album</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <input type="file" name="albumImg">
            <?php if( isset($data['errors']['albumImg']) ) : ?>
                <div class="error">
                    <?= $data['errors']['albumImg'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <label for="albumLabel">Label de l'album</label>
            <select name="albumLabel" id="albumLabel">
                <?php if(isset($_POST['postNewAlbum'])){
                    echo '<option value="'.$_POST['albumLabel'].'"></option>';
                }else{
                    echo '<option value=""></option>';
                };
                ?>
                <?php foreach ($data['labels'] as $label):?>
                    <option value="<?= $label->id; ?>"><?= $label->name; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if( isset($data['errors']['albumLabel']) ) : ?>
                <div class="error">
                    <?= $data['errors']['albumLabel'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <label for="albumArtist">Artist qui a réalisé l'album</label>
            <select name="albumArtist" id="albumArtist">
                <?php if(isset($_POST['postNewAlbum'])){
                    echo '<option value="'.$_POST['albumArtist'].'"></option>';
                }else{
                    echo '<option value=""></option>';
                };
                ?>
                <?php foreach ($data['artists'] as $artist):?>
                    <option value="<?= $artist->artistId; ?>"><?= $artist->artistName; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if( isset($data['errors']['albumArtist']) ) : ?>
                <div class="error">
                    <?= $data['errors']['albumArtist'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>
        <fieldset style="display:block";>
            <input type="submit" id="postNewAlbum" name="postNewAlbum" value="Ajouter l'album">

            <input type="hidden"
                   name="a"
                   value="postNewAlbum">
            <input type="hidden"
                   name="r"
                   value="album">
        </fieldset>

    </form>

</div>
