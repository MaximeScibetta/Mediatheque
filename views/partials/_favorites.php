<?php if( isset($data['favorites']) ) :?>
    <?php if( isset($data['favorites']['albums']) ) :?>
    <ul class="container">
        <h2>Mes albums favoris</h2>
        <?php if( isset($data['albums']) ):?>
            <?php foreach ( $data['albums'] as $album ):?>
                <li class="container__item">
                    <img src="<?= $album->albumImg; ?>" alt="Photo de la cover de l'album <?= $album->albumName; ?> de <?= $album->artistAlbum; ?>">
                    <div>
                        <h3 class="name"><?= $album->albumName ;?></h3>
                        <form action="index.php" method="get">
                            <input type="hidden"
                                name="a"
                                value="getInfos">
                            <input type="hidden"
                                name="r"
                                value="artist">
                            <input type="hidden"
                                name="id"
                                value="<?= $album->artistId;?>">
                            <button class="artist"><?= $album->artistAlbum;?></button>
                        </form>
                        <form action="index.php" method="get">
                            <input type="hidden"
                                name="a"
                                value="getInfos">
                            <input type="hidden"
                                name="r"
                                value="label">
                            <input type="hidden"
                                name="id"
                                value="<?= $album->labelId;?>">
                            <button class="label"><?= $album->albumLabel;?></button>
                        </form>
                        <form action="index.php" method="get">
                            <input type="hidden"
                                name="a"
                                value="getInfos">
                            <input type="hidden"
                                name="r"
                                value="album">
                            <input type="hidden"
                                name="id"
                                value="<?= $album->albumId;?>">
                            <button class="more">En savoir plus</button>
                        </form>
                        <?php include('_removeAlbumFavorites.php');?>
                    </div>
                </li>
             <?php endforeach;?>
         <?php endif;?>
    </ul>
    <?php endif;?>

    <?php if( isset($data['favorites']['labels']) ) :?>
        <ul class="container">
            <h2>Mes labels favoris</h2>
            <?php if( isset($data['labels']) ):?>
                <?php foreach ( $data['labels'] as $label ):?>
                    <li class="container__item">
                        <img src="<?= $label->img; ?>" alt="Logo du label <?= $label->name; ?>">
                        <div>
                            <h3 class="name"><?= $label->name ;?>, <span>fondé par <?= $label->director ;?></span> </h3>
                            <form action="index.php" method="get">
                                <button type="submit" class="more">En savoir plus</button>
                                <input type="hidden"
                                    name="a"
                                    value="getInfos">
                                <input type="hidden"
                                    name="r"
                                    value="label">
                                <input type="hidden"
                                    name="id"
                                    value="<?= $label->id ;?>">
                            </form>
                            <?php include('_removeLabelFavorites.php');?>
                        </div>
                    </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
    <?php endif;?>

    <?php if( isset($data['favorites']['artists']) ) :?>
        <ul class="container">
            <h2>Mes artistes favoris</h2>
            <?php if( isset($data['artists']) ):?>
                <?php foreach ( $data['artists'] as $artist ):?>
                    <li class="container__item">
                        <img src="<?= $artist->artistImg; ?>" alt="Photo portrait de l'artiste <?= $artist->artistName; ?>">
                      <div>
                            <form action="index.php" method="get">
                                <input type="hidden"
                                    name="a"
                                    value="getInfos">
                                <input type="hidden"
                                    name="r"
                                    value="artist">
                                <input type="hidden"
                                    name="id"
                                    value="<?= $artist->artistId;?>">
                                <button class="artist"><?= $artist->artistName ;?></button>
                            </form>
                            <?php include('_removeArtistFavorites.php') ;?>
                      </div>
                    </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
    <?php endif;?>
<?php endif;?>