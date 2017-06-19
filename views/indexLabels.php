
    <section>
        <h2 class="visuallyhidden">Tous les labels</h2>
        <?php if( isset($data['success']['addLabel']) ) : ?>
            <div class="success">
                <?= $data['success']['addLabel'] ;?>
            </div>
        <?php endif ;?>
        <ul class="container">
            <?php
            if($data['labels']){
                include('views/partials/_labels.php');
            }
            ?>
        </ul>
    </section>
</article>
