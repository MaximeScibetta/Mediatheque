<?php if( isset($data['albums']) ) :?>
    <?php foreach ( $data['albums'] as $album ): ?>
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
                <?php include('_addAlbumFavorites.php');?>
            </div>
        </li>
        <?php endforeach; ?>
<?php endif;?>
<?php if( isset($data['artistAlbums']) ) :?>
    <?php foreach ($data['artistAlbums'] as $album):?>
        <li class="container__item">
            <img src="<?= $album->albumImg;?>" alt="Photo de la cover de l\'album <?= $album->albumName ;?>">
            <div>
                <h3 class="name"><?= $album->albumName ;?></h3>
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
                <?php include('_addAlbumFavorites.php');?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
<?php if( isset($data['labelAlbums']) ) :?>
    <?php foreach ($data['labelAlbums'] as $album):?>
        <li class="container__item">
            <img src="<?= $album->albumImg;?>" alt="Photo de la cover de l\'album <?= $album->albumName ;?>">
            <div>
                <h3 class="name"><?= $album->albumName ;?></h3>
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
                <?php include('_addAlbumFavorites.php');?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
