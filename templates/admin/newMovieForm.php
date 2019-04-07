<?php
require_once __DIR__ . '/../_header.php';
?>

<h1>Create new movie</h1>

<form
        action = "index.php"
        methop = "GET"
>
    <input type="hidden" name="action" value="createNewMovie">

    <p>
        Title:
        <input name="title" id="title">

    <p>
        Price:
        <input name="price" id="price">

    <p>
        Category:
        <select name="categoryId">
            <?php
                foreach($categories as $category):
            ?>
            <option name="categoryId" value="<?= $category->getId() ?>">
                <?= $category->getTitle() ?>
            </option>
            <?php
                endforeach;
            ?>
        </select>

    <p>
        <input type="submit" value="Submit">

</form>

<?php
require_once __DIR__ . '/../_footer.php';
?>