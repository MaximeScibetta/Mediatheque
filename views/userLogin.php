
    <div class="connexion">
        <h1>Connexion.</h1>
            <?php if( isset($data['success']['inscription']) ) : ?>
                <div class="success">
                    <?= $data['success']['inscription'] ;?>
                </div>
            <?php endif ;?>

            <form action="index.php" method="post">
                <label for="email">Votre email</label>
                <input type="email" id="email" name="email">
                <label for="password">Votre mot de passe</label>
                <input type="password" id="password" name="password">

                <input type="submit" value="Connexion ">

                <input type="hidden"
                       name="a"
                       value="postLogin">
                <input type="hidden"
                       name="r"
                       value="auth">
            </form>

            <form action="index.php" method="get">

            <input type="submit" id="inscription" value="S'inscrire ">

            <input type="hidden"
                   name="a"
                   value="getInscription">
            <input type="hidden"
                   name="r"
                   value="auth">


        </form>

            <form action="index.php" method="post">
            <input type="submit" id="spend" value="Passer">
            <input type="hidden"
                   name="a"
                   value="postGuestUser">
            <input type="hidden"
                   name="r"
                   value="auth">
        </form>

    </div>
