<form action="index.php" method="post" class="add_fav">
    <input type="submit"
           name="is_fav<?= $label->id;?>"
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
           value="<?= $label->id;?>">
    <input type="hidden"
           name="type"
           value="labels">
</form>