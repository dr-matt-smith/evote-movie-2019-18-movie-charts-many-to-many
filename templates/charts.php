<?php
require_once __DIR__ . '/_header.php';
?>

<h1>Charts</h1>


<ul>

<?php
foreach($charts as $chart):
?>
    <li>
        <a href="index.php?action=chartList&id=<?= $chart->getId()?>">
            <?= $chart->getName() ?>
        </a>
    </li>

<?php
endforeach;
?>
</ul>
