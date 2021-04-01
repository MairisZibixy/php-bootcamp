<?php
include "head.php";
$page = 'tictactoe';

include "DataManager.php";
$manager = new DataManager('db.json');

?>
<style>
    .tictac {
        display: grid;
        grid-template: repeat(3, 1fr) / repeat(3, 1fr);
        grid-gap: 10px;
        height: 360px;
        width: 360px;
        margin: 50px auto;
    }

    .tictac a {
        border: 1px solid black;
        text-align: center;
        line-height: 100%;
        font-size: 80px;
        text-decoration: none;
    }
</style>

<div class="container">
    <?php include "navigation.php"; ?>

    <?php
    /*
$table = [
    ["-", "-", "-"],
    ["-", "-", "-"],
    ["-", "-", "-"]
];
*/
    $table = [];

    if (
        array_key_exists('r', $_GET) &&
        array_key_exists('c', $_GET) &&
        is_string($_GET['r']) &&
        is_string($_GET['c'])
    ) :
        $r = $_GET['r'];
        $c = $_GET['c'];
    ?>
        <div class="alert alert-warning">
            <?php echo 'Rinda ' . $r . ', kollona ' . $c; ?>

        </div>
    <?php
        /*
    *   q1: ko dara funkcija get()
    *   a1:
    */
        if ($manager->get($r, $c) === '') {
            if ($manager->count() % 2 === 0) {
                $manager->save($r, $c, "x");
            } else {
                $manager->save($r, $c, "o");
            }

            //START validation 
        }
    endif; ?>

    <div class="tictac">
        <?php
        for ($r = 1; $r <= 3; $r++) {
            for ($c = 1; $c <= 3; $c++) {
                echo "<a href='?r=$r&c=$c'>" . $manager->get($r, $c) . "</a>";
            }
        }
        ?>
    </div>
</div>