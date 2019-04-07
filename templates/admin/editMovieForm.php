<?php
require_once __DIR__ . '/../_header.php';
?>

<h1>EDIT New Movie</h1>

<form
        action="index.php"
        method="GET"
>

    <input type="hidden" name="id" value="<?= $movie->getId() ?>">

    <input type="hidden" name="action" value="processUpdateMovie">

    Title:
    <input name="title" value="<?= $movie->getTitle() ?>">

    <p>
    Price:
    <input name="price"  value="<?= $movie->getPrice() ?>">

    <p>
        Category:
        <select name="categoryId">
            <?php
            foreach($categories as $category):
                ?>
                <option name="categoryId" value="<?= $category->getId() ?>"
                    <?php
                        if($category->getId() == $movie->getCategoryId()){
                            print 'selected';
                        }
                    ?>
                >
                <?= $category->getTitle() ?>
                </option>
            <?php
            endforeach;
            ?>
        </select>
    <p>
    <input type="submit">
</form>


<?php
require_once __DIR__ . '/../_footer.php';
?>
