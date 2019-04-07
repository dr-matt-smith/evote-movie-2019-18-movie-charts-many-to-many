<?php
require_once __DIR__ . '/_header.php';
?>

<?php
if(!empty($errorMessage)):
?>
    <div style="background-color: pink">
        <?= $errorMessage ?>
    </div>
<?php
endif;
?>

<form action="index.php" method="POST">
    <input type="hidden" name="action" value="processLogin">

    <p>
    Username:
    <input name="username" id="username">
    <p>
        Password:
        <input type="password" name="password" id="password">

    <p>
    <input type="submit" value="LOGIN">

</form>

<?php
require_once __DIR__ . '/_footer.php';
?>