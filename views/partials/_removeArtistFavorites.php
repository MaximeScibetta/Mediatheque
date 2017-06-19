<form action="index.php" method="post" class="add_fav">
    <input type="submit"
           name="is_fav<?= $artist->artistId;?>"
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
           value="<?= $artist->artistId;?>">
    <input type="hidden"
           name="type"
           value="artists">
</form>