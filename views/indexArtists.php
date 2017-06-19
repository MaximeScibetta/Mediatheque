    <section>
        <h2 class="visuallyhidden">Tous les artistes</h2>
        <?php if( isset($data['success']['addArtist']) ) : ?>
            <div class="success">
                <?= $data['success']['addArtist'] ;?>
            </div>
        <?php endif ;?>
        <ul class="container">
            <?php
                if($data['artists']){
                    include('views/partials/_artists.php');
                }
            ?>
        </ul>
    </section>
</article>