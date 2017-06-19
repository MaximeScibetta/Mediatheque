<?php if( isset($data['artists']) ): ?>
    <?php foreach ( $data['artists'] as $artist ): ?>
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
                <?php include('_addArtistFavorites.php') ;?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
<?php if( isset($data['labelArtists']) ):?>
    <?php foreach ( $data['labelArtists'] as $artist ): ?>
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
                <?php include('_addArtistFavorites.php') ;?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
