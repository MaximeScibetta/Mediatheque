
<div class="inscription">
    <h1>Ajouter un nouveau label</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <fieldset style="display:block";>
            <label for="labelName">Nom du label</label>
            <input type="text" id="labelName" name="labelName" value="<?php if(isset($_POST['postLabel'])){
                echo $_POST['labelName'] ;
            };?>">
            <?php if( isset($data['errors']['labelName']) ) : ?>
                <div class="error">
                    <?= $data['errors']['labelName'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <label for="labelDirector">Fondateur du label</label>
            <input type="text" id="labelDirector" name="labelDirector" value="<?php if(isset($_POST['postLabel'])){
                echo $_POST['labelDirector'] ;
            };?>">

            <?php if( isset($data['errors']['labelDirector']) ) : ?>
                <div class="error">
                    <?= $data['errors']['labelDirector'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <label for="labelBio">Biographie du label</label>
            <textarea name="labelBio" id="labelBio" cols="30" rows="10" placeholder="Écrivez la biographie de l'artiste"><?php if(isset($_POST['postLabel'])){echo $_POST['labelBio'] ;};?></textarea>
            <?php if( isset($data['errors']['labelBio']) ) : ?>
                <div class="error">
                    <?= $data['errors']['labelBio'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset style="display:block";>
            <label for="labelImg">Photo du label</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <input type="file" name="labelImg">
            <?php if( isset($data['errors']['labelImg']) ) : ?>
                <div class="error">
                    <?= $data['errors']['labelImg'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>



        <fieldset style="display:block";>
            <input type="submit" id="postLabel" name="postLabel" value="Ajouter l'artiste">

            <input type="hidden"
                   name="a"
                   value="postNewLabel">
            <input type="hidden"
                   name="r"
                   value="label">
        </fieldset>
    </form>
</div>
