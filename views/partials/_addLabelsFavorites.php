<?php if( isset($_SESSION['user'])) :?>
<form action="index.php" method="post" class="add_fav">
    <input type="submit"
           name="is_fav<?= $label->id;?>"
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
           value="<?= $label->id;?>">
    <input type="hidden"
           name="type"
           value="labels">
</form>
<?php endif; ?>