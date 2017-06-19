<section>
    <h2 class="visuallyhidden">Tous mes favoris</h2>
    <?php if( isset($data['success']['addFavorites']) ) : ?>
        <div class="success">
            <?= $data['success']['addFavorites'] ;?>
        </div>
    <?php endif ;?>
    <ul class="container">
        <?php
        if($data['favorites']){
            include('views/partials/_favorites.php');
        }
        ?>
    </ul>
</section>
</article>