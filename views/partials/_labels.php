<?php foreach ( $data['labels'] as $label ): ?>
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
            <?php include('_addLabelsFavorites.php') ;?>
        </div>
    </li>
<?php endforeach; ?>
