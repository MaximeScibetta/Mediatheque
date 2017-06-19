
<section>
    <img src="<?= $data['albumInfos']->albumImg; ?>" alt="Photo de la cover de l'album <?= $data['albumInfos']->albumName; ?> de <?= $data['albumInfos']->albumArtist; ?>">
    <h2><?= $data['albumInfos']->albumName; ?> de <?= $data['albumInfos']->albumArtist; ?> sur le label <?= $data['albumInfos']->albumLabel; ?></h2>
    <?php foreach ( $data['albumMusic'] as $music ): ?>
    <dl class="music">
        <dt class="visuallyhidden" >n°</dt>
        <dd class="number"><?= $music->id; ;?></dd>
        <dt class="visuallyhidden" >Titre</dt>
        <dd class="title"><?= $music->title; ;?></dd>
        <?php if(isset($music->feat) && $music->feat[0] != "") :?>
           <div>
                <dt class="feat">Featuring :</dt>
                <?php foreach ( $music->feat as $featuring ): ?>
                <dt class="feat"><?= $featuring ;?></dt>
                <?php endforeach; ?>
           </div>
        <?php endif; ?>
    </dl>
    <?php endforeach; ?>
</section>
</article>