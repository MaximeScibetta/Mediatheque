<div class="inscription">
    <h1>Inscription.</h1>
    <form action="index.php" method="post">
        <fieldset>
            <label for="first_name">Votre prénom</label>
            <input type="text" id="first_name" name="first_name" value="<?php if(isset($_POST['confirm'])){
                echo $_POST['first_name'] ;
            };?>">
            <?php if( isset($data['errors']['first_name']) ) : ?>
                <div class="error">
                    <?= $data['errors']['first_name'] ;?>
                </div>
            <?php endif ;?>
            <label for="last_name">Votre nom</label>
            <input type="text" id="last_name" name="last_name" value="<?php if(isset($_POST['confirm'])){
                echo $_POST['last_name'] ;
            };?>">
            <?php if( isset($data['errors']['last_name']) ) : ?>
                <div class="error">
                    <?= $data['errors']['last_name'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset>
            <label for="email">Votre email</label>
            <input type="email" id="email" name="email" value="<?php if(isset($_POST['confirm'])){
                echo $_POST['email'] ;
            };?>">

            <label for="confirm_email">Confirmez votre email</label>
            <input type="email" id="confirm_email" name="confirm_email" value="<?php if(isset($_POST['confirm'])){
                echo $_POST['confirm_email'] ;
            };?>">

            <?php if( isset($data['errors']['email']) ) : ?>
                <div class="error">
                    <?= $data['errors']['email'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>

        <fieldset>
            <label for="password">Votre mot de passe</label>
            <input type="password" id="password" name="password" value="<?php if(isset($_POST['confirm'])){
                echo $_POST['password'] ;
            };?>">


            <label for="confirm_password">Confirmez votre mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password"value="<?php if(isset($_POST['confirm'])){
                echo $_POST['confirm_password'] ;
            };?>">
            <?php if( isset($data['errors']['password']) ) : ?>
                <div class="error">
                    <?= $data['errors']['password'] ;?>
                </div>
            <?php endif ;?>
        </fieldset>
        <input type="submit" id="confirm" name="confirm" value="Confirmez ">

        <input type="hidden"
               name="a"
               value="postInscription">
        <input type="hidden"
               name="r"
               value="auth">
    </form>


</div>