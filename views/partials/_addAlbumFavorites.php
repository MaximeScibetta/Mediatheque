<?php if( isset($_SESSION['user'])) :?>
<form action="index.php" method="post" class="add_fav">
    <input type="submit"
           name="is_fav<?= $album->albumId;?>"
           value="Ajouter aux favoris"
    >
    <input type="hidden"
           name="a"
           value="postFavorites">
    <input type="hidden"
           name="r"
           value="user">
    <input type="hidden"
           name="id"
           value="<?= $album->albumId;?>">
    <input type="hidden"
           name="type"
           value="albums">
</form>
<?php endif; ?>