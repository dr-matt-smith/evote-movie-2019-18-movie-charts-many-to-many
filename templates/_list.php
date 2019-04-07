

<table>
    <tr>
        <th> ID </th>
        <th> title </th>
        <th> price </th>
        <th> category </th>

        <?php
        if($isLoggedIn):
        ?>
            <th> &nbsp; </th>
            <th> &nbsp; </th>
        <?php
            endif;
        ?>
    </tr>

    <?php
        foreach($movies as $movie):
    ?>

            <tr>
                <td><?= $movie->getId() ?></td>
                <td><?= $movie->getTitle() ?></td>
                <td>&euro; <?= $movie->getPrice() ?></td>
                <td><?= $movie->getCategory() ?></td>

                <?php
                    if($isLoggedIn):
                ?>
                <td>
                    <a href="index.php?action=deleteMovie&id=<?= $movie->getId() ?>">DELETE</a>
                </td>
                <td>
                    <a href="index.php?action=editMovie&id=<?= $movie->getId() ?>">EDIT</a>
                </td>
                <?php
                    endif;
                ?>
            </tr>

    <?php
        endforeach;
    ?>

</table>

<?php
if($isLoggedIn):
?>
    <hr>
    <a href="index.php?action=newMovieForm">new movie form</a>
<?php
endif;
?>


<?php
require_once __DIR__ . '/_footer.php';
?>