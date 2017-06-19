    <section>
        <h2 class="visuallyhidden">Tous les albums</h2>
        <?php if( isset($data['success']['addAlbum']) ) : ?>
            <div class="success">
                <?= $data['success']['addAlbum'] ;?>
            </div>
        <?php endif ;?>
        <ul class="container">
            <?php
            if($data['albums']){
                include('views/partials/_albums.php');
            }
            ?>
        </ul>
    </section>
</article>