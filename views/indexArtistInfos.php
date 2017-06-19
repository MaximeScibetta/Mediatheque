
<section>
    <img src="<?= $data['artistInfos']->artistImg ?>" alt="Photo portrait de <?= $data['artistInfos']->artistName; ?>">
    <div>
        <h2><?= $data['artistInfos']->artistName ?></h2>
        <p><?= $data['artistInfos']->artistDescription ?></p>
    </div>
    <form action="index.php" method="get">
        <input type="hidden"
               name="a"
               value="getInfos">
        <input type="hidden"
               name="r"
               value="label">
        <input type="hidden"
               name="id"
               value="<?= $data['artistInfos']->labelId ?>">
        <button class="label"><?= $data['artistInfos']->artistLabel ?></button>
    </form>
    <ul class="container">
        <h3>Les albums de l'artiste</h3>
        <?php include('views/partials/_albums.php');  ?>
    </ul>

</section>
</article>