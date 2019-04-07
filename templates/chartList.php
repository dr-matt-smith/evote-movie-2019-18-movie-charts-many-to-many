<?php
require_once __DIR__ . '/_header.php';
?>

<h1>Chart: <?= $chart->getName() ?></h1>


<ul>

<?php



foreach($chartMovies as $chartMovie):
?>
    <li>
        <?= $chartMovie->getMovie()->getTitle() ?>
    </li>

<?php
endforeach;
?>
</ul>
