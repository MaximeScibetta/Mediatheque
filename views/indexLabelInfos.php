
<section class="label_info">
    <img src="<?= $data['labelInfos']->labelImg ?>" alt="Logo du label <?= $data['labelInfos']->labelName; ?>">
    <div>
        <h2><?= $data['labelInfos']->labelName ?>, <span>fondé par <?= $data['labelInfos']->labelDirector ?></span></h2>
        <p><?= $data['labelInfos']->labelDescription ?></p>
    </div>
    <ul class="container">
        <h3>Les artistes du label</h3>
        <?php include('views/partials/_artists.php');  ?>
    </ul>
    <ul class="container">
        <h3>Les albums du label</h3>
        <?php include('views/partials/_albums.php');  ?>
    </ul>
</section>
</article>