<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Médiathèque</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <header>
        <nav class="navigation">
            <div class="navigation__item">
                <form action="index.php" method="get">
                    <button type="submit" class="btn-nav">Albums</button>
                    <input type="hidden"
                            name="a"
                            value="getAllAlbums">
                    <input type="hidden"
                            name="r"
                            value="album">
                </form>
            </div>
            <div  class="navigation__item">
                <form action="index.php" method="get">
                    <button type="submit" class="btn-nav">Labels</button>
                    <input type="hidden"
                            name="a"
                            value="getAllLabels">
                    <input type="hidden"
                            name="r"
                            value="label">
                </form>
            </div>
            <div class="navigation__item">
                <form action="index.php" method="get">
                    <button type="submit" class="btn-nav">Artistes</button>
                    <input type="hidden"
                            name="a"
                            value="getAllArtists">
                    <input type="hidden"
                            name="r"
                            value="artist">
                </form>
            </div>
            <?php if(isset($_SESSION['user'])) :?>
                <div class="navigation__item">
                    <form action="index.php" method="get">
                        <button type="submit"  class="btn-nav">Favoris</button>
                        <input type="hidden"
                               name="a"
                               value="getFavorites">
                        <input type="hidden"
                               name="r"
                               value="user">
                    </form>
                </div>
                <ul class="disconnect">
                    <li>
                        <form action="index.php" method="get">
                            <button type="submit" class="btn-disconnect">Déconnexion</button>
                            <input type="hidden"
                                    name="a"
                                    value="getLogout">
                            <input type="hidden"
                                    name="r"
                                    value="auth">
                        </form>
                    </li>
                    <li>
                        <form action="index.php" method="get">
                            <button type="submit">Ajouter un artiste</button>
                            <input type="hidden"
                                    name="a"
                                    value="getAddArtist">
                            <input type="hidden"
                                    name="r"
                                    value="artist">
                        </form>
                        <form action="index.php" method="get">
                            <button type="submit" >Ajouter un label</button>
                            <input type="hidden"
                                    name="a"
                                    value="getAddLabel">
                            <input type="hidden"
                                    name="r"
                                    value="label">
                        </form>
                        <form action="index.php" method="get">
                            <button type="submit" >Ajouter un album</button>
                            <input type="hidden"
                                name="a"
                                value="getAddAlbum">
                            <input type="hidden"
                                name="r"
                                value="album">
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
            <?php if( !isset($_SESSION['user']) && ($data['view'] != 'views/userLogin.php' ) && ($data['view'] != 'views/userInscription.php') ) :?>
                <div class="navigation__item not_log">
                    <form action="index.php" method="get">
                    
                        <input type="submit" value="Connexion" class="btn-log">

                        <input type="hidden"
                                name="a"
                                value="getLogin">
                        <input type="hidden"
                                name="r"
                                value="auth">
                    </form>

                    <form actio="index.php" method="get">
                         <input type="submit" id="inscription" value="S'inscrire" class="btn-log">

                        <input type="hidden"
                                name="a"
                                value="getInscription">
                        <input type="hidden"
                                name="r"
                                value="auth">

                    </form>
                </div>
            <?php endif; ?>
        </nav>
        <h1>Médithèque
            <?php if( $data['view'] == 'views/indexAlbums.php' ) :?>
                <?= ' - tous les albums' ;?>
            <?php elseif( $data['view'] == 'views/indexArtists.php' ) :?>
                <?= ' - tous les artistes' ;?>
            <?php elseif( $data['view'] == 'views/indexLabels.php' ) :?>
                <?= ' - tous les labels' ;?>
            <?php elseif( $data['view'] == 'views/userLogin.php' ) :?>
                <?= ' - connexion' ;?>
            <?php elseif( $data['view'] == 'views/userInscription.php' ) :?>
                <?= ' - Inscription' ;?>
            <?php elseif( $data['view'] == 'views/indexFavorites.php' ) :?>
                <?= ' - tous mes favoris' ;?>
            <?php endif;?>    
        </h1>
    </header>
    <article>
    <?php include($data['view']);?>
</body>
</html>
