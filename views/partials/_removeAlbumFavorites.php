<form action="index.php" method="post" class="add_fav">
    <input type="submit"
           name="is_fav<?= $album->albumId;?>"
           value="Retirer des favoris"
    >
    <input type="hidden"
           name="a"
           value="deleteFavorites">
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